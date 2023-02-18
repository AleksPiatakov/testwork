<?php
$helpsExample = [
    '{{STORE_NAME}}' => [
        'META_TAGS_VAR' => '{{STORE_NAME}}',
        'META_TAGS_DESC' => META_TAGS_STORE_NAME,
        'META_TAGS_EXAMPLE' => defined('STORE_NAME') ? STORE_NAME : ''
    ],
    '{{PRODUCT_NAME}}' => [
        'META_TAGS_VAR' => '{{PRODUCT_NAME}}',
        'META_TAGS_DESC' => META_TAGS_PRODUCTS_NAME,
        'META_TAGS_EXAMPLE' => META_TAGS_PRODUCTS_NAME
    ],
    '{{CATEGORY_NAME}}' => [
        'META_TAGS_VAR' => '{{CATEGORY_NAME}}',
        'META_TAGS_DESC' => META_TAGS_CATEGORY_NAME,
        'META_TAGS_EXAMPLE' => META_TAGS_CATEGORY_EXAMPLE
    ],
    '{{MANUFACTURER_NAME}}' => [
        'META_TAGS_VAR' => '{{MANUFACTURER_NAME}}',
        'META_TAGS_DESC' => META_TAGS_MANUFACTURER_NAME,
        'META_TAGS_EXAMPLE' => 'Samsung'
    ],
    '{{SEARCH_NAME}}' => [
        'META_TAGS_VAR' => '{{SEARCH_NAME}}',
        'META_TAGS_DESC' => META_TAGS_SEARCH_QUERY,
        'META_TAGS_EXAMPLE' => 'mi band 4'
    ],
    '{{PRODUCT_PRICE}}' => [
        'META_TAGS_VAR' => '{{PRODUCT_PRICE}}',
        'META_TAGS_DESC' => META_TAGS_PRODUCT_PRICE,
        'META_TAGS_EXAMPLE' => '56'
    ],
    '{{PRODUCT_MODEL}}' => [
        'META_TAGS_VAR' => '{{PRODUCT_MODEL}}',
        'META_TAGS_DESC' => META_TAGS_PRODUCT_MODEL,
        'META_TAGS_EXAMPLE' => '#model'
    ],
    '{{PRODUCT_QUANTITY}}' => [
        'META_TAGS_VAR' => '{{PRODUCT_QUANTITY}}',
        'META_TAGS_DESC' => META_TAGS_PRODUCT_QUANTITY,
        'META_TAGS_EXAMPLE' => '5'
    ],
];

$helps = [
    'main' => [
        '{{STORE_NAME}}'
    ],
    'product' => [
        '{{STORE_NAME}}',
        '{{PRODUCT_NAME}}',
        '{{CATEGORY_NAME}}',
        '{{MANUFACTURER_NAME}}',
        '{{PRODUCT_PRICE}}',
        '{{PRODUCT_MODEL}}',
        '{{PRODUCT_QUANTITY}}'
    ],
    'category' => [
        '{{STORE_NAME}}',
        '{{CATEGORY_NAME}}',
    ],
    'manufacturer' => [
        '{{STORE_NAME}}',
        '{{MANUFACTURER_NAME}}',
    ],
    'search' => [
        '{{STORE_NAME}}',
        '{{SEARCH_NAME}}',
    ],
];
?>
<div class="wrapper-md">
    <div class="bg-light lter">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th><?= META_TAGS_VAR ?></th>
                    <th><?= META_TAGS_DESC ?></th>
                    <th><?= META_TAGS_EXAMPLE ?></th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($data['info'])) {?>
                <?php foreach ($helps[$data['info']] as $fieldName) { ?>
                    <tr class="dataTableRowSelected">
                        <td onclick="javascript:copyToContext('<?= $helpsExample[$fieldName]['META_TAGS_VAR'] ?>');"
                            class="v-middle cursor-pointer"><?= $helpsExample[$fieldName]['META_TAGS_VAR'] ?></td>
                        <td class="v-middle"><?= $helpsExample[$fieldName]['META_TAGS_DESC'] ?></td>
                        <td class="v-middle"><?= $helpsExample[$fieldName]['META_TAGS_EXAMPLE'] ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php unset($helpsExample, $helps) ?>