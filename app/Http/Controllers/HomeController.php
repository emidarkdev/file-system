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
        $route = '';
        $directories = [];
        $files = [];

        foreach (Storage::directories() as $dir) {
            array_push($directories, [
                'name' => pathinfo(storage_path($dir))['filename'],
                'route' => $dir,
                'modify' => date('Y/m/d h:i:s', Storage::lastModified($dir)),
            ]);
        }
        foreach (Storage::files() as $file) {
            array_push($files, [
                'name' => pathinfo(storage_path($file))['filename'],
                'ext' => pathinfo(storage_path($file))['extension'],
                'filename' => pathinfo(storage_path($file))['filename'] . '.' . pathinfo(storage_path($file))['extension'],
                'size' => number_format(Storage::size($file) / 1048576, 2),
                'modify' => date('Y/m/d h:i:s', Storage::lastModified($file)),
                'route' => $file,
            ]);
        }
        return view('index', compact('directories', 'files', 'route'));
    }
    public function directory(Request $request)
    {

        $route = $request->get('route') ? $request->get('route') : '';
        $directories = [];
        $files = [];

        foreach (Storage::directories($route) as $dir) {
            array_push($directories, [
                'name' => pathinfo(storage_path($dir))['filename'],
                'route' => $dir,
                'modify' => date('Y/m/d h:i:s', Storage::lastModified($dir)),
            ]);
        }
        foreach (Storage::files($route) as $file) {
            array_push($files, [
                'name' => pathinfo(storage_path($file))['filename'],
                'ext' => pathinfo(storage_path($file))['extension'],
                'filename' => pathinfo(storage_path($file))['filename'] . '.' . pathinfo(storage_path($file))['extension'],
                'size' => number_format(Storage::size($file) / 1048576, 2),
                'modify' => date('Y/m/d h:i:s', Storage::lastModified($file)),
                'route' => $file,
            ]);
        }
        return view('index', compact('directories', 'files', 'route'));
    }


    public function deleteFile(Request $request)
    {
        $route = $request->get('route');
        $checkDir = Storage::directoryExists($route);
        if ($checkDir) {
            Storage::deleteDirectory($route);
        } else {
            Storage::delete($route);
        }

        return redirect()->back();
    }
    public function moveFile(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $filename = explode('/',$from)[count(explode('/',$from))-1];
        if (trim($to) == '/') {
            Storage::move($from, $filename);
        }else{
            Storage::move($from, $to.'/'.$filename);
        }
        return redirect()->back();
    }
    public function changeName(Request $request)
    {
        $route = $request->get('route');
        $name = $request->get('name');
        $checkDir = Storage::directoryExists($route);

        if($checkDir){
            $route_params = explode('/',$route);
            array_pop($route_params);
            $base_route = implode('/',$route_params);
            Storage::move($route,$base_route.'/'.$name);
        }else{
            $route_params = explode('/',$route);
            array_pop($route_params);
            $filename = explode('/',$route)[count(explode('/',$route))-1];
            $filename = explode('.',$filename);
            $file_extension = $filename[1];
            array_push($route_params,$name.'.'.$file_extension);
            $newRoute = implode('/',$route_params);
            Storage::move($route,$newRoute);
        }
        
        return redirect()->back();
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