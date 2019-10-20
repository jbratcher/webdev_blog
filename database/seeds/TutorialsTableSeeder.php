<?php

use Illuminate\Database\Seeder;
use App\Tutorial;

class TutorialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tutorial = new Tutorial();
        $tutorial->user_id = 1;
        $tutorial->title = "Rendering HTML from a MySQL database";
        $tutorial->body = "<h1>How to render form data using HTML</h1>
                       <p>You can use any string type to render HTML to the page</p>";
        $tutorial->image_src = "/images/blog2.jpg";
        $tutorial->slug = "rendering-html-from-a-mysql-database";
        $tutorial->intro = "";
        $tutorial->save();

    }
}
