<?php
function calculate_positions($args_array, $sizes)
{
    $stop=$args_array["columns_nbr"];
    $positions = array
    (
        "individual_x"=>array(),
        "individual_y"=>array(),
        "individual_css"=>array(),
        "total"=>array
        (
            "total_width"=>0,
            "total_height"=>0,
        )
    );
    $positions=loop_pos($args_array, $positions, $stop, $sizes);
    $nbr_pngs=count($sizes["heights"]);
    $positions["total"]["total_height"]+=max(
        array_slice($sizes["heights"],
            $nbr_pngs-$stop));
    return($positions);
}
function loop_pos($args_array, $positions, $stop, $sizes)
{
    $count=$x_pos=$y_pos=0;
    foreach($args_array["pngs_input"] as $key=>$png)
    {
        if($count%$stop!=0)
        {
            $x_pos+=$args_array["padding"];
        }
        $positions["individual_x"][]=$x_pos;
        $positions["individual_y"][]=$y_pos;
        $positions["total"]["total_width"]+=$sizes["widths"][$key]
            +$args_array["padding"];
        $positions["total"]["total_height"]=$y_pos;
        $positions["individual_css"][]=-$x_pos."px ".-$y_pos."px;";
        $x_pos+=$sizes["widths"][$key];
        $count++;
        if($count==$stop)
        {
            $widths[]=$positions["total"]["total_width"];
            $positions["total"]["total_width"]=0;
            $y_pos+=max(array_slice($sizes["heights"], $key+1-$stop, $stop));
            $y_pos+=$args_array["padding"];
            $count = $x_pos = 0;
        }
    }
    $positions["total"]["total_width"]=max($widths)-$args_array["padding"];
    return($positions);
}
?>