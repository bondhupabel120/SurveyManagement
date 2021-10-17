<?php

namespace App\Libraries;

class CommonFunction
{
    public static function getProjectRootDirectory()
    {
        return base_path();
    }
    public static function getImageFromURL($db_path, $local_path = null, $id = null, $width = '100px', $height = '100px')
    {
        $file_path = (string)($local_path . $db_path);
        if (is_file($file_path)) {
            return '<img class="img-thumbnail" src="' . asset($file_path) . '" alt="Something" style="width: ' . $width . '; height: ' . $height . ';" id="' . $id . '" />';
        } else {
            return "<img class='img-thumbnail' src='" . asset('assets/admin/img/no_image_found.png') . "' alt='Image not found' style='width: $width; height: $height;' id='$id'>";
        }
    }
    public static function imageDelete($file_path)
    {
        if (file_exists($file_path)) {
            @unlink($file_path);
        }
    }
    public static function getStatus($status)
    {
        if (!empty($status) && $status == 1) {
            $class = "btn btn-success btn-xs";
            $status = 'Active';
        } else {
            $class = 'btn btn-danger btn-xs';
            $status = 'Inactive';
        }
        return '<span class="' . $class . '">' . $status . '</span>';
    }
    public static function showErrorPublic($param, $msg = 'Sorry! Something went wrong! ')
    {
        $j = strpos($param, '(SQL:');
        if ($j > 15) {
            $param = substr($param, 8, $j - 9);
        }
        return $msg . $param;
    }
}
