<?php
//require 'vendor/autoload.php';
use Html2image\Assets\html2Img;

/**
 * html：可以是html文件 或者网页URL 或者为参数 必填
 * $data 额外的参数 必填
 * $back_url 回调地址 必填
 */
 $html=file_get_contents('./index.html');// 'https://tieba.baidu.com/f?ie=utf-8&kw=%E5%90%89%E9%A6%99%E5%B1%85&fr=search'
 $path= $_SERVER['DOCUMENT_ROOT'].'/image/';
 $file_name=time();
 $data['path']=$path;
 $data['file_name']=$file_name;
 $back_url='/assets/src/base64_image_save.php';
 $html2img=new Html2img($back_url);
 $html2img->getImage($html,$data);
