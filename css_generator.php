<?php
include ".css_generator_software/args_linked_functions/set_args.php";
include ".css_generator_software/args_linked_functions/check_syntax.php";
include ".css_generator_software/args_linked_functions/scandir_r.php";
include ".css_generator_software/sprite_gen_functions/img_generator.php";
include ".css_generator_software/sprite_gen_functions/pos_img_calculate.php";
include ".css_generator_software/css_writing_functions/css_writing.php";
function interface_init_args($argv, $argc)
{
    if(!is_dir($argv[$argc-1]))
    {
        echo "Folder not found." . PHP_EOL;
        exit(84);
    }
    $args_array = array
    (
        "file_names"=>array
        (
            "output_img"=>"sprite.png",
            "output_style"=>"style.css"
        ),
        "pngs_input"=>search($argv[$argc-1], false),
        "padding"=>0,
        "images_size"=>0,
        "columns_nbr"=>1,
    );
    $good_keywds=set_good_kwds();
    check_syntax_for_options($good_keywds, $argv, $argc);
    $args_array = set_args($argv, $argc, $args_array);
    $args_array = set_bonus_args($argv, $args_array);
    $args_array = set_long_args($argv, $args_array);
    if($args_array["columns_nbr"]>count($args_array["pngs_input"]))
    {
        $args_array["columns_nbr"]=count($args_array["pngs_input"]);
    }
    check_syntax_for_file_names($args_array);
    image_generator($args_array);
    return(0);
}
function set_good_kwds()
{
    $good_keywds = array
    (
        "-i",
        "--output-image",
        "-s",
        "--output-style",
        "-r",
        "--recursive",
        "-p",
        "--padding",
        "-o",
        "--override-size",
        "-c",
        "--columns-number",
        "-m",
        "--man"
    );
    return($good_keywds);
}
interface_init_args($argv, $argc);
?>