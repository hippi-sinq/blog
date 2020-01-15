<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Traits\DeletableTrait;
use App\Services\PostServiceInterface;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    use DeletableTrait;

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
        $categories = $this->postService->getCategories();
        return view('Category.index', compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Category.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->all();
        $this->postService->createCategory($attributes);
        return response()->redirectToRoute('list_categories');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->postService->getCategories($id);
        if (!$category) {
            abort(404);
        }
        return view('Category.show', compact('category'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->postService->getCategory($id);
        return view('Category.show', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $categoryData = $request->all();
        $category = $this->postService->getCategory($id);
        $category->name = $categoryData['name'];
        $category->save();
        return response(redirect('/categories/'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->postService->getCategory($id);
        $this->delete($category);
        $category->save();
        return back();
    }
}
