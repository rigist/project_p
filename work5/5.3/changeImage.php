<?php

require '../vendor/autoload.php';


use Intervention\Image\ImageManagerStatic as Image;

$img = Image::make('picture.jpg');

$img->resize(200, null, function (\Intervention\Image\Constraint $constraint) {
    $constraint->aspectRatio();
});

$img->text('Watermark', $img->getWidth() - 8, $img->getHeight() - 8, function (\Intervention\Image\AbstractFont $font) {
    $font->size(20);
    $font->color([255, 255, 255, 0.5]);
    $font->align('right');
    $font->valign('bottom');
});

$img->save('picture2.jpg');

echo $img->response('jpg');
