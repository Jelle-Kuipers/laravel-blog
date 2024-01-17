<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;

class FeedController extends Controller
{
    //retrieve all of the data from the post, along with the username and profile of the author, and the topic it resides in
    public function showFeedData(){
        $posts = Post::with('user:name,id')->paginate(6);
        return view('feed', ['posts' => $posts]);
    }

    public function showTopicData(){

    }

    public function showUserData(){

    }

    public function showPostData(){

    }

    
}
