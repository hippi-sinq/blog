<?php

namespace App\Http\Controllers;

use App\Models\Traits\DeletableTrait;
use App\Services\CommentServiceInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use DeletableTrait;

    private $commentService;

    public function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index()
    {
    $comments = $this->commentService->addComment();
    return view('Post.show',compact('comments'));
    }
}
