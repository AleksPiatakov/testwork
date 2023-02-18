<br><h1><?=CONTENT_MANUFACTURERS_TITLE?></h1>
<div class="container-fluid brands_wrapper">
    <div class="brands_block">
        <?php foreach ($manufacturers_arr as $man) : ?>
            <?php if ($letter != mb_substr($man['manufacturers_name'], 0, 1)) : ?>
                <?php $letter = mb_substr($man['manufacturers_name'], 0, 1); ?>
                <h3><?= $letter ?></h3>
            <?php endif; ?>
            <ul>
                <li>
                    <a href="<?= tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $man['manufacturers_id']) ?>">
                        <?= $man['manufacturers_name'] ?>
                    </a>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>
</div>
