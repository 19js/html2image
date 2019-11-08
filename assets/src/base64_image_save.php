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
