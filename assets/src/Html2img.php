<?php

namespace Html2image\Assets;
class Html2img
{

    //图片保存 请求地址
    protected $host;
    public function __construct($url)
    {
        $this->host=$url;
    }

    /**
     * 将html生成64位编码，然后再解码以图片的形式保存在指定文件中
     * @param $html [可以是html文件 或者远程网页URL] 必填
     * @param $data [回调请求需要穿的参数 数组] 必填
     */
    public  function getImage($html,$data){
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
　        　xhr.send('base64data='+data+'&".http_build_query($data)."');
　        　xhr.onreadystatechange = function(){
　　　　    if (xhr.readyState == 4) {//证明服务器已经准备就绪
　　　　　　if (xhr.status == 200) {//页面请求成功
            //取得返回的数据
            console.log('请求参数：',xhr)
            //请求返回的参数
            //var res=JSON.parse(xhr.responseText);
               
　　　　　　    }
　　　　      }
　　       }
        }
       </script>
     ";
      echo  $html.$str;
  }
}
