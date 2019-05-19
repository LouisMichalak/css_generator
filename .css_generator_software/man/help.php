<?php
function man()
{
    echo "\n\033[1mNAME\033[0m";
    echo "\n\tcss_generator - sprite generator for HTML use\n";
    echo "\n\033[1mSYNOPSYS\033[0m";
    echo "\n\tcss_generator [OPTIONS]. . . assets_folder\n";
    echo "\n\033[1mDESCRIPTION\033[0m\n";
    echo "\tConcatenate all images inside a folder in one sprite and write";
    echo " a style sheet ready to use.\n\tMandatory arguments to long options";
    echo " are mandatory for short options too.";
    echo "\n\n\033[1mCOMMANDS\033[0m\n\t\033[1m-r, --recursive\n";
    echo "\t\t\033[0mLook for images into the assets_folder";
    echo " passed as argument and all of its subdirectories.\n\n\t";
    echo "\033[1m-i, --output-image=IMAGE\n\t\t\033[0m";
    echo "Name of the generated image. If blank,";
    echo " the default name is « sprite.png ».\n\n\t";
    echo "\033[1m-s, --output-style=STYLE\n\033[0m\t\tName of the generated ";
    echo "stylesheet. If blank, the default name is « style.css ».\n\n\t";
    echo "\033[1m-p, --padding=NUMBER\n";
    echo "\t\t\033[0mAdd padding between images of NUMBER pixels.\n\n";
    echo "\t\033[1m-o, --override-size=SIZE\n";
    echo "\t\t\033[0mForce each images of the sprite to fit a";
    echo " size of SIZExSIZE pixels.\n\n";
    echo "\t\033[1m-c, --columns_number=NUMBER\n";
    echo "\t\t\033[0mThe number of elements to be";
    echo " generated horizontally.\n";
    echo "\n\t\033[1m-m, --man\n\t\t\033[0mTo view the info about ";
    echo "the CSS Generator and visualize the command list.\n";
}
?>