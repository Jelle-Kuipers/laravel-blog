<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ThumbnailHelper;

class TopicController extends Controller {

    protected $user;
    protected $thumbnailHelper;

    public function __construct() {
        $this->user = Auth::user();
        $this->thumbnailHelper = new ThumbnailHelper;
    }

    // Create
    public function createTopic() {
        $this->authorize('create', Topic::class);

        $topic = new Topic;
        // Check if required fields are filled
        if (empty(request()->all())) {
            abort(400, 'Missing required fields.');
        }
        $topic->title = request()->title;
        $topic->description = request()->description;
        $thumbnailpath = $this->thumbnailHelper->saveThumbnail(request()->file('thumbnail'));
        $topic->thumbnail_path = $thumbnailpath;
        $topic->save();
        return redirect()->back();
    }

    // Update
    public function updateTopic() {
        $this->authorize('update', Topic::class);

        // Check if any request parameter is valid or filled
        if (!request()->filled('title') && !request()->filled('description') && !request()->hasFile('thumbnail') || !request()->filled('id')) {
            abort(400, 'No valid or filled request parameters.');
        } else {
            $topic = Topic::get()->where('id', request()->id)->first();
        }
        
        // Filter out empty request parameters
        $data = array_filter(request()->except('_token', 'id'), function($value) {
            return $value !== null && $value !== '';
        });

        // Replace the old thumbnail if a new one is uploaded.
        if (request()->hasFile('thumbnail')) {
            $this->thumbnailHelper->deleteThumbnail($topic->thumbnail_path);
            $thumbnailpath = $this->thumbnailHelper->saveThumbnail(request()->file('thumbnail'));
            $data['thumbnail_path'] = $topic->thumbnail_path = $thumbnailpath;
        }

        // Save the changes
        $topic->update($data);
        return redirect()->back();
    }

    // Delete
    public function deleteTopic() {
        $this->authorize('delete', Topic::class);
        $topic = Topic::get()->where('id', request()->id)->first();

        // Delete the thumbnail
        $this->thumbnailHelper->deleteThumbnail($topic->thumbnail_path);
        $topic->delete();
        return redirect()->back();
    }
}
