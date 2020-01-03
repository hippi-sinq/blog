<?php

namespace App\Services;


use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;


interface PostServiceInterface
{

    public function getCategory(int $categoryId): ?Category;
    public function getPosts(int $page, int $perPage = 10): LengthAwarePaginator;
    public function getCategories(): ?Collection;
    public function getFeaturedPosts(): ?Collection;

    public function getPostById(int $post): ?Post;

    public function createCategory(array $attributes): int;

    public function createPost(array $attributes): int;

    public function publish(Post $post): void;

    public function unPublish(Post $post): void;

    public function removePost(Post $post): void;

    public function removeCategory(Category $post): void;
}
