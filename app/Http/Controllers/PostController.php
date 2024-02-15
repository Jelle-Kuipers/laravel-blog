<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostVote;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Helpers\ThumbnailHelper;

class PostController extends Controller {
    protected $thumbnailHelper;

    public function __construct() {
        $this->thumbnailHelper = new ThumbnailHelper;
    }

    // Create
    public function createPost() {
        $this->authorize('create', Post::class);

        $post = new Post;
        // Check if required fields are filled
        if (empty(request()->all())) {
            abort(400, 'Missing required fields.');
        }
        $post->user_id = Auth::user()->id;
        $post->description = request()->description;
        $post->title = request()->title;
        $post->content = request()->content;
        $thumbnailpath = $this->thumbnailHelper->saveThumbnail(request()->file('thumbnail'));
        $post->thumbnail_path = $thumbnailpath;
        $post->topic_id = request()->topic_id;

        $post->save();
        return redirect()->route('post@readPosts');
    }

    // Read
    public function readPosts() {
        $posts = Post::latest()->paginate(6);
        // add the author name, topic, score and variables for showing upvotes
        foreach ($posts as $post) {
            $post->author = $post->user->name;
            $post->score = $this->calculatePostScore($post->id);
            $post->topic_title = Topic::get()->where('id', $post->topic_id)->first()->title;
            $post->created = Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d M Y H:i');
            if ($this->getUserVoteOnPost($post->id)) {
                $post->userHasVoted = true;
                $post->userVote = PostVote::where('user_id', Auth::user()->id)->where('post_id', $post->id)->first()->upvote;
            } else {
                $post->userHasVoted = false;
                $post->userVote = null;
            }
        }

        // get topics for the form
        $topics = Topic::all();

        // return the view with the posts and topics
        return view('posts', ['posts' => $posts, 'topics' => $topics]);
    }

    // Read single
    public function singlePost($id) {
        $post = Post::get()->where('id', $id)->first();
        $post->author = $post->user->name;
        $post->score = $this->calculatePostScore($post->id);
        $post->topic_title = Topic::get()->where('id', $post->topic_id)->first()->title;
        $post->created = Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d M Y H:i');
        if ($this->getUserVoteOnPost($post->id)) {
            $post->userHasVoted = true;
            $post->userVote = PostVote::where('user_id', Auth::user()->id)->where('post_id', $post->id)->first()->upvote;
        } else {
            $post->userHasVoted = false;
            $post->userVote = null;
        }

        // get topics for the form
        $topics = Topic::all();
        return view('singlepost', ['post' => $post, 'topics' => $topics]);
    }

    // Update
    public function updatePost() {

        $post = Post::get()->where('id', request()->id)->first();

        $this->authorize('update', $post);

        // Filter out empty request parameters
        $data = array_filter(request()->except('_token', 'id'), function ($value) {
            return $value !== null && $value !== '';
        });

        // Replace the old thumbnail if a new one is uploaded.
        if (request()->hasFile('thumbnail')) {
            $this->thumbnailHelper->deleteThumbnail($post->thumbnail_path);
            $thumbnailpath = $this->thumbnailHelper->saveThumbnail(request()->file('thumbnail'));
            $data['thumbnail_path'] = $post->thumbnail_path = $thumbnailpath;
        }

        // Save the changes
        $post->update($data);
        return redirect()->back();
    }

    // Delete
    public function deletePost() {
        $post = Post::get()->where('id', request()->id)->first();

        $this->authorize('delete', $post);

        $this->thumbnailHelper->deleteThumbnail($post->thumbnail_path);
        $post->delete();
        return redirect()->back();
    }

    // VoteOnPost
    public function voteOnPost() {
        // Get the specific vote
        $post = Post::get()->where('id', request()->id)->first();

        // Check to see if the user has already voted here
        if (PostVote::where('user_id', Auth::user()->id)->where('post_id', $post->id)->exists()) {
            // Update the vote
            $postvote = PostVote::where('user_id', Auth::user()->id)->where('post_id', $post->id)->first();
            $postvote->upvote = request()->upvote;
            $postvote->save();
        } else {
            // Make new PostVote
            $postvote = new PostVote;
            $postvote->user_id = Auth::user()->id;
            $postvote->post_id = $post->id;
            $postvote->upvote = request()->upvote;
            $postvote->save();
        }

        return redirect()->back();
    }

    // RemoveVoteOnPost
    public function removeVoteOnPost() {
        $post = Post::get()->where('id', request()->id)->first();

        // Check if the user has a vote on this post
        if (PostVote::where('user_id', Auth::user()->id)->where('post_id', $post->id)->exists()) {
            // Delete/remove the vote
            $postvote = PostVote::where('user_id', Auth::user()->id)->where('post_id', $post->id)->first();
            $postvote->delete();
        }

        return redirect()->back();
    }

    // getUserVoteOnPost
    private function getUserVoteOnPost($id) {
        $post = Post::get()->where('id', $id)->first();

        // Check if the user has a vote on this post
        if (PostVote::where('user_id', Auth::user()->id)->where('post_id', $post->id)->exists()) {
            return true;
        }
        // If not, return false
        return false;
    }

    // Calculate and show the score of a Post
    private function calculatePostScore($id) {
        $score = PostVote::where('post_id', $id)->where('upvote', 1)->count() - PostVote::where('post_id', $id)->where('upvote', 0)->count();
        return $score;
    }
}
