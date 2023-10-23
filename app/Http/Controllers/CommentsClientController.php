<?php

namespace App\Http\Controllers;

use App\Events\LikeComment;
use App\Models\Blog;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;


class CommentsClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        $blog = Blog::where('id', $id)->first();
        
        try {
            $request->validate([
                'message' => 'required',
            ]);
            Comment::create([
                'message' => $request->input('message'),
                'blog_id' => $id,
                'user_id' => auth()->user()->id,
                'likes' => []
            ]); 
            event(new LikeComment($blog->title, auth()->user()->name));          
            
            return redirect('blog/' . $id)->with('message', 'The comment added successfully');
        } catch (Exception $th) {
            return response()->json($th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $idBlog)
    {
        $request->validate([
            'message' => 'required',
        ]);
        Comment::where('id', $id)->update([
            'message' => $request->input('message'),
        ]);

        return redirect('blog/' . $idBlog)->with('message', 'The comment updated successfully');
    }
    public function like(Request $request, $id, $idBlog)
    {
        $comment = Comment::where('id', $id)->first();
        $likes = json_decode($comment->likes, true);
        $valueToAdd = auth()->user()->id;
        if (!is_array($likes)) {
            $likes = [];
        }
        $likes[] = $valueToAdd;
        $comment->likes = json_encode($likes);
        $comment->save();      
        return redirect('blog/' . $idBlog)->with('message', 'The comment liked successfully');
    }

    public function unlike(Request $request, $id, $idBlog)
    {
        $comment = Comment::where('id', $id)->first();
        $likes = json_decode($comment->likes, true);
        $valueToRemove = auth()->user()->id;
        $likes = array_filter($likes, function ($item) use ($valueToRemove) {
            return $item !== $valueToRemove;
        });
        $comment->likes = json_encode($likes);
        $comment->save();
        return redirect('blog/' . $idBlog)->with('message', 'The comment unliked successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idBlog)
    {
        Comment::where('id', $id)->delete();
        return redirect('blog/' . $idBlog)->with('message', 'The comment deleted successfully');
    }
    public function destroyComment($id, $idBlog)
    {
        Comment::where('id', $id)->delete();
        return redirect('/admin/blogs/' . $idBlog)->with('message', 'The comment deleted successfully');
    }
}