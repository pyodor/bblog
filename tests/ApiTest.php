<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanGetBlogsWithComment()
    {
        $user = factory(App\User::class)->create();

        $blog = factory(App\Blog::class)->create([
            'title' => 'My Post Title',
            'content' => 'My Post Content',
            'user_id' => $user->id
        ]);

        $comment = factory(App\Comment::class)->create([
            'content' => 'My Comment',
            'user_id' => $user->id,
            'blog_id' => $blog->id
        ]);

        $this->json('GET', "/api/v1/blog/$blog->id")
             ->seeJson([
                 'title' => 'My Post Title',
                 'content' => 'My Post Content',
                 'content' => 'My Comment',
               ])
            ->seeJsonStructure([
                 'blog',
                 'comments'
              ]);
    }

    public function testCanGetBlogs()
    {
        $user = factory(App\User::class)->create();

        $blog = factory(App\Blog::class)->create([
            'title' => 'My Post Title',
            'content' => 'My Post Content',
            'user_id' => $user->id
        ]);

        $this->json('GET', "/api/v1/blog")
             ->seeJson([
                 'title' => 'My Post Title',
                 'content' => 'My Post Content',
               ])
            ->seeJsonStructure([
                 'blogs'
              ]);
    }

    // public function testCanGetTokenViaCredentials()
    // {
    //     $user = factory(App\User::class)->create([
    //         'email' => 'csicebu@gmail.com',
    //         'password' => 'mypassword'
    //     ]);
    //
    //     $this->json('POST', "/api/v1/authenticate", [
    //             'email' => $user->email,
    //             'password' => $user->password
    //         ])
    //         ->seeJsonStructure([
    //              'token'
    //           ]);
    // }
}
