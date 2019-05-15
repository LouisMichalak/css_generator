<?php
function check_syntax_for_options($good_keywds, $argv, $argc)
{
    for($key_for_arg = 1; $key_for_arg < $argc; $key_for_arg++)
    {
        $equal_pos=strpos($argv[$key_for_arg], "=");
        $before_equal=substr($argv[$key_for_arg],0,$equal_pos);
        if(strpos($argv[$key_for_arg], "--")==0 &&
           in_array($before_equal, $good_keywds))
        {
        }
        elseif(substr($argv[$key_for_arg], 0, 1) == "-"
            && !in_array($argv[$key_for_arg], $good_keywds))
        {
            echo "I don't understand the command \"$argv[$key_for_arg]\"".
                ", check the manual with the option: -m, --man" . PHP_EOL;
            exit(84);
        }
    }
}
function check_syntax_for_file_names($args_array)
{
    $exit = false;
    $output_style=$args_array["file_names"]["output_style"];
    $output_img=$args_array["file_names"]["output_img"];
    if(substr($output_style, -4) != ".css")
    {
        echo "The name of output CSS file \"$output_style\" syntax".
            " isn't correct, file's name has to end by \".css\"." . PHP_EOL;
        $exit = true;
    }
    if(substr($output_img, -4) != ".png")
    {
        echo "The name of output image file \"$output_img\" syntax".
            " isn't correct, file's name has to end by \".png\"." . PHP_EOL;
        $exit = true;
    }
    if($exit)
    {
        exit(84);
    }
}
?>