
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
 use Html2image\Assets\html2Img;
 $html=file_get_contents('./index.html');// 'https://tieba.baidu.com/f?ie=utf-8&kw=%E5%90%89%E9%A6%99%E5%B1%85&fr=search'
 $path= $_SERVER['DOCUMENT_ROOT'].'/image/';
 $file_name=time();
 $html2img=new Html2img($path,$file_name);
 $html2img->getImage($html);
```

## 常见问题
- 图片上传路径一定要为绝对路径，否则图片会保存失败
- AJAX 提交重定向url 问题 路由规则不同，可能会出错
- .htaccess 重写URL RewriteRule ^base64_image_save.php$ assets/src/base64_image_save.php
