<?php

function enlace($elc, $name){
    return '<li><a href='.'"'.$elc.'">'.$name.'</a></li>';
}

function link_css($path){
    return "<link rel='stylesheet' type='text/css' href={$path}>". "\n\t\t";
}

function img($path, $alt){
    return "<img src='{$path} alt='{$alt} >";

}

