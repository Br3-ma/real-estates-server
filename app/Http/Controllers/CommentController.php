<?php

namespace App\Http\Controllers;

use App\Events\CommentEvent;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index($post_id)
    {
        return response()->json(Comment::where('post_id', $post_id)->with('user')->get());
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:property_posts,id',
            'content' => 'required|string|max:500',
            'parent_id' => 'nullable|exists:comments,id',
            'user_id' => 'required',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->parent_id = $request->parent_id;
        $comment->user_id = $request->user_id ;
        $comment->save();

        // event(new CommentEvent($comment));

        return response()->json($comment, 201);
    }

    /**
     * Update the specified comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        // $this->authorize('update', $comment);

        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment->content = $request->content;
        $comment->save();

        return response()->json($comment, 200);
    }

    /**
     * Remove the specified comment from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        // $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json(null, 204);
    }
}
