<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    protected $comments;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $blog_id)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);

        $request->user()->comments()->create([
            'content' => $request->content,
            'blog_id' => (int)$blog_id
        ]);

        return redirect("blog/$blog_id")->with('message', 'Comments posted!');
    }
}
