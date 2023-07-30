<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    public function index()
    {
       
        return view('index');
    }



}























 // $res = Storage::put('folder1/text5.txt','hello world!');
        // $res = Storage::get('folder1/text5.txt');
        // $res = Storage::exists('folder1/1.png');
        // $res = Storage::download('folder1/1.png','2.png';
        // $res = Storage::size('folder1/1.png');
        // $res = date('Y-M-d',Storage::lastModified('folder1/1.png'));
        // $res = Storage::url('folder1/1.png');
        // $res = Storage::path('folder1/1.png');
        // Storage::copy('folder1/1.png','folder2/5.png');
        // Storage::move('folder2/5.png','folder3/images/10.png');
        // Storage::delete('folder1/1.png');
        // Storage::deleteDirectory('foldertemp');
        // $res = Storage::files('folder1');
        // $res = Storage::allFiles('folder3');
        // $res = Storage::directories('');
        // $res = Storage::allDirectories('folder3');
        // Storage::makeDirectory('foldertemp');