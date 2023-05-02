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

        //Upload Foto Baru
        $ext = $request->file('foto')->getClientOriginalExtension();
        $filename = date('YmdHis') . '.' . $ext;
        $request->file('foto')->storeAs('/blog', $filename);

        DB::table('blog')
            ->insert([
                'slug' => $validated['slug'],
                'foto' => $filename,
                'judul' => $request->judul,
                'isi' => $request->isi,
                'kategori' => $request->kategori,
                'uploaded' => date('Y-m-d'),
                'uploader' => $request->uploader
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
            //Hapus Foto Lama
            Storage::delete('blog/' . $detailBlog->foto);

            //Upload Foto Baru
            $ext = $request->file('foto')->getClientOriginalExtension();
            $filename = date('YmdHis') . '.' . $ext;
            $request->file('foto')->storeAs('/blog', $filename);

            //Update Data
            DB::table('blog')
                ->where('slug', $slug)
                ->update([
                    'slug' => $validated['slug'],
                    'foto' => $filename,
                    'judul' => $request->judul,
                    'isi' => $request->isi,
                    'kategori' => $request->kategori,
                    'uploaded' => date('Y-m-d'),
                    'uploader' => $request->uploader
                ]);
        }else{
            //Update Data
            DB::table('blog')
                ->where('slug', $slug)
                ->update([
                    'slug' => $validated['slug'],
                    'judul' => $request->judul,
                    'isi' => $request->isi,
                    'kategori' => $request->kategori,
                    'uploaded' => date('Y-m-d'),
                    'uploader' => $request->uploader
                ]);
        }

        return redirect('/web')->with('success', 'Berhasil menambahkan berita');
    }

    public function destroy($slug)
    {
        $detailBlog = DB::table('blog')->where('slug', $slug)->first();
        
        DB::table('blog')->where('slug', $slug)->delete();
    }
}
