<?php
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//to day i will show you how to create some simple with ajax in your laravel application
//you need taskcontroller, task table and task model
Route::get('/', function () {
    return view('welcome');
});

Route::get('task/list', 'TaskController@index')->name('task.list');

//go to browser to test via http://localhost:8000/storage/gtx1060.jpg
Route::get('storage/{filename}', function($filename){
    $path = storage_path($filename);
    if ( !File::exists($path) ) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $headers = [
        'Content-Type' => $type
    ];
    //1st way to response an image
    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);
    return $response;

    //2nd way to response an image
    return Response::stream(function() use($file) {
        echo $file;
    }, 200, $headers);


});

Route::get('download-pdf/{filename}', function($filename){
    $path = storage_path('app/public/' . $filename);
    if ( !File::exists($path) ) {
        abort(404);
    }
    $headers= [
        'Content-Type' => 'application/pdf',
    ];
    //$file = File::get($path);
    $filenameNoExtension = pathinfo($path, PATHINFO_FILENAME);
    $filenameExtension = pathinfo($path, PATHINFO_EXTENSION);
    //dd($filenameNoExtension);
    return response()->download($path, $filenameNoExtension . '-' . date("Y-m-d") . '.' . $filenameExtension, $headers);
    //return Response::download($path, $filenameNoExtension . '-' . date("Y-m-d"), $headers);
});

Route::get('thumbnail/{filename}', function($filename){
    $path = storage_path($filename);
    if ( !File::exists($path) ) {
        abort(404);
    }
    $img = Image::make($path);
    $savePath = public_path() . '/thumnails/' . '100x100-' . $filename;
    $img->resize(100, 100, function ($constraint) {
        $constraint->aspectRatio();
    })->save($savePath);

    return Image::make($savePath)->response();

});