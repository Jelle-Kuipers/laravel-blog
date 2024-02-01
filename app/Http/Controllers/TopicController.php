<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TopicController extends Controller {

    protected $user;

    public function __construct() {
        $this->user = Auth::user();
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
        $thumbnailpath = $this->saveThumbnail(request()->file('thumbnail'));
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
            $this->deleteThumbnail($topic->thumbnail_path);
            $thumbnailpath = $this->saveThumbnail(request()->file('thumbnail'));
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
        $this->deleteThumbnail($topic->thumbnail_path);
        $topic->delete();
        return redirect()->back();
    }

    // Function to validate incoming files. 
    // Returns the path to the file if it is valid.
    private function saveThumbnail($imgFile) {
        // Check if file exists and is an image
        if ($imgFile && $imgFile->isValid() && in_array($imgFile->getClientOriginalExtension(), ['svg', 'png', 'jpg', 'jpeg'])) {
            // Check image size
            if ($imgFile->getSize() <= 26214400) { //max 25MB
                // Check image dimensions
                $image = getimagesize($imgFile);
                $width = $image[0];
                $height = $image[1];
                if ($width >= 300 && $height >= 300 && $width <= 1920 && $height <= 1080) {
                    // Image meets all requirements, save it
                    $imgFilename = "FF-content-thumbnail-" . Carbon::now()->format('YmdHis') . "." . $imgFile->getClientOriginalExtension();
                    $imgFile->storeAs('public/thumbnails', $imgFilename);
                    $imageUrl = asset('storage/thumbnails/' . $imgFilename);
                    return $imageUrl;
                } else {
                    // Image dimensions are not within the specified range
                    abort(400, 'Image dimensions are not within the specified range.');
                }
            } else {
                // Image size is larger than 25MB
                abort(400, 'File is to big.');
            }
        } else {
            // File is not a valid image or does not exist
            abort(400, 'File is not a valid image or does not exist.');
        }
    }

    // Function to delete a thumbnail
    // Returns true if deleted, abort if not
    private function deleteThumbnail($filePath) {
        $domain = request()->getScheme() . '://' . request()->getHost();
        $filePath = public_path(str_replace($domain, '', $filePath));
        echo $filePath;
        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        } else {
            return false;
        }
    }
}
