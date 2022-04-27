<?php

function link_lista($elc, $name){
    return '<li><a href='.'"'.$elc.'">'.$name.'</a></li>';
}

function link_css($path){
    return "\n\t\t"."<link rel='stylesheet' type='text/css' href='{$path}'>";
}

function link_img($path, $alt){
    return "<img src='{$path}' alt='{$alt}' >";
}

function link_js($path){
    return "\n\t\t"."<script type='text/javascript' src='{$path}'></script>";
}

