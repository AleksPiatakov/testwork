<div id="kabinet">
    <?php if (tep_session_is_registered('customer_id')) :
        $first_name = $_SESSION['customer_first_name'];
        $last_name = $_SESSION['customer_last_name'];
        $full_name = $first_name . " " . $last_name;
        ?>

        <a rel="nofollow" class="dropdown-toggle" href="#" role="button" id="login_btn" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="16"
                 viewBox="0 0 14 16">
                <defs>
                    <rect id="b" width="259" height="191" rx="3"/>
                    <filter id="a" width="113.5%" height="118.3%" x="-6.8%" y="-6.5%" filterUnits="objectBoundingBox">
                        <feOffset dy="5" in="SourceAlpha" result="shadowOffsetOuter1"/>
                        <feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="5"/>
                        <feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                    </filter>
                </defs>
                <g fill="none" fill-rule="evenodd">
                    <path fill="#F8F9FA" d="M-790-7771H650V274H-790z"/>
                    <g transform="translate(-83 -50)">
                        <use fill="#000" filter="url(#a)" xlink:href="#b"/>
                        <use fill="#FFF" xlink:href="#b"/>
                    </g>
                    <g fill="#555" fill-rule="nonzero">
                        <path d="M.514 6.2a.52.52 0 0 1-.259-.068.492.492 0 0 1-.186-.682C.72 4.379 2.691 1.875 7 1.875c1.867 0 3.504.486 4.864 1.443 1.119.786 1.746 1.675 2.045 2.103a.49.49 0 0 1-.135.693.525.525 0 0 1-.715-.132C12.516 5.211 10.87 2.868 7 2.868c-3.777 0-5.483 2.157-6.041 3.082a.505.505 0 0 1-.445.25z"/>
                        <path d="M9.17 16a.518.518 0 0 1-.128-.014c-3.125-.768-4.291-3.861-4.339-3.99l-.007-.028c-.026-.09-.653-2.21.31-3.454.44-.568 1.112-.857 1.998-.857.824 0 1.418.254 1.826.779.336.428.47.957.602 1.468.273 1.06.47 1.617 1.608 1.675.5.025.827-.265 1.013-.511.503-.672.59-1.768.212-2.732-.489-1.25-2.217-3.604-5.265-3.604-1.302 0-2.497.414-3.456 1.193-.795.646-1.426 1.557-1.728 2.493-.562 1.743.175 4.482.182 4.507a.495.495 0 0 1-.365.607.52.52 0 0 1-.63-.353C.97 13.054.183 10.132.83 8.118A6.418 6.418 0 0 1 7 3.736c1.517 0 2.95.51 4.145 1.475.926.75 1.685 1.757 2.078 2.764.504 1.286.369 2.729-.342 3.671-.474.629-1.149.958-1.896.922-1.947-.097-2.297-1.443-2.552-2.425C8.17 9.136 8.003 8.65 7 8.65c-.55 0-.937.15-1.178.46-.328.426-.353 1.09-.317 1.572.037.504.146.91.172.993.08.2 1.122 2.732 3.62 3.346.277.068.441.34.372.604a.516.516 0 0 1-.5.375z"/>
                        <path d="M5.159 15.771a.524.524 0 0 1-.376-.157c-1.25-1.3-1.957-2.753-2.224-4.571v-.01c-.15-1.204.07-2.908 1.142-4.08C4.49 6.09 5.604 5.65 7 5.65c1.652 0 2.95.76 3.759 2.196a6.081 6.081 0 0 1 .707 2.125.503.503 0 0 1-.46.547.512.512 0 0 1-.564-.443c0-.01-.102-.904-.602-1.775-.627-1.096-1.582-1.654-2.844-1.654-1.09 0-1.943.325-2.53.968-.846.925-1.01 2.35-.893 3.293.233 1.607.857 2.886 1.958 4.029.193.2.182.518-.026.703a.523.523 0 0 1-.346.132z"/>
                        <path d="M10.92 14.34c-1.094 0-2.024-.3-2.768-.897-1.495-1.193-1.662-3.136-1.67-3.218a.504.504 0 0 1 .474-.536.505.505 0 0 1 .55.457c.004.029.154 1.618 1.306 2.533.682.539 1.593.753 2.716.628a.51.51 0 0 1 .569.44.499.499 0 0 1-.452.55 6.369 6.369 0 0 1-.726.042zm.863-13.247C11.357.818 9.843 0 7 0 4.014 0 2.497.904 2.162 1.132a.397.397 0 0 0-.062.047c-.004.003-.007.003-.007.003a.493.493 0 0 0-.172.372c0 .275.23.496.514.496a.528.528 0 0 0 .3-.093l-.004.004C2.745 1.95 4.054.996 7 .996s4.255.958 4.27.965l-.004-.004.007-.007c.087.064.193.1.31.1a.505.505 0 0 0 .514-.496.497.497 0 0 0-.314-.461z"/>
                    </g>
                </g>
            </svg>
            <!--  после вывода полного имени, если больше 11 символов - выводить ".."    -->
            <?= substr(strip_tags($full_name), 0, 11) . (strlen(strip_tags($full_name)) > 11 ? '..' : ''); ?>
        </a>

        <div class="login_block dropdown-menu" aria-labelledby="login_btn">
            <div class="header_acc">
                <div class="basic_data_acc">
                    <!-- выводить ИП -->
                    <span><?= strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1)) ?></span>
                    <!-- выводить Имя Пользователя -->
                    <?= $full_name ?>
                </div>
                <a rel="nofollow" href="<?php echo tep_href_link(FILENAME_LOGOFF); ?>">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M96 64h84c6.6 0 12 5.4 12 12v24c0 6.6-5.4 12-12 12H96c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h84c6.6 0 12 5.4 12 12v24c0 6.6-5.4 12-12 12H96c-53 0-96-43-96-96V160c0-53 43-96 96-96zm231.1 19.5l-19.6 19.6c-4.8 4.8-4.7 12.5.2 17.1L420.8 230H172c-6.6 0-12 5.4-12 12v28c0 6.6 5.4 12 12 12h248.8L307.7 391.7c-4.8 4.7-4.9 12.4-.2 17.1l19.6 19.6c4.7 4.7 12.3 4.7 17 0l164.4-164c4.7-4.7 4.7-12.3 0-17l-164.4-164c-4.7-4.6-12.3-4.6-17 .1z"></path>
                    </svg>
                </a>
            </div>
            <hr>
            <div class="main_acc">
                <ul>
                    <li>
                        <?php
                        $active = tep_href_link(
                            FILENAME_ACCOUNT_HISTORY,
                            '',
                            'SSL'
                        ) == HTTP_SERVER . $_SERVER['REQUEST_URI'] ? 'class="active"' : '';
                        echo '<a ' . $active . ' href="' . tep_href_link(
                            FILENAME_ACCOUNT_HISTORY,
                            '',
                            'SSL'
                        ) . '">' . HEAD_TITLE_ACCOUNT_HISTORY . '</a>';
                        ?>
                    </li>
                    <li>
                        <?php
                        $active = tep_href_link(
                            FILENAME_WISHLIST,
                            '',
                            'SSL'
                        ) == HTTP_SERVER . $_SERVER['REQUEST_URI'] ? 'class="active"' : '';
                        echo '<a ' . $active . ' href="' . tep_href_link(
                            FILENAME_WISHLIST,
                            '',
                            'SSL'
                        ) . '">' . DEMO2_WISHLIST_LINK . '</a>';
                        ?>
                    </li>
                    <li>
                        <?php
                        $active = tep_href_link(
                            FILENAME_ACCOUNT_EDIT,
                            '',
                            'SSL'
                        ) == HTTP_SERVER . $_SERVER['REQUEST_URI'] ? 'class="active"' : '';
                        echo '<a ' . $active . ' href="' . tep_href_link(
                            FILENAME_ACCOUNT_EDIT,
                            '',
                            'SSL'
                        ) . '">' . DEMO2_MY_INFO . '</a>';
                        ?>
                    </li>
                    <li>
                        <?php
                        $active = tep_href_link(
                            FILENAME_ADDRESS_BOOK,
                            '',
                            'SSL'
                        ) == HTTP_SERVER . $_SERVER['REQUEST_URI'] ? 'class="active"' : '';
                        echo '<a ' . $active . ' href="' . tep_href_link(
                            FILENAME_ADDRESS_BOOK,
                            '',
                            'SSL'
                        ) . '">' . DEMO2_EDIT_ADDRESS_BOOK . '</a>';
                        ?>
                    </li>
                    <li>
                        <?php
                        $active = tep_href_link(
                            FILENAME_ACCOUNT_PASSWORD,
                            '',
                            'SSL'
                        ) == HTTP_SERVER . $_SERVER['REQUEST_URI'] ? 'class="active"' : '';
                        echo '<a ' . $active . ' href="' . tep_href_link(
                            FILENAME_ACCOUNT_PASSWORD,
                            '',
                            'SSL'
                        ) . '">' . MY_ACCOUNT_PASSWORD . '</a>'; ?>
                    </li>
                    <li>
                        <a rel="nofollow" href="<?php echo tep_href_link(FILENAME_LOGOFF); ?>">
                            <?php echo LOGIN_BOX_LOGOFF; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    <?php else : ?>
        <a rel="nofollow" class="dropdown-toggle" href="#" role="button" id="login_btn" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="16"
                 viewBox="0 0 14 16">
                <defs>
                    <rect id="b" width="259" height="191" rx="3"/>
                    <filter id="a" width="113.5%" height="118.3%" x="-6.8%" y="-6.5%" filterUnits="objectBoundingBox">
                        <feOffset dy="5" in="SourceAlpha" result="shadowOffsetOuter1"/>
                        <feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="5"/>
                        <feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                    </filter>
                </defs>
                <g fill="none" fill-rule="evenodd">
                    <path fill="#F8F9FA" d="M-790-7771H650V274H-790z"/>
                    <g transform="translate(-83 -50)">
                        <use fill="#000" filter="url(#a)" xlink:href="#b"/>
                        <use fill="#FFF" xlink:href="#b"/>
                    </g>
                    <g fill="#555" fill-rule="nonzero">
                        <path d="M.514 6.2a.52.52 0 0 1-.259-.068.492.492 0 0 1-.186-.682C.72 4.379 2.691 1.875 7 1.875c1.867 0 3.504.486 4.864 1.443 1.119.786 1.746 1.675 2.045 2.103a.49.49 0 0 1-.135.693.525.525 0 0 1-.715-.132C12.516 5.211 10.87 2.868 7 2.868c-3.777 0-5.483 2.157-6.041 3.082a.505.505 0 0 1-.445.25z"/>
                        <path d="M9.17 16a.518.518 0 0 1-.128-.014c-3.125-.768-4.291-3.861-4.339-3.99l-.007-.028c-.026-.09-.653-2.21.31-3.454.44-.568 1.112-.857 1.998-.857.824 0 1.418.254 1.826.779.336.428.47.957.602 1.468.273 1.06.47 1.617 1.608 1.675.5.025.827-.265 1.013-.511.503-.672.59-1.768.212-2.732-.489-1.25-2.217-3.604-5.265-3.604-1.302 0-2.497.414-3.456 1.193-.795.646-1.426 1.557-1.728 2.493-.562 1.743.175 4.482.182 4.507a.495.495 0 0 1-.365.607.52.52 0 0 1-.63-.353C.97 13.054.183 10.132.83 8.118A6.418 6.418 0 0 1 7 3.736c1.517 0 2.95.51 4.145 1.475.926.75 1.685 1.757 2.078 2.764.504 1.286.369 2.729-.342 3.671-.474.629-1.149.958-1.896.922-1.947-.097-2.297-1.443-2.552-2.425C8.17 9.136 8.003 8.65 7 8.65c-.55 0-.937.15-1.178.46-.328.426-.353 1.09-.317 1.572.037.504.146.91.172.993.08.2 1.122 2.732 3.62 3.346.277.068.441.34.372.604a.516.516 0 0 1-.5.375z"/>
                        <path d="M5.159 15.771a.524.524 0 0 1-.376-.157c-1.25-1.3-1.957-2.753-2.224-4.571v-.01c-.15-1.204.07-2.908 1.142-4.08C4.49 6.09 5.604 5.65 7 5.65c1.652 0 2.95.76 3.759 2.196a6.081 6.081 0 0 1 .707 2.125.503.503 0 0 1-.46.547.512.512 0 0 1-.564-.443c0-.01-.102-.904-.602-1.775-.627-1.096-1.582-1.654-2.844-1.654-1.09 0-1.943.325-2.53.968-.846.925-1.01 2.35-.893 3.293.233 1.607.857 2.886 1.958 4.029.193.2.182.518-.026.703a.523.523 0 0 1-.346.132z"/>
                        <path d="M10.92 14.34c-1.094 0-2.024-.3-2.768-.897-1.495-1.193-1.662-3.136-1.67-3.218a.504.504 0 0 1 .474-.536.505.505 0 0 1 .55.457c.004.029.154 1.618 1.306 2.533.682.539 1.593.753 2.716.628a.51.51 0 0 1 .569.44.499.499 0 0 1-.452.55 6.369 6.369 0 0 1-.726.042zm.863-13.247C11.357.818 9.843 0 7 0 4.014 0 2.497.904 2.162 1.132a.397.397 0 0 0-.062.047c-.004.003-.007.003-.007.003a.493.493 0 0 0-.172.372c0 .275.23.496.514.496a.528.528 0 0 0 .3-.093l-.004.004C2.745 1.95 4.054.996 7 .996s4.255.958 4.27.965l-.004-.004.007-.007c.087.064.193.1.31.1a.505.505 0 0 0 .514-.496.497.497 0 0 0-.314-.461z"/>
                    </g>
                </g>
            </svg>
            <?php echo LOGIN_FROM_SITE; ?>
        </a>
    <?php endif; ?>
</div>
