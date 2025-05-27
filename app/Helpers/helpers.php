<?php

if(!function_exists('set_url')){
    function set_url($path){
        return config('app.url').'/'.$path;
    }
}

if(!function_exists('set_storage_url')){
    function set_storage_url($path){
        $storageLink = config('app.url').'/storage/'.$path;
        return str_replace('\\','/',$storageLink);
    }
}
?>