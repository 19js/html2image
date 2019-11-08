
# 简介
将html转换成图片，并保存到指定文件

## 环境要求
- PHP >= 7.0

## 安装
通过Composer安装:
```
composer require yangshuanlin/php-html2img
```

## 使用方法
```php
test.php 

use Html2image\Assets\html2Img;
/**
 * html：可以是html文件 或者网页URL 或者为参数  必填
 * $data 额外的参数 可不填
 * $back_url 回调地址 必填
 */
 $html=file_get_contents('./index.html');// 'https://tieba.baidu.com/f?ie=utf-8&kw=%E5%90%89%E9%A6%99%E5%B1%85&fr=search'
 $data['path']= $_SERVER['DOCUMENT_ROOT'].'/image/';
 $data['file_name']=time();
 $back_url='/assets/src/base64_image_save.php';
 $html2img=new Html2img($back_url);
 $html2img->getImage($html,$data);
```
```php   
base64_image_save.php 
<?php
//base64_image_save.php
  $poatdata=file_get_contents("php://input");
  $data=params_parse($poatdata);
  $rest=base64_image_content($data['base64data'],$data['path'],$data['file_name']);
  echo json_encode($rest);

/**
 * @param $base64_image_content  [要保存的Base64编码]
 * @param $path [图片要保存的路径 绝对路径]
 * @param string $file_name [图片文件名，不带后缀]
 * @return array
 * @throws Exception
 */
 function base64_image_content($base64_image_content,$path,$file_name=''){
     try {
         if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
             $type = $result[2];
             if(!file_exists($path)){
                 mkdir($path,0777,true);
             }
             $new_file = $path .$file_name . ".{$type}";
             $image_data = str_replace($result[1], '', $base64_image_content);
             $rest = file_put_contents($new_file, base64_decode($image_data));
             if ($rest) {
                 return ['code' => 1, 'msg' => '保存成功', 'img_path' => $new_file];
             } else {
                 return ['code' => 0, 'msg' => '保存失败'];
             }
         } else {
             return ['code' => 0, 'msg' => '参数错误'];
         }
     }catch (Exception $e){
        throw new Exception($e->getMessage());
     }
}

/**
 * 请求参数解析成数组格式
 * @param $data
 * @return mixed
 */
function params_parse($data){
     $param=explode('&',$data);
    foreach ($param as $k=>$v){
        $index=substr($v,0,strpos($v,'='));
        $temp[$index]=substr($v,strpos($v,'=')+1);;
    }
   return $temp;
}
```

## 常见问题
- 回调地址 接收参数的时候请用 file_get_contents("php://input")方法接收，避免编码中的特殊字符被转换，造成图片损坏
