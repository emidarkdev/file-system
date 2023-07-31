<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{

    public function index()
    {
        $route = '/';
        $directories = [];
        $files = [];
        $imageExtensions = ['png', 'jpg', 'jpeg', 'gif'];

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
        return view('index', compact('directories', 'files', 'route', 'imageExtensions'));
    }




    public function directory(Request $request)
    {

        $route = $request->get('route') ? $request->get('route') : '/';
        $directories = [];
        $files = [];
        $imageExtensions = ['png', 'jpg', 'jpeg', 'gif'];
        foreach (Storage::directories($route) as $dir) {
            array_push($directories, [
                'name' => pathinfo(storage_path($dir))['filename'],
                'route' => $dir,
                'modify' => date('Y/m/d', Storage::lastModified($dir)),
            ]);
        }
        foreach (Storage::files($route) as $file) {
            array_push($files, [
                'name' => pathinfo(storage_path($file))['filename'],
                'ext' => pathinfo(storage_path($file))['extension'],
                'filename' => pathinfo(storage_path($file))['filename'] . '.' . pathinfo(storage_path($file))['extension'],
                'size' => number_format(Storage::size($file) / 1048576, 2),
                'modify' => date('Y/m/d', Storage::lastModified($file)),
                'route' => $file,
            ]);
        }
        return view('index', compact('directories', 'files', 'route', 'imageExtensions'));
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
        $filename = explode('/', $from)[count(explode('/', $from)) - 1];
        if (trim($to) == '/') {
            Storage::move($from, $filename);
        } else {
            Storage::move($from, $to . '/' . $filename);
        }
        return redirect()->back();
    }





    public function changeName(Request $request)
    {
        $route = $request->get('route');
        $name = $request->get('name');
        $checkDir = Storage::directoryExists($route);

        if ($checkDir) {
            $route_params = explode('/', $route);
            array_pop($route_params);
            $base_route = implode('/', $route_params);
            Storage::move($route, $base_route . '/' . $name);
        } else {
            $route_params = explode('/', $route);
            array_pop($route_params);
            $filename = explode('/', $route)[count(explode('/', $route)) - 1];
            $filename = explode('.', $filename);
            $file_extension = $filename[1];
            array_push($route_params, $name . '.' . $file_extension);
            $newRoute = implode('/', $route_params);
            Storage::move($route, $newRoute);
        }

        return redirect()->back();
    }




    public function createDir(Request $request)
    {
        $route = $request->get('route');
        $name = $request->get('name');


        Storage::makeDirectory($route . '/' . $name);
        return redirect()->back();
    }



    public function uploadShow(Request $request)
    {
        $route  = $request->get('route');
        return view('upload', compact('route'));
    }


    public function uploadText(Request $request)
    {
        $route  = $request->get('route');
        return view('uploadTx', compact('route'));
    }



    public function upload(Request $request)
    {
        $image  = $request->file('image');
        $text = $request->text;
        $text_file = $request->text_file;
        $mark  = $request->has('mark') ? ($request->mark == 'on' ? true : false) : null;
        $route  = $request->route;

        if ($image) {
            $imageName = Str::random(8) . '-' . explode('.', $image->getClientOriginalName())[0] . '.' . $image->extension();
            if ($mark) {
                $watermark = public_path('files/watermark.png');
                $mainImage = Image::make($request->file('image')->getRealPath());
                $mainImage->insert($watermark, 'top-left', 20, 20);
                $mainImage->save(public_path('storage/'.$route.'/'.$imageName));
            } else {
                Storage::putFileAs($route, $image, $imageName);
            }
        } else {
            if ($text) {
                $fileName = Str::random(8) . '.' . 'txt';
                Storage::put(trim($route, '/') . '/' . $fileName, $text);
            }
            if ($text_file) {
                $ext = $text_file->extension() == null ? 'txt' : $text_file->extension();
                $fileName = Str::random(8) . '-' . explode('.', $text_file->getClientOriginalName())[0] . '.' . $ext;
                Storage::putFileAs($route, $text_file, $fileName);
            }
        }
        return redirect("/directory?route={$route}");
    }

    public function editTx(Request $request)
    {
        $route =  $request->get('route');
        $text_info = pathinfo(Storage::url($route));
        $text_info['text'] = Storage::get($route);
        return view('editTx', compact('text_info', 'route'));
    }



    public function updateTx(Request $request)
    {
        $route =  $request->get('route');
        $dir_route = explode('/', $route);
        array_pop($dir_route);
        $dir_route = implode('/', $dir_route);
        $text =  $request->get('text');

        Storage::put($route, $text);

        return redirect("/directory?route={$dir_route}");
    }


    public function showFile(Request $request)
    {
        $route  = $request->get('route');
        $fileInfo = pathinfo(Storage::url($route));
        $imageExtensions = ['png', 'jpg', 'jpeg', 'gif'];

        if (array_search($fileInfo['extension'], $imageExtensions) === false) {
            $text = Storage::get($route);
            return view('viewText', compact('text', 'route'));
        } else {
            $imageUrl = Storage::url($route);
            return view('viewimage', compact('imageUrl', 'route'));
        }
    }

    public function createMark(Request $request)
    {
        dd($request->all());
    }


    public function selectActions(Request $request)
    {

        $move_path = $request->move_path;
        $action = $request->action;
        $dirs  = $request->dirs;
        $files  = $request->get('files');

        if ($move_path) {
            if ($dirs) {
                foreach ($dirs as $dir => $value) {
                    $fileName = explode('/', $dir)[count(explode('/', $dir)) - 1];
                    Storage::move($dir, $move_path . '/' . $fileName);
                }
            }
            if ($files) {
                foreach ($files as $file => $value) {
                    $fileName = explode('/', $file)[count(explode('/', $file)) - 1];
                    Storage::move($file, $move_path . '/' . $fileName);
                }
            }
            return redirect()->back();
        } else {
            if ($action == 'delete') {
                if ($dirs) {
                    foreach ($dirs as $dir => $value) {
                        Storage::deleteDirectory($dir);
                    }
                }
                if ($files) {
                    foreach ($files as $file => $value) {
                        Storage::delete($file);
                    }
                }
                return redirect()->back();
            }
            if ($action == 'download') {
                dd($request->all());
            }
        }
    }

    public function download(Request $request)
    {
        $route = $request->get('route');
        $checkDir = Storage::directoryExists($route);

        if ($checkDir) {
            // folder
        } else {
            $fileName = explode('/', $route)[count(explode('/', $route)) - 1];
            return Storage::download($route, $fileName);
        }
    }
};




















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