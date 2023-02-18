<!-- search //-->
<div class="main_search_form">
    <a class="dropdown-toggle" href="#" role="button" id="search_btn" data-toggle="dropdown" aria-haspopup="true"
       aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16"
             viewBox="0 0 16 16">
            <defs>
                <rect id="b" width="259" height="191" rx="3"/>
                <filter id="a" width="113.5%" height="118.3%" x="-6.8%" y="-6.5%" filterUnits="objectBoundingBox">
                    <feOffset dy="5" in="SourceAlpha" result="shadowOffsetOuter1"/>
                    <feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="5"/>
                    <feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                </filter>
            </defs>
            <g fill="none" fill-rule="evenodd">
                <path fill="#F8F9FA" d="M-764-7771H676V274H-764z"/>
                <g transform="translate(-57 -50)">
                    <use fill="#000" filter="url(#a)" xlink:href="#b"/>
                    <use fill="#FFF" xlink:href="#b"/>
                </g>
                <path fill="#555" fill-rule="nonzero"
                      d="M11.396 10.057h-.729l-.274-.228c.866-1.052 1.414-2.378 1.414-3.886A5.923 5.923 0 0 0 5.88 0C2.644 0 0 2.651 0 5.943a5.922 5.922 0 0 0 5.926 5.943 6.11 6.11 0 0 0 3.875-1.417l.273.228v.732L14.633 16 16 14.629l-4.604-4.572zm-5.47 0a4.091 4.091 0 0 1-4.103-4.114 4.091 4.091 0 0 1 4.103-4.114 4.091 4.091 0 0 1 4.103 4.114 4.091 4.091 0 0 1-4.103 4.114z"/>
            </g>
        </svg>
        <?php echo BOX_HEADING_SEARCH; ?>
    </a>
    <div class="search_block dropdown-menu dropdown-menu-right" aria-labelledby="search_btn">
        <?php echo tep_draw_form(
            'quick_find',
            tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false),
            'get',
            'class="form_search_site"'
        ); ?>
        <input type="search" id="searchpr" class="search_site_input search-form-input"
               placeholder="<?php echo BOX_HEADING_SEARCH; ?>" name="keywords"
               value="<?= stripslashes($_GET['keywords']); ?>">
        <button class="reset_search" type="reset">
        </button>
        </form>
        <p class="search_mess">Начните печатать чтобы искать…</p>
    </div>
</div>
<!-- search_end //-->
