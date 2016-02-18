<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\BlogRepository;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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
        $user = JWTAuth::parseToken()->authenticate();

        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $blog = $user->blogs()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Blog saved successfully', 'blog' => $blog]);
    }

    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $blog = $user->blogs->find($id);

        if(!$blog) {
            return response()->json(['error' => 'Blog not found'], 400);
        }

        if($blog->delete()) {
            return response()->json(['message' => 'Blog deleted successfully']);
        }
    }
}
