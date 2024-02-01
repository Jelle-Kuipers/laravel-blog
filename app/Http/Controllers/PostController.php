<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\ThumbnailHelper;

class PostController extends Controller
{
    protected $thumbnailHelper;

    public function __construct()
    {
        $this->thumbnailHelper = new ThumbnailHelper;
    }

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
        return redirect()->back();
    }

    // Update
    public function updatePost() {

        $post = Post::get()->where('id', request()->id)->first();

        $this->authorize('update', $post);

        // Filter out empty request parameters
        $data = array_filter(request()->except('_token', 'id'), function($value) {
            return $value !== null && $value !== '';
        });

        // dd($data);

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
}
