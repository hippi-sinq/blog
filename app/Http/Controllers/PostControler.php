<?php


namespace App\Http\Controllers;

use App\Services\PostServiceInterface;
use Illuminate\Http\Request;

class PostControler extends Controller
{
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->getPosts(1);
        return view('Post.index', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->postService->getCategories();
        return view('Admin.post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'preview' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
        $postData = $request->all();
        $poster = $request->file('poster')->store('public');
        $poster = str_replace('public', 'storage', $poster);
        $postData['poster'] = $poster;
        $postId = $this->postService->createPost($postData);
        return response(redirect('/post/' .  $postId));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postService->getPostById($id);
        return view('Post.show', compact('post'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postService->getPostById($id);
        $categories = $this->postService->getCategories();
        return view('Post.edit', compact('post', 'categories'));
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
        $postData = $request->all();
        $post = $this->postService->getPostById($id);
        dd($request);
        $post->title = $postData['title'];
        $post->preview = $postData['preview'];
        $post->content = $postData['content'];
        $post->poster = $postData['poster'];
        $post->save();
        return response(redirect('/post/' .  $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->postService->getPostById((int)$id);
        if (!$post) {
            abort(404);
        }
        if ($post->is_published) {
            $this->postService->unPublish($post);
        } else {
            $this->postService->publish($post);
        }
        return back();
    }
}
