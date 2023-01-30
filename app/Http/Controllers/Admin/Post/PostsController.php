<?php

namespace app\Http\Controllers\Admin\Post;

use app\Models\Posts\Tag;
use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\Posts\Post;
use app\Models\Posts\PostCategory;
use app\Models\Media\Media;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;

class PostsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['category'])
            ->when(\request()->filled('search'), function ($query) {
                $query->where('title', 'LIKE', '%' . request()->input('search') . '%');
            })
            ->latest()->paginate(25);

        return view('admin.posts.list')->with([
            'posts' => $posts,
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
        return view('admin.posts.create')->with([
            'categories' => PostCategory::all(),
            'tags' => Tag::all()->pluck('title', 'id'),
            'data' => $this->getUnconfirmedEvents()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->slug)]);

        $this->validate($request, [
            'title' => 'required|min:3|max:191',
            'excerpt' => 'required|min:3|max:191',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'category_id' => 'required',
            'slug' => 'required|unique:posts'
        ]);

        $post = new Post;

        $post->author = $request->author;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->featured = (bool) $request->featured;
        $post->trending = (bool) $request->trending;
        $post->excerpt = $request->excerpt;
        $post->description = $request->description;
        $post->description2 = $request->input('description2');
        $post->description3 = $request->input('description3');

        $post->meta_description = $request->input('meta_description');
        $post->category_id = $request->category_id;
//        $post->tags = $request->tags;//deprecated 20210205
        $post->youtube_url = $request->youtube_url;
        $post->youtube_main = $request->youtube_main === 'yes' ? true : false;

        if(($request->hasFile('image'))) {
            $name = md5(round(microtime(true) * 1000)) . '.' . $request->image->getClientOriginalExtension();

            $savePath = 'storage_old/posts/';

            if (!File::exists($savePath)) {
              File::makeDirectory($savePath, 0777, true, true);
            }

            Image::make($request->image->getRealPath())
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($savePath) . $name);

            $post->image = $name;
        }

        $post->advert_link_1 = $request->advert_link_1;
        $post->advert_link_2 = $request->advert_link_2;
        $post->advert_link_3 = $request->advert_link_3;
        if(($request->hasFile('advert_image_1'))) {
            $name = md5(round(microtime(true) * 1000)) . '.' . $request->advert_image_1->getClientOriginalExtension();

            $savePath = 'storage_old/posts/adverts/';

            if (!File::exists($savePath)) {
              File::makeDirectory($savePath, 0777, true, true);
            }

            Image::make($request->advert_image_1->getRealPath())
                ->resize(970, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($savePath) . $name);

            $post->advert_image_1 = $name;
        }

        if(($request->hasFile('advert_image_2'))) {
            $name = md5(round(microtime(true) * 1000)) . '.' . $request->advert_image_2->getClientOriginalExtension();

            $savePath = 'storage_old/posts/adverts/';

            if (!File::exists($savePath)) {
              File::makeDirectory($savePath, 0777, true, true);
            }

            Image::make($request->advert_image_2->getRealPath())
                ->resize(970, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($savePath) . $name);

            $post->advert_image_2 = $name;
        }

        if(($request->hasFile('advert_image_3'))) {
            $name = md5(round(microtime(true) * 1000)) . '.' . $request->advert_image_3->getClientOriginalExtension();

            $savePath = 'storage_old/posts/adverts/';

            if (!File::exists($savePath)) {
              File::makeDirectory($savePath, 0777, true, true);
            }

            Image::make($request->advert_image_3->getRealPath())
                ->resize(970, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($savePath) . $name);

            $post->advert_image_3 = $name;
        }


        $post->save();

        $post->post_tag()->sync($request->input('post_tags', []));

        if ($request->hasFile('media')) {
          foreach ($request->file('media') as $file) {
            $extension = $file->getClientOriginalExtension();
            $filesize = $file->getSize();
  
            $name = md5(round(microtime(true) * 1000)) . '.' . $extension;
  
            $imageExtensions = 'jpeg,png,jpg,gif,svg';
            
            $path = '';
            $savePath = 'storage_old/posts/';
  
            if (strpos($imageExtensions, $extension)) {
              $path = public_path($savePath) . $name;
  
              Image::make($file->getRealPath())
                  ->resize(1200, null, function ($constraint) {
                      $constraint->aspectRatio();
                  })
                  ->save($path);
            }

            $post->media()->create([
              'name' => $name,
              'path' => $path,
              'extension' => $extension,
              'filesize' => $filesize,
            ]);
          }
        }

        $request->session()->flash('alert-success', 'New post added');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.posts.delete')->with([
            'post' => Post::findOrFail($id),
            'data' => $this->getUnconfirmedEvents()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.posts.edit')->with([
            'post' => Post::findOrFail($id),
            'tags' => Tag::all()->pluck('title', 'id'),
            'categories' => PostCategory::all(),
            'data' => $this->getUnconfirmedEvents()
        ]);
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
        $this->validate($request, [
            'title' => 'required|min:3|max:191',
            'excerpt' => 'required|min:3|max:191',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        $post = Post::findOrFail($id);

        $post->author = $request->author;
        $post->title = $request->title;
        if( isset($request->slug) && !empty($request->slug) ) {
            $post->slug = Str::slug($request->slug);
        }
        $post->featured = (bool) $request->featured;
        $post->trending = (bool) $request->trending;
        $post->excerpt = $request->excerpt;
        $post->description = $request->description;
        $post->description2 = $request->description2;
        $post->description3 = $request->description3;
        $post->meta_description = $request->meta_description;
        $post->category_id = $request->category_id;
        $post->tags = $request->tags;
        $post->youtube_url = $request->youtube_url;
        $post->youtube_main = $request->youtube_main === 'yes' ? true : false;

        if(($request->hasFile('image'))) {
            $name = md5(round(microtime(true) * 1000)) . '.' . $request->image->getClientOriginalExtension();

            Image::make($request->image->getRealPath())
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('storage_old/posts/') . $name);

            $post->image = $name;
        }

        $post->save();

        $post->post_tag()->sync($request->input('post_tags', []));

        if ($request->hasFile('media')) {
          foreach ($request->file('media') as $file) {
            $extension = $file->getClientOriginalExtension();
            $filesize = $file->getSize();
  
            $name = md5(round(microtime(true) * 1000)) . '.' . $extension;
  
            $imageExtensions = 'jpeg,png,jpg,gif,svg';
            
            $path = '';
            $savePath = 'storage_old/posts/';
  
            if (strpos($imageExtensions, $extension)) {
              $path = public_path($savePath) . $name;
  
              Image::make($file->getRealPath())
                  ->resize(1200, null, function ($constraint) {
                      $constraint->aspectRatio();
                  })
                  ->save($path);
            }

            $post->media()->create([
              'name' => $name,
              'path' => $path,
              'extension' => $extension,
              'filesize' => $filesize,
            ]);
          }
        }

        $request->session()->flash('alert-warning', 'Post updated');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();
        return redirect()->route('posts.index')->with('alert-danger', 'Post deleted');
    }

    public function deleteFile($id)
    {
      $file = Media::find($id);
      $path = 'storage_old/posts/';

      if (File::exists(public_path($path) . $file->name)) {
        File::delete(public_path($path) . $file->name);
      }

      $file->delete();
    }

    public function storeCKEditorImages(Request $request)
    {
        if($request->hasFile('upload')) {

            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
            //filename to store
            $filenametostore = Str::slug($filename, '-' ) . '_' . time() . '.' . $extension;

            $savePath = 'storage_old/posts/content/';
            $width = Image::make($request->file('upload')->getRealPath())->width();
            if($width > 1200) {
                Image::make($request->file('upload')->getRealPath())
                    ->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path($savePath) . $filenametostore);
            }else {
                Image::make($request->file('upload')->getRealPath())
                    ->save(public_path($savePath) . $filenametostore);
            }

//            Upload File old
//            $request->file('upload')->storeAs('posts/content/', $filenametostore, array('disk' => 'public_old') );

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage_old/posts/content/'.$filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }

        return;
    }
}
