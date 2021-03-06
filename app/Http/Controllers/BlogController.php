<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\BlogRepository;

class BlogController extends Controller
{
    protected $blogs;

    public function __construct(BlogRepository $blogs)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);

        $this->blogs = $blogs;
    }

    public function index(Request $request)
    {
        $blogs = $this->blogs->all();

        return view('blogs.index', [
            'blogs' => $blogs
        ]);
    }

    public function create(Request $request)
    {
        return view('blogs.create');
    }

    public function show(Request $request, $id)
    {
        $blog = $this->blogs->find($id);
        $comments = $blog->comments()->orderBy('created_at', 'desc')->get();

        return view('blogs.show', [
            'blog' => $blog,
            'comments' => $comments
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $request->user()->blogs()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/')->with('message', 'Post successfully saved!');
    }

    public function edit($id)
    {
        $blog = $this->blogs->find($id);

        return view('blogs.edit')->withBlog($blog);
    }

    public function update($id, Request $request)
    {
        $blog = $this->blogs->find($id);

        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $input = $request->all();

        $blog->fill($input)->save();

        return redirect('/')->with('message', 'Post successfully updated!');;
    }
    
    public function destroy($id)
    {
        if($this->blogs->find($id)->delete()) {
            return redirect('/')->with('message', 'Post successfully deleted!');
        }
    }
}
