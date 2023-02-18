<?php

$slider_images = getArticles($config['id']['val'] ?: 22, (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 5), true, true);

if ($slider_images && count($slider_images)) :
    if (count($slider_images) > 1) {
        $slider_class = 'id="owl-frontslider" class="owl-carousel"';
        $slide_class = 'owl-lazy';
    } else {
        $slider_class = 'class="single_slide"';
        $slide_class = 'lazyload';
    }

    if ($config['width']['val'] == 2) {
        $banner_width = '1920';
    } elseif ($config['width']['val'] == 1) {
        $banner_width = '1410';
    } else {
        $banner_width = '692';
    }

    if (!isMobile()) {
        $banner_height = $config['height']['val'];
    } else {
        $banner_mobile_width = '600';
        $banner_height = (int)($banner_mobile_width * $config['height']['val'] / $banner_width);
        $banner_width = $banner_mobile_width;
    }

    $banner_size = '&w=' . $banner_width . '&h=' . $banner_height;
    $banner_size2 = $banner_width . 'x' . $banner_height;
    $ratio = (100 / $banner_width * $banner_height);

    ?>

    <style>
        #owl-frontslider .item, .single_slide .item, #owl-frontslider .item-video {
            padding-top: <?php echo $ratio; ?>%;
        }

        #owl-frontslider .item > *, .single_slide .item > *, #owl-frontslider .item-video > * {
            margin-top: -<?php echo $ratio; ?>%;
        }

        @media (max-width: 480px) {
            #owl-frontslider {
                height: <?php echo $banner_height; ?>px;
            }
        }

        @media (min-width: 481px) {
            #owl-frontslider {
                max-height: <?php echo $banner_height; ?>px;
                overflow: hidden;
            }
        }
    </style>
    <div class="position-relative">
        <div <?php echo $slider_class; ?> style="min-height:<?php echo $banner_height; ?>px;overflow:hidden;">
            <?php foreach ($slider_images as $slide) {
                $slide['desc'] = '<div>' . $slide['desc'] . '</div>';
                if ($slide['image'] == '') {
                    // get img-src and a-href from parsed html:
                    $sliderHtml = str_get_html($slide['desc']);
                    $imgFound = $sliderHtml->find('img');
                    foreach ($imgFound as $img) $slide['image'] = (string)$img->src.$banner_size;
                    if($slide['image']!='') $slide['desc'] = '';
                    $aFound = $sliderHtml->find('a');
                    foreach ($aFound as $aF) $slide['direct_link'] = (string)$aF->href;
                } else {
                    // get one banner for all languages:
                    $slide['image'] = '/getimage/' . $banner_size2 . '/' . $slide['image'];
                    $slide['desc'] = '';
                }
                // prevent lazy load bug:
                $slide['image'] = str_replace(" ", "%20", $slide['image']);
                $slide['image'] = str_replace("(", "%28", $slide['image']);
                $slide['image'] = str_replace(")", "%29", $slide['image']);
                $direct_link = !empty($slide['direct_link']) ? '<a href="' . $slide['direct_link'] . '">' . $slide['desc'] . '</a>' : $slide['desc'];

                if (!empty($slide['code']) && strstr($slide['code'], 'youtube')) {  // video:
                    if (count($slider_images) > 1) {
                        echo '<div class="item-video"><a class="owl-video" href="' . $slide['code'] . '"></a></div>';
                    } else {
                        echo '<div class="item">' . convertYoutube($slide['code']) . '</div>';
                    }
                } elseif (!empty($slide['code']) && !strstr($slide['code'], 'youtube')) {
                    continue; //wrong code
                } else { // image
                    echo '<div class="item ' . $slide_class . '" data-src="' . HTTP_SERVER . $slide['image'] . '">' . $direct_link . '</div>';
                }
                if (!$sliderAjaxRequest) {
                    break;
                }
            } ?>
        </div>
        <?php if ($sliderAjaxRequest && count($slider_images) > 1) { ?>
            <ul id="carousel-custom-dots" class="owl-dots">
                <?php foreach ($slider_images as $slide) : ?>
                    <li class="owl-dot">
                        <span class="rect"></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php } ?>
    </div>
<?php endif; ?>
