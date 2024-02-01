<?php 

namespace App\Helpers;
use Carbon\Carbon;

class ThumbnailHelper {
    
    // Function to validate incoming files. 
    // Returns the path to the file if it is valid.
    public function saveThumbnail($imgFile) {
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
    public function deleteThumbnail($filePath) {
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