<?php
function image_generator($args_array)
{
    $img_pointers = array();
    $size = $args_array["images_size"];
    $sizes = array("heights"=>array(),"widths"=>array());
    foreach($args_array["pngs_input"] as $key=>$png)
    {
        $img_pointers[$key] = imagecreatefrompng($png);
        if($args_array["images_size"] != 0)
        {
            $img_pointers[$key]=imagescale($img_pointers[$key], $size, $size);
        }
        $sizes["widths"][] = imagesx($img_pointers[$key]);
        $sizes["heights"][] = imagesy($img_pointers[$key]);
    }
    $positions = calculate_positions($args_array, $sizes);
    $final_width=$positions["total"]["total_width"];
    $final_height=$positions["total"]["total_height"];
    $final_img=imagecreatetruecolor($final_width, $final_height);
    $color=imagecolorallocate($final_img, 255, 255, 255);
    imagefilledrectangle($final_img,0,0,$final_width,$final_height,$color);
    imagecolortransparent($final_img, $color);
    $final_img=cp_save($img_pointers,$final_img,$positions,$sizes);
    imagepng($final_img, "./".$args_array["file_names"]["output_img"]);
    imagedestroy($final_img);
    css_writing($sizes, $args_array, $positions);
}
function cp_save($img_pointers, $final_img, $positions, $sizes)
{
    foreach($img_pointers as $key=>$pointer_input)
    {
        $x_pos=$positions["individual_x"][$key];
        $y_pos=$positions["individual_y"][$key];
        imagecopy($final_img, $img_pointers[$key], $x_pos, $y_pos,
            0, 0, $sizes["widths"][$key], $sizes["heights"][$key]);
        imagedestroy($img_pointers[$key]);
    }
    return($final_img);
}
?>