<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post;
        $post->user_id = 1;
        $post->title = "Vue JS Laravel Starter Kit";
        $post->body = "I always find myself configuring the two despite being a good pair.  I created this starter kit to same time to development.";
        $post->image_src = "../../images/blog1.jpg";
        $post->save();

        $post = new Post;
        $post->user_id = 1;
        $post->title = "Laravel 6.0 Release";
        $post->body = "Moving to semantic versioning, the team behind the project is poised to realease Laravel 6 soon.";
        $post->image_src = "../../images/blog2.jpg";
        $post->save();

        $post = new Post;
        $post->user_id = 1;
        $post->title = "Rendering HTML from a MySQL database";
        $post->body = "<h1>How to render form data using HTML</h1>
                       <p>You can use any string type to render HTML to the page</p>";
        $post->image_src = "../../images/blog2.jpg";
        $post->save();

    }
}
