<?php

function enlace($elc, $name){
    return '<li><a href='.'"'.$elc.'">'.$name.'</a></li>';
}

function link_css($app,$path){
    return "<link rel='stylesheet' type='text/css' href={$app->resuelve($path)}>". "\n\t\t";
}

function img($path, $alt){

}