<div data-lang="tab_images">
    <h3 class="text-center" style="margin-bottom: 30px"><?= TEXT_PROD_IMAGES_TITLE ?></h3>
    <?php if (isset($_GET['id'])) {
        global $prodToCat;
        $category_id = $prodToCat[$_GET['id']]; ?>
            <div id="custom_form_wrapper" style="display: flex;font-size: 16px">
                    <?php echo addDoubleDot(TEXT_PROD_LOAD_IMGS); ?> <input id="imageFiles" name="pic[]" type="file" multiple/>
                    <input type="button" value="<?php echo TEXT_PROD_LOAD_IMGS_BUT; ?>"/>
            </div>
        <script>
            $("#custom_form_wrapper input[type='button']").click(function(evt) {
                evt.preventDefault();
                var files = $('#imageFiles')[0].files;
                var formData = new FormData();
                for (var i = 0; i < files.length; i++) {
                    formData.append("pic[]", files[i]);
                }
                $.ajax({
                    url: "<?= HTTP_SERVER ?>/<?= $admin?>/html5uploader/post_file.php?act=custom_update&img_w=150&img_h=150&pid=<?php echo $_GET['id']; ?>&cPath=<?php echo(($_GET['tPath'] ?: $category_id)); ?>&opid=first",
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    success: function (response) {
                        location.reload();
                    }
                })
            })
        </script>
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
                <td>
                    <!-- html5uploader -->
                    <?php echo TEXT_PROD_IMGS_OR; ?>    <?php echo TEXT_PROD_IMGS_DRAG; ?>
                    :<br/>
                    <link rel="stylesheet"
                          href="html5uploader/assets/css/styles.css"/>
                    <div id="dropbox_first" class="dropbox">
                        <span class="message"><i><?php echo TEXT_PROD_IMGS_DRAG; ?></i></span>
                    </div>
                    <?php

                    if (MULTICOLOR_ENABLED == 'true') {
                        include(DIR_FS_EXT . 'multicolor/admin_color.php');
                    }

                    ?>
                    <input type="hidden" form name="pidd" id="pidd" value="<?php echo $_GET['id']; ?>"/>
                    <!-- html5uploader -->
                    <input type="hidden" form id="crop_x" name="crop_x"/>
                    <input type="hidden" form id="crop_y" name="crop_y"/>
                    <input type="hidden" form id="crop_w" name="crop_w"/>
                    <input type="hidden" form id="crop_h" name="crop_h"/>
                    <span id="crop_button"
                          style="display:none;float:left;font-weight:bold;cursor:pointer;color:#fff;font-size:17px;background:#339933;border-radius:5px;padding:5px;margin:15px 0;"><?php echo TEXT_PROD_CROP; ?></span>
                    <div style="clear:both"></div>
                    <div id="crop_area"></div>
                </td>
            </tr>
        </table>
    <?php } else echo '<img border="0" src="images/icon_info.gif">' . TEXT_PROD_SAVE_BEFORE . ''; ?>

</div>
<script src="html5uploader/assets/js/jquery.getimagedata.min.js"></script>
<script src="html5uploader/assets/js/canvas-toBlob.min.js"></script>
<script src="html5uploader/assets/js/jquery.filedrop.js"></script>
<script src="html5uploader/assets/js/script.js"></script>
<script src="includes/javascript/imagecrop/jquery.Jcrop.min.js"></script>
