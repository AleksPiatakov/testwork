<?php

function getLabel($listing)
{
    global $template;

    //general
    $labelConfig = $template->checkConfig('PRODUCT_INFO', 'P_LABELS');
    //discount in %
    $discount = '';
    $oldPrice = $listing['products_price'];
    $specialPrice = $listing['products_special_price'];
    if (!empty($specialPrice) && !empty((double)$oldPrice)) {
        $discount = round((($oldPrice - $specialPrice) / $oldPrice) * 100);
    }

    $label = '';
    $labelClass = '';
    if ($listing['lable_1']) {
        $label = LABEL_TOP;
        $labelClass = 1;
    } elseif ($listing['lable_2']) {
        $label = LABEL_NEW;
        $labelClass = 2;
    } elseif (
        $listing['lable_3'] ||
        ($labelConfig['show_special_label_with_special']['val'] && !empty($discount))
    ) {
        $label = !empty($discount) ? ('-' . $discount . '%') : LABEL_SPECIAL;
        $labelClass = 3;
    }

    return array('name' => $label, 'class' => $labelClass);
}

if (!function_exists('getLabels')) {
    function getLabels($listing)
    {
        global $template;

        //general
        $labelConfig = $template->checkConfig('PRODUCT_INFO', 'P_LABELS');

        //label 1
        $return = [];
        if ($listing['lable_1']) {
            $return[] = ['name' => LABEL_TOP, 'class' => 1];
        }

        //label 2
        if ($listing['lable_2']) {
            $return[] = ['name' => LABEL_NEW, 'class' => 2];
        }

        //label 3
        //discount in %
        $discount = '';
        $oldPrice = $listing['products_price'];
        $specialPrice = $listing['products_special_price'];
        if (!empty($specialPrice) && !empty((double)$oldPrice)) {
            $discount = round((($oldPrice - $specialPrice) / $oldPrice) * 100);
        }
        if (
            $listing['lable_3'] ||
            ($labelConfig['show_special_label_with_special']['val'] && !empty($discount))
        ) {
            $name = !empty($discount) ? ('-' . $discount . '%') : LABEL_SPECIAL;
            $return[] = ['name' => $name, 'class' => 3];
        }

        return $return;
    }
}
