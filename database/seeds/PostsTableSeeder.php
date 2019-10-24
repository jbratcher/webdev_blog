<?php

use Illuminate\Database\Seeder;
use App\Post;

require("Database/seeds/postsSeed.php");

class PostsTableSeeder extends Seeder
{

    public $body;

    public function __construct()
    {
        $this->body = $content;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $post = new Post;
        $post->user_id = 1;
        $post->title = "Deploying Larsavel 6 to a Digital Ocean Droplet";

        $post->body = $this->body;

        $post->image_src = "/images/blog2.jpg";
        $post->slug = "deploying-laravel-6-to-a-digital-ocean-droplet";
        $post->intro = "";
        $post->save();

        $post = new Post;
        $post->user_id = 1;
        $post->title = "A new blog post for the blog";
        $post->body = "This is some text to represent a blog post.  I don't really know what to write here.";
        $post->image_src = "/images/blog1.jpg";
        $post->slug = "a-new-blog-post-for-the-blog";
        $post->intro = "";
        $post->save();

        $post = new Post;
        $post->user_id = 1;
        $post->title = "Another blog post";
        $post->body = "I needed a 3rd blog post to make a 2nd row of content.  I don't really know what to write here.";
        $post->image_src = "/images/profile.jpg";
        $post->slug = "another-blog-post";
        $post->intro = "";
        $post->save();

    }

}
