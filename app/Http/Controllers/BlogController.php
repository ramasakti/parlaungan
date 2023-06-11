<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{
    public function api()
    {
        return response()->json(DB::table('blog')->get(), 200);
    }

    public function showBlogAPI($slug)
    {
        return response()->json(DB::table('blog')->where('slug', $slug)->get(), 200);
    }

    public function create()
    {
        return view('blog.create', [
            'title' => 'Create Post',
            'navactive' => 'web'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'unique:blog',
            'foto' => 'image|file'
        ]);

        $image = $request->file('foto');
        $encodedImage = base64_encode(file_get_contents($image->getPathname()));

        DB::table('blog')
            ->insert([
                'slug' => $validated['slug'],
                'foto' => $encodedImage,
                'judul' => $request->judul,
                'isi' => $request->isi,
                'uploaded' => date('Y-m-d H:i:s'),
                'uploader' => $request->uploader,
                'publish' => FALSE
            ]);
        
        return redirect('/web')->with('success', 'Berhasil menambahkan berita');
    }

    public function show($blog)
    {
        return view('blog.show', [
            'data' => DB::table('blog')->where('slug', $blog)->first()
        ]);
    }

    public function edit($slug)
    {
        return view('blog.edit', [
            'title' => 'Blog Edit',
            'navactive' => 'web',
            'dataBlog' => DB::table('blog')->where('slug', $slug)->get()
        ]);
    }

    public function update(Request $request, $slug)
    {
        $detailBlog = DB::table('blog')->where('slug', $slug)->first();
        
        $validated = $request->validate([
            'slug' => 'unique:blog',
            'foto' => 'image|file'
        ]);

        if ($validated['slug'] == null) {
            $validated['slug'] = $detailBlog->slug;
        }

        if ($request->file('foto')) {
            $image = $request->file('foto');
            $encodedImage = base64_encode(file_get_contents($image->getPathname()));

            //Update Data
            DB::table('blog')
                ->where('slug', $slug)
                ->update([
                    'slug' => $validated['slug'],
                    'foto' => $encodedImage,
                    'judul' => $request->judul,
                    'isi' => $request->isi,
                    'uploaded' => date('Y-m-d H:i:s'),
                    'uploader' => $request->uploader,
                    'publish' => $request->publish
                ]);
        }else{
            //Update Data
            DB::table('blog')
                ->where('slug', $slug)
                ->update([
                    'slug' => $validated['slug'],
                    'judul' => $request->judul,
                    'isi' => $request->isi,
                    'uploaded' => date('Y-m-d H:i:s'),
                    'uploader' => $request->uploader,
                    'publish' => $request->publish
                ]);
        }

        return redirect('/web')->with('success', 'Berhasil mengupdate berita');
    }

    public function delete($slug)
    {        
        DB::table('blog')->where('slug', $slug)->delete();
        return back()->with('success', 'Berhasil delete data');
    }
}
