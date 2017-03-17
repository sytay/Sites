<?php

namespace Sites\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use URL;
use Route,
    Redirect;

/**
 * Validators
 */
class AdminController extends Controller {

    public $data_view = array();
    private $obj_validator = NULL;

    public function __construct() {
        
    }

    public function addFlashMessage($message_key, $message_value) {
        \Session::flash($message_key, $message_value);
    }

    public function preview(String $filename) {

        $path = storage_path('app/public/images/') . $filename;

        $handler = new \Symfony\Component\HttpFoundation\File\File($path);
        $lifetime = 31556926; // One year in seconds



        $file_time = $handler->getMTime(); // Get the last modified time for the file (Unix timestamp)
        $header_content_type = $handler->getMimeType();

        $header_content_length = $handler->getSize();

        $header_etag = md5($file_time . $path);

        $header_last_modified = gmdate('r', $file_time);

        $header_expires = gmdate('r', $file_time + $lifetime);



        $headers = array(
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
            'Last-Modified' => $header_last_modified,
            'Cache-Control' => 'must-revalidate',
            'Expires' => $header_expires,
            'Pragma' => 'public',
            'Etag' => $header_etag
        );



        /**

         * Is the resource cached?

         */
        $h1 = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $header_last_modified;

        $h2 = isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == $header_etag;



        if ($h1 || $h2) {
            return Response::make('', 304, $headers); // File (image) is cached by the browser, so we don't have to send it again
        }



        $headers = array_merge($headers, array(
            'Content-Type' => $header_content_type,
            'Content-Length' => $header_content_length
        ));



        return Response::make(file_get_contents($path), 200, $headers);
    }

}
