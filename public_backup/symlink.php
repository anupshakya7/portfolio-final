<?php

$target_path="/home/anupshakyacom/portfolio/storage/app/public";
$link_path="/home/anupshakyacom/public_html/storage";

if(!file_exists($link_path)){
    if(symlink($target_path,$link_path)){
        echo "Storage Linked Successfully!!!";
    }else{
        echo "Failed to Linked";
    }
}else{
    echo "Already Exists";
}
?>