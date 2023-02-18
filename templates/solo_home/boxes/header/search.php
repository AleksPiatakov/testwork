<!-- search //-->
<div class="main_search_form">
    <?php echo tep_draw_form(
        'quick_find',
        tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false),
        'get',
        'class="form_search_site"'
    ); ?>
    <input type="search" id="searchpr" class="search_site_input search-form-input"
           placeholder="<?php echo BOX_HEADING_SEARCH; ?>" name="keywords"
           value="<?= stripslashes($_GET['keywords']); ?>">
    <button type="submit" id="search-form-button" class="search_site_submit">
        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"></path>
        </svg>
    </button>
    </form>
</div>
<!-- search_smend //-->