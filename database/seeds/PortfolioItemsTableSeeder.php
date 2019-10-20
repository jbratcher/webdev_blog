<?php

use Illuminate\Database\Seeder;
use App\PortfolioItem;

class PortfolioItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $portfolioitem = new PortfolioItem;
        $portfolioitem->user_id = 1;
        $portfolioitem->title = "VoteInfo";
        $portfolioitem->body = "VoteInfo is a voter dashboard voting and election information.";
        $portfolioitem->image_src = "/images/VoteInfoScreenshot.png";
        $portfolioitem->demo_url = "https://github.com/jbratcher/VoteInfo";
        $portfolioitem->repo_url = "https://jbratcher.github.io/VoteInfo/";
        $portfolioitem->slug = "vote-info";
        $portfolioitem->intro = "";
        $portfolioitem->save();

        $portfolioitem = new PortfolioItem;
        $portfolioitem->user_id = 1;
        $portfolioitem->title = "ShouldIRun";
        $portfolioitem->body = "Get a rating on weather conditions for outdoor activities.";
        $portfolioitem->image_src = "/images/ShouldIRunScreenshot.png";
        $portfolioitem->demo_url = "https://jbratcher.github.io/ShouldIRun/";
        $portfolioitem->repo_url = "https://github.com/jbratcher/ShouldIRun";
        $portfolioitem->slug = "should-i-run";
        $portfolioitem->intro = "";
        $portfolioitem->save();

        $portfolioitem = new PortfolioItem;
        $portfolioitem->user_id = 1;
        $portfolioitem->title = "OpenSRD Character Creator";
        $portfolioitem->body = "Character creator for an openSRD-based roleplaying game. Puts together all the info you need to start playing now and not have to worry about calculations for bonuses.";
        $portfolioitem->image_src = "/images/OpenSRDCCScreenshot.png";
        $portfolioitem->demo_url = "https://jbratcher.github.io/ShouldIRun/";
        $portfolioitem->repo_url = "https://github.com/jbratcher/openSRD_character_creator";
        $portfolioitem->slug = "open-srd-character-creator";
        $portfolioitem->intro = "";
        $portfolioitem->save();
    }
}
