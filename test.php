<?php
$html=file_get_contents('./index.html');
require 'vendor/autoload.php';
use Html2image\Assets\html2Img;
 $html2img=new Html2img();

$html2img->getImage($html);
