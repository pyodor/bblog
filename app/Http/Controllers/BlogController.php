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
        $blogs = $request->user() ? $this->blogs->forUser($request->user())
                                  : $this->blogs->all();

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

        //var_dump($blog);

        return view('blogs.show', [
            'blog' => $blog
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

        return redirect('/');
    }
}
