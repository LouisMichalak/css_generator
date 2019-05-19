<?php
function set_args($argv, $argc, $args_array)
{
    if(in_array("-m", $argv) || in_array("--man", $argv))
    {
        echo file_get_contents(".css_generator_software/man.txt");
        exit();
    }
    if(in_array("-i", $argv))
    {
        $args_array["file_names"]["output_img"]=$argv[get_key($argv, "-i")];
    }
    if(in_array("-s", $argv))
    {
        $args_array["file_names"]["output_style"]=$argv[get_key($argv, "-s")];
    }
    if(in_array("-r", $argv) || in_array("--recursive", $argv))
    {
        $args_array["pngs_input"]=search($argv[$argc-1], true);
    }
    $args_array=set_bonus_args($argv, $args_array);
    $args_array=set_long_args($argv, $args_array);
    return($args_array);
}
function set_bonus_args($argv, $args_array)
{
    if(in_array("-p", $argv))
    {
        $args_array["padding"] = $argv[get_key($argv, "-p")];
    }
    if(in_array("-o", $argv))
    {
        $args_array["images_size"] = $argv[get_key($argv, "-o")];
    }
    if(in_array("-c", $argv))
    {
        $args_array["columns_nbr"] = $argv[get_key($argv, "-c")];
    }
    return($args_array);
}
function set_long_args($argv, $args_array)
{
    foreach($argv as $key=>$arg)
    {
        if(strpos($arg, "--") == 0)
        {
            $args_array=switch_long_args($args_array, $arg);
        }
    }
    return($args_array);
}
function switch_long_args($args_array, $arg)
{
    switch($arg)
    {
        case (strpos($arg, "image") !== false):
            $arg_to_set=substr($arg,strpos($arg, "=")+1);
            $args_array["file_names"]["output_img"]=$arg_to_set;
            break;
        case (strpos($arg, "style") !== false):
            $arg_to_set=substr($arg,strpos($arg, "=")+1);
            $args_array["file_names"]["output_style"]=$arg_to_set;
            break;
        case (strpos($arg, "padding")!== false):
            $arg_to_set=substr($arg,strpos($arg, "=")+1);
            $args_array["padding"]=$arg_to_set;
            break;
        case (strpos($arg, "size")!== false):
            $arg_to_set=substr($arg,strpos($arg, "=")+1);
            $args_array["images_size"]=$arg_to_set;
            break;
        case (strpos($arg, "columns")!== false):
            $arg_to_set=substr($arg,strpos($arg, "=")+1);
            $args_array["columns_nbr"]=$arg_to_set;
            break;
    }
    return($args_array);
}
function get_key($argv, $kwd)
{
    $stop_value = false;
    foreach($argv as $key_for_arg => $arg)
    {
        if($arg == $kwd)
        {
            $stop_value = true;
        }
        elseif($stop_value)
        {
            return $key_for_arg;
        }
    }
}
?>