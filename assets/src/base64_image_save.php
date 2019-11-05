<?php
//base64_image_save.php
  $base64Data=$_POST['base64data'];
  $path='./image';//$_POST['path'];
   base64_image_content($base64Data,$path);
/**
 * [将Base64图片转换为本地图片并保存]
 * @param $base64_image_content [要保存的Base64]
 * @param $path [要保存的路径]
 * @return bool|string
 */
 function base64_image_content($base64_image_content,$path){
    //匹配出图片的格式
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
        $type = $result[2];
        $new_file = $path."/".date('Ymd',time())."/";
        if(!file_exists($new_file)){
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mkdir($new_file, 0700);
          }
         $new_file = $new_file.time().".{$type}";
        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
            return ['code'=>1,'msg'=>'保存成功','img_path'=>$new_file];
        }else{
            return  ['code'=>0,'msg'=>'保存失败'];
        }
    }else{
        return  ['code'=>0,'msg'=>'参数错误'];
    }
}

