<?php
include ".css_generator_software/scandir_r.php";
include ".css_generator_software/img_generator.php";
function detect_args($argv, $argc)
{
    $output_img = "sprite.png";
    $output_style = "style.css";
    $assets_folder = $argv[$argc - 1];
    check_syntax_for_options($argv, $argc);
    if(in_array("-i", $argv) || in_array("--output-image", $argv))
    {
        $keywd = array("-i", "--output-image");
        $output_img = $argv[get_key($argv, $keywd)];
    }
    if(in_array("-s", $argv) || in_array("--output_style", $argv))
    {
        $keywd = array("-s", "--output-style");
        $output_style = $argv[get_key($argv, $keywd)];
    }
    check_syntax_for_file_names($output_style, $output_img, $assets_folder);
    if(in_array("-r", $argv) || in_array("--recursive", $argv))
    {
        $png_binder = search($assets_folder, true);
    }
    else
    {
        $png_binder = search($assets_folder, false);
    }
    initialization($output_img, $output_style, $png_binder);
}
function initialization($output_img, $output_style, $png_binder)
{
    image_generator($output_img, $png_binder);
}
function get_key($argv, $keywd)
{
    $stop_value = false;
    foreach($argv as $key_for_arg => $arg)
    {
        if(in_array($arg, $keywd))
        {
            $stop_value = true;
        }
        elseif($stop_value)
        {
            return $key_for_arg;
        }
    }
}
function check_syntax_for_options($argv, $argc)
{
    $good_keywds = array
    (
        "-i",
        "--output-image",
        "-s",
        "--output-style",
        "-r",
        "--recursive"
    );
    for($key_for_arg = 1; $key_for_arg < $argc; $key_for_arg++)
    {
        if(substr($argv[$key_for_arg], 0, 1) == "-"
            && !in_array($argv[$key_for_arg], $good_keywds))
        {
            echo "I don't understand the command \"$argv[$key_for_arg]\"".
            ", check the manual with the command: " . PHP_EOL;
            #INSERER LA COMMANDE QUI SERA LE MANUEL
            exit(84);
        }
    }/*PENSER A FAIRE UNE FONCTION QUI COMPARE LES STRING AVEC LES COMMANDES PROBABLES
ET PENSER A FAIRE UNE PROPOSITION D'UTILISATION*/
}
function check_syntax_for_file_names($output_style, $output_img, $assets_folder)
{
    $exit = false;
    if(substr($output_style, -4) != ".css")
    {
        echo "The name of output CSS file \"$output_style\" syntax isn't correct,".
            " file's name has to end by \".css\"." . PHP_EOL;
        $exit = true;
    }
    if(substr($output_img, -4) != ".png")
    {
        echo "The name of output image file \"$output_img\" syntax isn't correct,".
            " file's name has to end by \".png\"." . PHP_EOL;
        $exit = true;
    }
    if(!is_dir($assets_folder))
    {
        echo "Folder not found." . PHP_EOL;
        $exit = true;
    }
    if($exit)
    {
        exit(84);
    }
}
detect_args($argv, $argc);
?>