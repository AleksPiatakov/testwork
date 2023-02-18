<div class="settings_block">
    <div class="tabs_block">
        <div class="header_settings">
            <ul class="settings_pages-menu nav-tabs content-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#tab_general">General</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tab_images">Images</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tab_attrib">Attributes</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tab_cr_sell">Cross-sell</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div id="tab_general" class="tab-pane fade active in">
                <label class="product_title"><input type="text"></label>
                <label class="product_url"><input type="text"></label>

                <hr>
                <div class="h5">Short description</div>
                <label class="short_desc"><textarea name="" id="" rows="4"></textarea></label>
                <div class="h5">Full Description</div>
                <label class="full_desc"><textarea name="" id="" rows="10"></textarea></label>
                <div class="meta_block">
                    <label class="meta_title"><textarea rows="3" name="" id=""></textarea></label>
                    <label class="meta_desc"><textarea rows="3" name="" id=""></textarea></label>
                    <label class="meta_keywords"><textarea rows="3" name="" id=""></textarea></label>
                </div>
            </div>
            <div id="tab_images" class="tab-pane fade">
                <div class="h5">Upload Files</div>
                <div class="boot_block">
                    <div class="boot_block-top">
                        <p>
                            <span>Drag & Drop files here</span> or
                            <span class="substituted_input">
                                <input type="file">
                                <span><img class="img_add" src="images/new_images_admin-panel/Add.svg">Browse Files</span>
                            </span>
                        </p>

                        <p><span>Supported image file (up to 64 MB):</span> JPEG, JPG, PNG, GIF, SVG, BMP, WEBP</p>
                    </div>
                    <div class="boot_block-bottom">
                        <img src="images/new_images_admin-panel/Rectangle@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle1@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle123.jpg">
                    </div>
                </div>
                <hr>

                <div class="color_sets">
                    <div class="color_sets-top">
                        <img src="images/new_images_admin-panel/Rectangle11.jpg">
                        <span class="color_name">Purple</span>
                        <span class="color_option">Select as main color</span>
                    </div>
                    <div class="color_sets-bottom">
                        <img src="images/new_images_admin-panel/Rectangle@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle1@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle123.jpg">
                        <img src="images/new_images_admin-panel/Rectangle@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle1@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle123.jpg">
                        <img src="images/new_images_admin-panel/Rectangle@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle1@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle123.jpg">
                        <img src="images/new_images_admin-panel/Rectangle@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle1@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle123.jpg">
                    </div>
                </div>
                <div class="color_sets">
                    <div class="color_sets-top">
                        <img src="images/new_images_admin-panel/Rectangle11.jpg">
                        <span class="color_name">Purple</span>
                        <span class="color_option">Select as main color</span>
                    </div>
                    <div class="color_sets-bottom">
                        <img src="images/new_images_admin-panel/Rectangle@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle1@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle123.jpg">
                        <img src="images/new_images_admin-panel/Rectangle@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle1@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle123.jpg">
                        <img src="images/new_images_admin-panel/Rectangle@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle1@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle123.jpg">
                        <img src="images/new_images_admin-panel/Rectangle@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle1@2x.jpg">
                        <img src="images/new_images_admin-panel/Rectangle123.jpg">
                    </div>
                </div>
            </div>

            <div id="tab_attrib" class="tab-pane fade">3</div>
            <div id="tab_cr_sell" class="tab-pane fade">4</div>
        </div>
    </div>
    <!--info_editor-->
    <?php  require (DIR_WS_ASSETS.'info_editor.php') ?>
    <!--END info_editor-->
</div>