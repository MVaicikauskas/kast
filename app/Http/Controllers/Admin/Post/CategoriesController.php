<?php

namespace app\Http\Controllers\Admin\Post;

use app\Http\Traits\EventTrait;
use app\Models\Posts\PostCategory;
use Illuminate\Http\Request;
use app\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    use EventTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PostCategory::paginate(25);

        return view('admin.categories.list')->with([
            'categories' => $categories,
            'data' => $this->getUnconfirmedEvents()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->getUnconfirmedEvents();
        return view('admin.categories.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = PostCategory::create($request->all());

        $request->session()->flash('alert-success', 'New category added');
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $category)
    {
        $data = $this->getUnconfirmedEvents();
        return view('admin.categories.edit', compact('category', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCategory $category)
    {
        $category->update($request->except(['slug']));
        $request->session()->flash('alert-warning', 'Category updated');

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('alert-danger', 'Category deleted permanently. If it was indexed by Search bots, remember to redirect.');
    }
}
