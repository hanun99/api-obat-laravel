<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{
       public function index()
    {
        $posts = Post::All();
        // return response()->json(['data'=>$posts]);
        return PostDetailResource::collection($posts->loadMissing('writer:id,username','comments'));
    }

    public function show($id)
    {
        $posts = Post::with('writer:id,username')->findOrFail($id);
        return new PostDetailResource($posts);
    }

    public function show2($id) {
        $post = Post::findOrFail($id);
        return new PostDetailResource($post);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Golongan' => 'required|max:255',
            'Kategori' => 'required',
            'Manfaat' => 'required',
            'Digunakan_oleh' => 'required',
            'Bentuk_obat' => 'required',
        ]);

        //kode ini untuk mengambil data author yang login dan membuat artikel baru
        $request['author'] = Auth::user()->id;

        //ini untuk menyimpan data artikel post ke database
        $post= Post::create($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function update(Request $request , $id)
    {
        $validated = $request->validate([
            'Golongan' => 'required|max:255',
            'Kategori' => 'required',
            'Manfaat' => 'required',
            'Digunakan_oleh' => 'required',
            'Bentuk_obat' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post-> delete();

        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }
}
