<?php
function image_generator($output_img, $png_binder)
{
    $final_height = 0;
    $heights = array();
    foreach($png_binder as $key => $png)
    {
        $png_binder[$key] = imagecreatefrompng($png);
        if($final_height == 0)
        {
            $width_to_scale_on = imagesx($png_binder[0]);
        }
        $png_binder[$key] = imagescale($png_binder[$key], $width_to_scale_on);
        $final_height += imagesy($png_binder[$key]);
        $heights[] = imagesy($png_binder[$key]);
        if($png_binder[$key] == $png_binder[count($png_binder) - 1])
        {
            $final_img = imagecreatetruecolor($width_to_scale_on, $final_height);
        }
    }
    $final_img=cp_save($heights, $png_binder, $final_img, $width_to_scale_on);
    imagepng($final_img, $output_img);
}
function cp_save($heights, $png_binder, $final_img, $width_to_scale_on)
{
    $y_pos = 0;
    foreach($png_binder as $key => $pointer)
    {
        imagecopymerge($final_img, $png_binder[$key], 0, $y_pos, 0, 0,
            $width_to_scale_on, $heights[$key], 75);
        $y_pos += $heights[$key];
        imagedestroy($png_binder[$key]);
    }
    return $final_img;
}
?>