<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function index(){

        $content = App::make('url')->to(Storage::url('.well-known/pki-validation/AF5501DA92567D7EE44AAFC356BB1D26.txt'));
        $filename = 'AF5501DA92567D7EE44AAFC356BB1D26.txt';
        $headers = array(
            'Content-Type' => 'plain/txt',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            'Content-Length' => sizeof($content),
        );
        return response($content,200,$headers);
        // return response('hello world')->header('Content-Type', 'text/plain');

    }
      
}
