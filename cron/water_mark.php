<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/2
 * Time: 22:40
 */

$dst_path = '1000000074_1504093422.jpg';

//创建图片的实例
$dst = imagecreatefromstring(file_get_contents($dst_path));
//$dst = imagecreatefrompng($dst_path);
//imagealphablending($dst, true);

//打上文字
$font = './simsun.ttc';//字体
$black = imagecolorallocate($dst, 0x00, 0x00, 0x00);//字体颜色
imagefttext($dst, 13, 0, 20, 20, $black, $font, 'www.juyitest.com');

//输出图片
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
switch ($dst_type) {
    case 1://GIF
        header('Content-Type: image/gif');
        imagegif($dst);
        break;
    case 2://JPG
        header('Content-Type: image/jpeg');
        imagejpeg($dst, $dst_path);
        break;
    case 3://PNG
        header('Content-Type: image/png');
        imagepng($dst, $dst_path);
        break;
    default:
        break;
}

imagedestroy($dst);