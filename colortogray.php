<?php

/**
 * @author Jack
 * @copyright 2013
 * @date 2013��5��24��
 * ����ɫͼƬת��Ϊ�Ҷ�ͼ
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

$im = imagecreatefromjpeg('./images/pincode.jpeg');//�����Gif��imagecreatefromgif��PNG��imagecreatefrompng����
if (imageistruecolor($im)) {
    imagetruecolortopalette($im, false, 256);//��������ɫͼ�󣬽����ɫͼ��ת��Ϊ��ɫ��ͼ��
}
for ($i = 0; $i < imagecolorstotal($im);/*��õ�ɫ������ɫ����Ŀ*/ $i++){
    $rgb = imagecolorsforindex($im, $i);//�����ɫi�����ɫֵ
    $gray = round(0.229 * $rgb['red'] + 0.587 * $rgb['green'] + 0.114 * $rgb['blue']);//�����ɫ�Ҷ�ֵ
    imagecolorset($im, $i, $gray, $gray, $gray);//����i����ɫֵ
}
imagejpeg($im, './images/result1.jpeg');//���ͼ�������gif����imagegif�������png����imagepng����
imagedestroy($im);//����ͼ���ͷ���Դ


$im = imagecreatefromjpeg('./images/result1.jpeg');//�����Gif��imagecreatefromgif��PNG��imagecreatefrompng����
if (imageistruecolor($im)) {
    imagetruecolortopalette($im, false, 256);//��������ɫͼ�󣬽����ɫͼ��ת��Ϊ��ɫ��ͼ��
}
echo imagecolorstotal($im);
for ($i = 0; $i < imagecolorstotal($im);/*��õ�ɫ������ɫ����Ŀ*/ $i++){
    $rgb = imagecolorsforindex($im, $i);//�����ɫi�����ɫֵ
    $gray = round(0.229 * $rgb['red'] + 0.587 * $rgb['green'] + 0.114 * $rgb['blue']);//�����ɫ�Ҷ�ֵ
    if($gray > 128) $gray = 255; else $gray = 0;
    echo $gray;
    imagecolorset($im, $i, $gray, $gray, $gray);//����i����ɫֵ
}
imagejpeg($im, './images/result2.jpeg');//���ͼ�������gif����imagegif�������png����imagepng����
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



$im = imagecreatefromjpeg('./images/result2.jpeg');//�����Gif��imagecreatefromgif��PNG��imagecreatefrompng����
if (imageistruecolor($im)) {
    imagetruecolortopalette($im, false, 256);//��������ɫͼ�󣬽����ɫͼ��ת��Ϊ��ɫ��ͼ��
}
for ($i = 0; $i < imagecolorstotal($im);/*��õ�ɫ������ɫ����Ŀ*/ $i++){
    $rgb = imagecolorsforindex($im, $i);//�����ɫi�����ɫֵ
    $gray = round(0.229 * $rgb['red'] + 0.587 * $rgb['green'] + 0.114 * $rgb['blue']);//�����ɫ�Ҷ�ֵ
    if($gray > 230) $gray = 0; //else $gray = 255;
    imagecolorset($im, $i, $gray, $gray, $gray);//����i����ɫֵ
}
imagejpeg($im, './images/result3.jpeg');//���ͼ�������gif����imagegif�������png����imagepng����
imagedestroy($im);


$im = imagecreatefromjpeg('./images/result4.jpeg');//�����Gif��imagecreatefromgif��PNG��imagecreatefrompng����
if (imageistruecolor($im)) {
    imagetruecolortopalette($im, false, 256);//��������ɫͼ�󣬽����ɫͼ��ת��Ϊ��ɫ��ͼ��
}
for ($i = 0; $i < imagecolorstotal($im);/*��õ�ɫ������ɫ����Ŀ*/ $i++){
    $rgb = imagecolorsforindex($im, $i);//�����ɫi�����ɫֵ
    $gray = round(0.229 * $rgb['red'] + 0.587 * $rgb['green'] + 0.114 * $rgb['blue']);//�����ɫ�Ҷ�ֵ
    if($gray <= 50) $gray = 0; else $gray = 255;
    imagecolorset($im, $i, $gray, $gray, $gray);//����i����ɫֵ
}
imagejpeg($im, './images/result.jpeg');//���ͼ�������gif����imagegif�������png����imagepng����
imagedestroy($im);

?>