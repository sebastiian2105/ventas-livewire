<?php
namespace App\Helpers;
class GlobalApp
{
    public static function saveFile($file, $folder_name)
    {
        $customFileName = uniqid() . '_.' . $file->extension();
        $file->storeAs('public/' . $folder_name, $customFileName);
        return $customFileName;
    }
}