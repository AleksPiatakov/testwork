<?php

$additional_images1_string = '';
foreach ($additional_images as $img) {
    $additional_images1_string .= '<div class="sync1-item">
                    <img class="lazyload" src="' . $img . '"  data-src="getimage/products/' . $img . '">
            </div>';
}
$additional_images2_string = '';
foreach ($additional_images as $img) {
    $additional_images2_string .= '<div class="sync2-item">
                    <img class="lazyload" src="' . $img . '"  data-src="getimage/products/' . $img . '">
            </div>';
}
?>
<div id="sync1" class="oneItemSlider modalSlider owl-carousel owl-theme">
    <?= $additional_images1_string ?>
</div>

<div id="sync2" class="synchronizedSlider modalSlider owl-carousel">
    <?= $additional_images2_string ?>
</div>
