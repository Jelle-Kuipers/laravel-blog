<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permission;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TopicController extends Controller {
    public function allowTopicDashAccess() {
        if ($this->checkPermissions()) {
            return view('topicdash');
        } else {
            abort(404, 'Page not found.');
        };
    }

    private function checkPermissions() {
        $permissions = Permission::get()->where('id', Auth::user()->id)->first();
        if ($permissions->manage_topics == True) {
            return true;
        } else {
            return false;
        }
    }

    public function createTopic() {
        $topic = new Topic;
        // Check if required fields are filled
        if (!request()->title || !request()->description || !request()->thumbnail) {
            abort(400, 'Missing required fields.');
        }
        $topic->title = request()->title;
        $topic->description = request()->description;
        // Upload the thumbnail and get the path back
        $thumbnailpath = $this->saveThumbnail(request()->file('thumbnail'));
        $topic->thumbnail_path = $thumbnailpath;
        $topic->save();
        return redirect()->back();
    }

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
}
