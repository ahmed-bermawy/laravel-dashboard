<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    public function uploadImage(Request $request, $dbTableName, $imageColumn, $id, $path)
    {
        if ($request->hasFile($imageColumn)) {
            // append timestamp to image name
            $controllerName = time() . '_' . $request->$imageColumn->getClientOriginalName();
            // move image to folder path
            $request->$imageColumn->move(public_path($path), $controllerName);
            // save image
            return DB::table($dbTableName)->where('id', $id)->update([$imageColumn => $controllerName]);
        }
    }

    public function updateImage(Request $request, $dbTableName, $imageColumn, $id, $path)
    {
        if ($request->hasFile($imageColumn)) {
            // append timestamp to image name
            $controllerName = time() . '_' . $request->$imageColumn->getClientOriginalName();
            // move image to folder path
            $request->$imageColumn->move(public_path($path), $controllerName);
            // get item data
            $object = DB::table($dbTableName)->where('id', $id)->first();
            // delete old image file
            if ($object->$imageColumn) {
                \File::delete(public_path('uploads/profiles/') . $object->$imageColumn);
            }
            // save new image
            return DB::table($dbTableName)->where('id', $id)->update([$imageColumn => $controllerName]);
        }
    }

    public function uploadFile(Request $request, $dbTableName, $fileColumn, $id, $path)
    {
        if ($request->hasFile($fileColumn)) {
            // append timestamp to file name
            $controllerName = time() . '_' . $request->$fileColumn->getClientOriginalName();
            // move file to folder path
            $request->$fileColumn->move(public_path($path), $controllerName);
            // save file
            return DB::table($dbTableName)->where('id', $id)->update([$fileColumn => $controllerName]);
        }
    }

    public function updateFile(Request $request, $dbTableName, $fileColumn, $id, $path)
    {
        if ($request->hasFile($fileColumn)) {
            // append timestamp to file name
            $controllerName = time() . '_' . $request->$fileColumn->getClientOriginalName();
            // move file to folder path
            $request->$fileColumn->move(public_path($path), $controllerName);
            // get item data
            $object = DB::table($dbTableName)->where('id', $id)->first();
            // delete old  file
            if ($object->$fileColumn) {
                \File::delete(public_path('uploads/profiles/') . $object->$fileColumn);
            }
            // save new image
            return DB::table($dbTableName)->where('id', $id)->update([$fileColumn => $controllerName]);
        }
    }

}
