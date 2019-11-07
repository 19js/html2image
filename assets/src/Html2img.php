<?php

namespace Html2image\Assets;
class Html2img
{

    //图片保存 请求地址
    protected $host;
    //图片保存路径   绝对路径
    protected  $path;
    //图片名称，不包括后缀
    protected $file_nmae;
    public function __construct($path='',$file_nmae='')
    {
//$_SERVER['HTTP_HOST'].
        $this->host='/base64_image_save.php';//'/assets/src/base64_image_save.php'
        $path==""? $this->path='/image/':$this->path=$path;
        $file_nmae==""?  $this->file_nmae=time():$this->file_nmae=$file_nmae;
    }

    /**
     * 将html生成64位编码，然后再解码以图片的形式保存在指定文件中
     * @param $html [可以是html文件 或者远程网页URL]
     */
    public  function getImage($html){
        //引入js文件
      $js=file_get_contents(dirname(dirname(__FILE__)).'/html2canvas.js');
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
　　        xhr.open('POST',url,true);
　        　xhr.send('base64data='+data+'&path='+'".$this->path."'+'&file_nmae='+ '".$this->file_nmae."');
　        　xhr.onreadystatechange = function(){
　　　　    if (xhr.readyState == 4) {//证明服务器已经准备就绪
　　　　　　if (xhr.status == 200) {//页面请求成功
            //取得返回的数据
            console.log('请求参数：',xhr)
            //请求返回的参数
            var res=JSON.parse(xhr.responseText);
                if(res.code==1){
                    //图片保存路径
                    var img_path=res.img_path;
                 }
　　　　　　    }
　　　　      }
　　       }
        }
       </script>
     ";
      echo  $html.$str;
  }
}
