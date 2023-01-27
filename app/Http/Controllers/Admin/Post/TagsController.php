<?php

namespace app\Http\Controllers\Admin\Post;

use app\Http\Controllers\Controller;
use app\Http\Requests\StoreTagRequest;
use app\Http\Requests\UpdateTagRequest;
use app\Models\Posts\Tag;
use app\Http\Traits\EventTrait;

class TagsController extends Controller
{
    use EventTrait;

    public function index()
    {
        $tags = Tag::paginate(25);

        $data = $this->getUnconfirmedEvents();

        return view('admin.tags.list', compact('tags', 'data'));
    }

    public function trash()
    {
        $tagstrash = Tag::onlyTrashed()->paginate(25);

        $data = $this->getUnconfirmedEvents();

        return view('admin.tags.listTrash', compact('tagstrash', 'data'));
    }

    public function create()
    {
        $data = $this->getUnconfirmedEvents();
        return view('admin.tags.create', compact('data'));
    }

    public function store(StoreTagRequest $request)
    {
        $tag = Tag::create($request->all());

        $request->session()->flash('alert-success', 'New tag added');
        return redirect()->route('tags.index');
    }

    public function edit(Tag $tag)
    {
        $data = $this->getUnconfirmedEvents();
        return view('admin.tags.edit', compact('tag', 'data'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->except(['slug']));
        $request->session()->flash('alert-warning', 'Tag updated');

        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags.index')->with('alert-danger', 'Tag deleted');
    }

    public function delete($id) {
        $tag = Tag::onlyTrashed()->findOrFail($id);

        $tag->forceDelete();

        return redirect()->route('tags.trash')->with('alert-danger', 'Tag deleted permanently');
    }

    public function restore($id) {
        Tag::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('tags.index')->with('alert-danger', 'Tag restored');
    }
}
