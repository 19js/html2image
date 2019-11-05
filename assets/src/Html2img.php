<?php

namespace Html2image\Assets;
class Html2img
{

    protected $host;
    protected  $path;
    public function __construct($path='')
    {
      $this->host='./assets/src/base64_image_save.php';
        $path==""? $this->path='./image/':$this->path=$path;
    }

    public  function html2Img(){

     }
    public  function getImage($html){
      $js=file_get_contents('./assets/html2canvas.js');
      $str="<script >".$js."</script>";
      $str .=";
        <script>
            html2canvas(document.body).then(function(canvas) {
               var k=canvas.toDataURL();
                console.log(k);
                sendData(k);
            });
            
       function sendData(data) {
　        　var xhr = new XMLHttpRequest();
            var url=' ".$this->host." ';
　　        xhr.open('post',url,true);
　        　xhr.send('base64data='+data+'&path='+ ' ".$this->path. " ' );
　        　xhr.onreadystatechange = function(){
　　　　    if (xhr.readyState == 4) {//证明服务器已经准备就绪
　　　　　　 if (xhr.status == 200) {//页面请求成功
　　　　　　　    console.log('请求成功',xhr);
            //取得返回的数据
            var data = xhr.responseText;
            //json字符串转为json格式
                 data = eval(data);
　　　　　　      }
　　　　       }
　　         }
           } ;
          </script>
        ";
      echo  $html.$str;
  }

  public static function test(){
      echo "测试";
  }

}
