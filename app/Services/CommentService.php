<?php


namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CommentService implements CommentServiceInterface
{

    public function addComment(array $attributes, Post $post)
    {
        $user = Auth::user();
        $comment = new Comment();
        $comment->user()->associate($user);
        $comment->post()->associate($post);
        $comment->fillable = $attributes['comment'];
        $comment->save();
    }

    public function delete(int $commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete();
    }
}
