<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\ACP\Logical\ImageControl;
use Modules\Blog\Entities\Posts;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $posts  =   Posts::orderBy('id', 'desc')->paginate(25);
        return view('blog::index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_title'            =>  'required|string|min:5',
            'post_content'          =>  'required|string|min:100',
            'post_content_short'    =>  'required|string|min:50|max:200',
            'post_category_id'      =>  'required|int',
            'post_image'            =>  'nullable|image',
            'post_status'           =>  'nullable|string',
            'post_created_at'       =>  'date|required',
            'post_book'             =>  'nullable|integer',
        ]);

        // If there are Pictures in the Content, so it will be extracted and uploaded to storage
        $post_content_clean =   ImageControl::uploadImagesFromHTML($request->post_content);

        // Check the image and save it
        $path       = ($request->hasFile('post_image') ? $request->file('post_image')->store('uploads/blog/cover', 'public') : 'uploads/blog/cover/placeholder.png');

        $post_book  = (\Nwidart\Modules\Facades\Module::find('bibliography')) ? $request->post_book : '0';

        // Check the post_status
        $post_status = $request->post_status == 'on';

        $post   =   new Posts([
            'post_title'        =>  $request->post_title,
            'post_content'      =>  $post_content_clean,
            'post_content_short'=>  $request->post_content_short,
            'post_category_id'  =>  $request->post_category_id,
            'post_image'        =>  $path,
            'post_status'       =>  $post_status,
            'post_created_at'   =>  $request->post_created_at,
            'post_book'         =>  $post_book,
            'post_author'       =>  Auth::user()->id,
        ]);

        $post->saveOrFail();

        return redirect(route('blog.backend.index'))->with([
            'message'   =>  __('blog::create.post.success.message', ['title' => $request->post_title])
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param \Modules\Blog\Entities\Posts $post
     * @return Renderable
     */
    public function edit(Posts $post)
    {
        return view('blog::edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param \Modules\Blog\Entities\Posts $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function update(Request $request, Posts $post)
    {
        //dd($request);
        // Validation
        $request->validate([
            'post_title'            =>  'required|string|min:5',
            'post_content'          =>  'required|string|min:100',
            'post_content_short'    =>  'required|string|min:50',
            'post_category_id'      =>  'required|int',
            'post_image'            =>  'nullable|image',
            'post_status'           =>  'nullable|string',
            'post_created_at'       =>  'date|required',
            'post_book'             =>  'nullable|integer',
        ]);        //@todo translate validation rules

        // If there are Pictures in the Content, so it will be extracted and uploaded to storage
        $post_content_clean =   ImageControl::uploadImagesFromHTML($request->post_content);


        // Check the Frontimage and save it
        //if ($request->hasFile('post_image')): $post->updateOrFail([ 'post_image' => $request->file('post_image')->store('uploads/blog/cover', 'public') ]);
        if ($request->hasFile('post_image')) {
            $path = $request->file('post_image')->store('uploads/blog/cover', 'public');
            $post->updateOrFail([
                'post_image' => $path,
            ]);
        }

        $post_book  = $request->post_book ?? '0';
        //dd($post_book);

        // Check Status
        $status =   ($request->post_status ? true : false);

        // Update Content
        $post->updateOrFail([
            'post_title'            =>  $request->post_title,
            'post_content'          =>  $post_content_clean,
            'post_content_short'    =>  $request->post_content_short,
            'post_category_id'      =>  $request->post_category_id,
            'post_created_at'       =>  $request->post_created_at,
            'post_status'           =>  $status,
            'post_book'             =>  $post_book,
        ]);

        return redirect(route('blog.backend.index'))->with(['message' => __('blog::edit.post.success.message')]);
    }

    /**
     * change the update status.
     * @param Posts $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function changeStatus(Posts $post){


        $post_status    = !$post->post_status;

        $post->updateOrFail([
            'post_status'   =>  $post_status
        ]);

        return redirect(route('blog.backend.index'))->with([
            'message'   =>  __('blog::edit.status.success.message', ['blogtitle' => $post->post_title])
        ]);
    }

        /**
     * Remove the specified resource from storage.
     * @param \Modules\Blog\Entities\Posts $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Posts $post)
    {
        // save title for return message
        $postTitle  =   $post->post_title;

        // delete currect model
        $post->delete();

        // redirect with message blogtitle
        return redirect(route('blog.backend.index'))->with([
            'message'   =>  __('blog::create.delete.success.message', ['title' => $postTitle])
        ]);
    }
}
