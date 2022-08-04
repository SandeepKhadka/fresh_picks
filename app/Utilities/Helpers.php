<?php

function uploadImage($file, $upload_dir, $thumb=null){

    $upload_path = public_path(). '/uploads/'.$upload_dir;
    if (File::exists($upload_path)){
        File::makeDirectory($upload_path, 0777, true, true);
    }

    $file_name = ucfirst($upload_dir). "-" .date('Ymdhis').rand(0,999). "." . $file->getClientOriginalExtension();

    $success = $file->move($upload_path, $file_name);
    if ($success){
        if ($thumb !== null){
            list($width, $height) = explode('x', $thumb);
            Image::make($upload_path. '/'. $file_name)->resize($width,$height, function ($constraints){
                $constraints->aspectRatio();
            })->save($upload_path.'/Thumb-'.$file_name);
            return $file_name;
        }else{
            return false;
        }
    }
}
