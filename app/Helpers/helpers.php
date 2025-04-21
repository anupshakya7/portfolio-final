<?php

if(!function_exists('set_url')){
    function set_url($path){
        return config('app.url').'/'.$path;
    }
}
?>