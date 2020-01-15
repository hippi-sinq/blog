<?php


namespace App\Services;


use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Services\PostServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PostService implements PostServiceInterface
{

    public function getCategory(int $categoryId): ?Category
    {
        $category = Category::find($categoryId);
        if (!$category) {
            return null;
        }
        return $category;
    }

    public function getPosts(int $page, int $perPage = 5): LengthAwarePaginator
    {
        $posts = Post::paginate($perPage);
        return $posts;
    }

    public function getCategories(): ?Collection
    {
        return Category::all();
    }

    public function getFeaturedPosts(): ?Collection
    {
        $posts = Post::where('posts.is_published', true)
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->limit(3)
            ->get();
        return $posts;
    }

    public function getPostById(int $post): ?Post
    {
        return Post::find($post);
    }

//    public function getCategoryById(int $categoryId): ?Category
//    {
//        return Category::find($categoryId);
//    }

    public function createCategory(array $attributes): int
    {
        $category = new Category();
        $category->name = $attributes['name'];
        $category->is_active = true;
        $category->save();
        return $category->id;
    }

    public function createPost(array $attributes): int
    {
        $user = Auth::user();
        $post = new Post();
        $post->title = $attributes['title'];
        $post->preview = $attributes['preview'];
        $post->content = $attributes['content'];
        $post->is_published = false;
        $post->poster = $attributes['poster'];
        $category = Category::findOrFail($attributes['category_id']);
        $post->user()->associate($user);
        $post->category()->associate($category);
        $post->save();
        return $post->id;    }

    public function publish(Post $post): void
    {
        $post->is_published = true;
        $post->save();
    }

    public function unPublish(Post $post): void
    {
        $post->is_published = false;
        $post->save();
    }

    public function removePost(Post $post): void
    {
        // TODO: Implement removePost() method.
    }

    public function removeCategory(Category $post): void
    {
        // TODO: Implement removeCategory() method.
    }

    public function updateCategory(int $attributes): object
    {
        return Category::find($attributes);
    }
}
