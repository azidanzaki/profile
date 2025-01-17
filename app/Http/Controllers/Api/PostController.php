<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::latest()->paginate(5);
        return new PostResource(true, 'List Data Posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'content'   => 'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        $image =$request ->file('image');
        $image->storeAs('public/posts',$image->hashName());

        $post=Post::create([
            'image'     => $image ->hashName(),
            'title'     => $request->title,
            'content'   => $request->content,
        ]);
        return new PostResource(true, 'Data Post Berhasil Ditambahkan', $post);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource(true, "Data Post Ditemukan, wadaww! ", $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Mendapatkan instance Post berdasarkan ID
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            // Menghapus gambar lama jika ada
            if ($post->image) {
                Storage::delete('public/posts/' . $post->image);
            }

            $post->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'content' => $request->content,
            ]);
        } else {
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }

        return new PostResource(true, 'Data Post Berhasil Diubah!', $post);
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        Storage::delete('public/posts/'.$post->image);
        $post->delete();
        return new PostResource(true, 'Data Post Berhasil Dihapus!', null);
    }

}
