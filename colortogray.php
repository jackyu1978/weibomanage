<?php

/**
 * @author Jack
 * @copyright 2013
 * @date 2013年5月24日
 * 将彩色图片转换为灰度图
 */

$im = imagecreatefromjpeg('./images/pincode.jpeg');
if ($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
{
    echo 'Image converted to grayscale.';
    imagejpeg($im, './images/result1.jpeg');
} else
{
    echo 'Conversion to grayscale failed.';
}
imagedestroy($im);

$im = imagecreatefromjpeg('./images/pincode.jpeg');//如果是Gif用imagecreatefromgif，PNG用imagecreatefrompng……
if (imageistruecolor($im)) {
    imagetruecolortopalette($im, false, 256);//如果是真彩色图象，将真彩色图像转换为调色板图像
}
for ($i = 0; $i < imagecolorstotal($im);/*获得调色板中颜色的数目*/ $i++){
    $rgb = imagecolorsforindex($im, $i);//获得颜色i点的颜色值
    $gray = round(0.229 * $rgb['red'] + 0.587 * $rgb['green'] + 0.114 * $rgb['blue']);//获得颜色灰度值
    imagecolorset($im, $i, $gray, $gray, $gray);//设置i点颜色值
}
imagejpeg($im, './images/result1.jpeg');//输出图象，如果是gif就用imagegif，如果是png就用imagepng……
imagedestroy($im);//销毁图象，释放资源


$im = imagecreatefromjpeg('./images/result1.jpeg');//如果是Gif用imagecreatefromgif，PNG用imagecreatefrompng……
if (imageistruecolor($im)) {
    imagetruecolortopalette($im, false, 256);//如果是真彩色图象，将真彩色图像转换为调色板图像
}
echo imagecolorstotal($im);
for ($i = 0; $i < imagecolorstotal($im);/*获得调色板中颜色的数目*/ $i++){
    $rgb = imagecolorsforindex($im, $i);//获得颜色i点的颜色值
    $gray = round(0.229 * $rgb['red'] + 0.587 * $rgb['green'] + 0.114 * $rgb['blue']);//获得颜色灰度值
    if($gray > 128) $gray = 255; else $gray = 0;
    echo $gray;
    imagecolorset($im, $i, $gray, $gray, $gray);//设置i点颜色值
}
imagejpeg($im, './images/result2.jpeg');//输出图象，如果是gif就用imagegif，如果是png就用imagepng……
imagedestroy($im);


$im = imagecreatefromjpeg('./images/result2.jpeg');
if ($im && imagefilter($im, IMG_FILTER_EDGEDETECT))
{
    echo 'Image converted to grayscale.';
    imagejpeg($im, './images/result3.jpeg');
} else
{
    echo 'Conversion to grayscale failed.';
}
imagedestroy($im);



$im = imagecreatefromjpeg('./images/result2.jpeg');//如果是Gif用imagecreatefromgif，PNG用imagecreatefrompng……
if (imageistruecolor($im)) {
    imagetruecolortopalette($im, false, 256);//如果是真彩色图象，将真彩色图像转换为调色板图像
}
for ($i = 0; $i < imagecolorstotal($im);/*获得调色板中颜色的数目*/ $i++){
    $rgb = imagecolorsforindex($im, $i);//获得颜色i点的颜色值
    $gray = round(0.229 * $rgb['red'] + 0.587 * $rgb['green'] + 0.114 * $rgb['blue']);//获得颜色灰度值
    if($gray > 230) $gray = 0; //else $gray = 255;
    imagecolorset($im, $i, $gray, $gray, $gray);//设置i点颜色值
}
imagejpeg($im, './images/result3.jpeg');//输出图象，如果是gif就用imagegif，如果是png就用imagepng……
imagedestroy($im);


$im = imagecreatefromjpeg('./images/result4.jpeg');//如果是Gif用imagecreatefromgif，PNG用imagecreatefrompng……
if (imageistruecolor($im)) {
    imagetruecolortopalette($im, false, 256);//如果是真彩色图象，将真彩色图像转换为调色板图像
}
for ($i = 0; $i < imagecolorstotal($im);/*获得调色板中颜色的数目*/ $i++){
    $rgb = imagecolorsforindex($im, $i);//获得颜色i点的颜色值
    $gray = round(0.229 * $rgb['red'] + 0.587 * $rgb['green'] + 0.114 * $rgb['blue']);//获得颜色灰度值
    if($gray <= 50) $gray = 0; else $gray = 255;
    imagecolorset($im, $i, $gray, $gray, $gray);//设置i点颜色值
}
imagejpeg($im, './images/result.jpeg');//输出图象，如果是gif就用imagegif，如果是png就用imagepng……
imagedestroy($im);

?>