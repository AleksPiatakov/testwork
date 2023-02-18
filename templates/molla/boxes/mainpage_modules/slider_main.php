<?php

if (count($slider_images)) :?>
    <?php if ((!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) && $content == 'index_default') {
        // diff slider width:
        // - 1140px or in right column
        // - slider width: 100%;
        $content_class = ($template->getFiles(
            'MAINPAGE',
            'M_SLIDE_MAIN',
            $config
        ) && $config['width']['val'] == 1) ? 'container' : $content_class = 'container-fluid padd-0';
        echo '<div class="' . $content_class . '">';
    } ?>
    <div class="position-relative">
        <div <?php echo $slider_class; ?> style="overflow:hidden;">
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
                        <svg class="fa-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                        </svg>
                        <svg class="fa-circle-o" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200z"></path>
                        </svg>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php } ?>
    </div>
    <?php
    if ((!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) && $content == 'index_default') {
        echo '</div>';
    } ?>
<?php endif; ?>
