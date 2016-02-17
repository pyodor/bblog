<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\BlogRepository;

class BlogController extends Controller
{
    protected $blogs;

    public function __construct(BlogRepository $blogs)
    {
        $this->middleware('jwt.auth', ['except' => ['index', 'show']]);

        $this->blogs = $blogs;
    }

    public function index(Request $request)
    {
        $blogs = $this->blogs->all();

        return response()->json(['blogs' => $blogs]);
    }

    public function create(Request $request)
    {
        return view('blogs.create');
    }

    public function show(Request $request, $id)
    {
        $blog = $this->blogs->find($id);
        if(!$blog) return response()->json([]);

        $comments = $blog->comments()->orderBy('created_at', 'desc')->get();

        $response = ["blog" => $blog, "comments" => $comments];

        return response()->json($response);
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
}
