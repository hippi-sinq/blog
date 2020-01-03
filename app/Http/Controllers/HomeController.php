<?php

namespace App\Http\Controllers;



use App\Services\PostServiceInterface;

class HomeController extends Controller
{
    private $postService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = $this->postService->getFeaturedPosts();
        $allPosts = $this->postService->getPosts(1);
        $bigFeaturePost = null;
        $featuredPosts = [];
        foreach ($posts as $key => $post) {
            if ($key === 0) {
                $bigFeaturedPosts = $post;
            } else {
                $featuredPosts['normal'][] = $post;
            }
        }
        return view('home.index', compact('allPosts', 'featuredPosts','bigFeaturedPosts'));
    }
}
