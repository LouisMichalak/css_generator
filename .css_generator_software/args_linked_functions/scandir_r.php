<?php
function search($assets_folder, $recursivity)
{
    $pointer_dir = opendir($assets_folder);
    if(substr($assets_folder, -1) != "/")
    {
        $assets_folder .= "/";
    }
    $array_pngs = array();
    while($actual_exit = readdir($pointer_dir))
    {
        if(substr($actual_exit, -4) == ".png")
        {
            $array_pngs[] = $assets_folder.$actual_exit;
        }
        if(is_dir($assets_folder.$actual_exit) && $recursivity === true
            && $actual_exit != "." && $actual_exit != "..")
        {
            $array_pngs = array_merge
            (
                $array_pngs,
                search($assets_folder.$actual_exit, true)
            );
        }
    }
    closedir($pointer_dir);
    return $array_pngs;
}
?>