<?php

function isUrl($str){
    if (filter_var($str, FILTER_VALIDATE_URL)) {
       return true;
    } 
    return false;
}