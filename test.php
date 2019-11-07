<?php
require 'vendor/autoload.php';
use Html2image\Assets\html2Img;

//html：可以是html文件 或者网页URL 或者为参数
 $html=file_get_contents('./index.html');// 'https://tieba.baidu.com/f?ie=utf-8&kw=%E5%90%89%E9%A6%99%E5%B1%85&fr=search'
 $path= $_SERVER['DOCUMENT_ROOT'].'/image/';
 $file_name=time();
 $html2img=new Html2img($path,$file_name);
 $html2img->getImage($html);
