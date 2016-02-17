<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApplicationTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanRegister()
    {
        $this->visit('/')
             ->click('Register')
             ->seePageIs('/register')
             ->type('Blogger', 'name')
             ->type('blogger@bibo-blog.com', 'email')
             ->type('bloggerpassword', 'password')
             ->type('bloggerpassword', 'password_confirmation')
             ->press('Register')
             ->see('Create New Blog')
             ->see('Blogger')
             ->see('Logout')
             ->seeInDatabase('users', ['email' => 'blogger@bibo-blog.com']);
    }

    public function testCanCreateNewBlog()
    {
        $user = factory(App\User::class)->create([
            'password' => bcrypt('my password')
        ]);

        $title = 'My First Post';
        $content = 'My Post Content';

        $this->visit('/')
             ->click('Login')
             ->seePageIs('/login')
             ->type($user->email, 'email')
             ->type('my password', 'password')
             ->press('Login')
             ->see('Create New Blog')
             ->click('Create New Blog')
             ->type($title, 'title')
             ->type($content, 'content')
             ->press('Save Blog')
             ->see($title)
             ->see($content)
             ->seeInDatabase('blogs', ['user_id' => $user->id])
             ->seeInDatabase('blogs', ['title' => $title])
             ->seeInDatabase('blogs', ['content' => $content]);
    }

    public function testCanCommentBlog()
    {
        $user = factory(App\User::class)->create([
            'password' => bcrypt('my password')
        ]);

        $blog = factory(App\Blog::class)->create([
            'title' => 'My Post Title',
            'content' => 'My Post Content',
            'user_id' => $user->id
        ]);

        $comment_content = 'My Comment';

        $this->visit('/')
             ->click('Login')
             ->seePageIs('/login')
             ->type($user->email, 'email')
             ->type('my password', 'password')
             ->press('Login')
             ->see('Create New Blog')
             ->visit("/blog/$blog->id")
             ->type($comment_content, 'content')
             ->press('Submit')
             ->see('Comments posted!')
             ->see($comment_content)
             ->seeInDatabase('comments', ['blog_id' => $blog->id])
             ->seeInDatabase('comments', ['content' => $comment_content])
             ->seeInDatabase('comments', ['user_id' => $user->id]);
    }
}
