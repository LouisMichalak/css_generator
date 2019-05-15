<?php
function css_writing($sizes, $args_array, $positions)
{
    $output_style = $args_array["file_names"]["output_style"];
    $output_style = fopen($output_style, "w+");
    $str="background-image: url(".$args_array["file_names"]["output_img"].");";
    fwrite($output_style, ".sprite {\n\t$str");
    fwrite($output_style, "\n\tbackground-repeat: no-repeat;");
    fwrite($output_style, "\n\tdisplay: block;\n}");
    foreach ($args_array["pngs_input"] as $key => $png)
    {
        fwrite($output_style, "\n\n.sprite-");
        fwrite($output_style, pathinfo($png, PATHINFO_FILENAME) . " {");
        fwrite($output_style, "\n\twidth: ".$sizes["widths"][$key]."px;");
        fwrite($output_style, "\n\theight: ".$sizes["heights"][$key]."px;");
        fwrite($output_style, "\n\tbackground-position: ");
        fwrite($output_style, $positions["individual_css"][$key]);
        fwrite($output_style, "\n}");
    }
    fclose($output_style);
}
?>