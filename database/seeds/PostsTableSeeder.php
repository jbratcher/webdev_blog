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
        $post->title = "Rendering HTML from a MySQL database";
        $post->body = "<h1>How to render form data using HTML</h1>
                       <p>You can use any string type to render HTML to the page</p>";
        $post->image_src = "/images/blog2.jpg";
        $post->slug = "rendering-html-from-a-mysql-database";
        $post->save();

    }
}
