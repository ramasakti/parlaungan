<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{
    public function apiBlog()
    {
        return response()->json(DB::table('blog')->get(), 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.index', [
            'ai' => 1,
            'title' => 'Blog | SMA Islam Parlaungan',
            'navactive' => 'blog',
            'data' => Blog::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create', [
            'title' => 'Create Post',
            'navactive' => 'web'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'unique:blog',
            'foto' => 'image|file'
        ]);

        $filenameWithExt = $request->file('foto')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('foto')->getClientOriginalExtension();
        $filenameSimpan = $filename.'_'.time().'.'.$extension;
        $path = $request->file('foto')->storeAs('public/posts_image', $filenameSimpan);

        DB::table('blog')
            ->insert([
                'slug' => $request->slug,
                'foto' => $validated['foto'],
                'judul' => $request->judul,
                'isi' => $request->isi,
                'kategori' => $request->kategori,
                'uploaded' => date('Y-m-d'),
                'uploader' => $request->uploader
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
