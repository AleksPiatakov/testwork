<div id="kabinet">
    <?php if (tep_session_is_registered('customer_id')) : ?>
        <?php //echo '<a href=account_history.php><strong>'.LOGIN_BOX_MY_CABINET.'</strong></a> | <a href="' . tep_href_link(FILENAME_LOGOFF, '', 'NONSSL') . '">' . LOGIN_BOX_LOGOFF . '</a>'; ?>
        <div class="enter_registration">
            <a rel="nofollow" href="<?php echo tep_href_link(FILENAME_ACCOUNT_HISTORY); ?>" class="enter_link_user">
                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"
                          class=""></path>
                </svg>
            </a>
            <a rel="nofollow" href="<?php echo tep_href_link(FILENAME_LOGOFF); ?>" class="registration">
                <!--               --><?php //echo LOGIN_BOX_LOGOFF ?>
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16" viewBox="0 0 172 172"
                     style=" fill:#000000;">
                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                       stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                       font-family="none" font-weight="none" font-size="none" text-anchor="none"
                       style="mix-blend-mode: normal">
                        <path d="M0,172v-172h172v172z" fill="none"></path>
                        <g fill="#ffffff">
                            <path d="M86.1075,6.7725c-43.61533,0 -79.12,35.50467 -79.12,79.12c0,43.61533 35.50467,79.12 79.12,79.12c23.3781,0 44.43061,-10.21499 58.89656,-26.3711c1.72575,-1.81717 2.32705,-4.42892 1.56965,-6.81778c-0.7574,-2.38887 -2.7537,-4.17703 -5.21122,-4.66789c-2.45752,-0.49085 -4.98757,0.39324 -6.60453,2.30786c-11.97388,13.37286 -29.26937,21.7889 -48.65047,21.7889c-36.17891,0 -65.36,-29.18109 -65.36,-65.36c0,-36.17891 29.18109,-65.36 65.36,-65.36c19.37733,0 36.67279,8.41529 48.65047,21.7889c1.61696,1.91462 4.14701,2.7987 6.60452,2.30785c2.45751,-0.49086 4.45382,-2.27902 5.21121,-4.66788c0.7574,-2.38886 0.1561,-5.0006 -1.56964,-6.81778c-14.46904,-16.15534 -35.52158,-26.37109 -58.89656,-26.37109zM133.9786,54.86531c-2.79841,0.00347 -5.31595,1.7014 -6.36771,4.29465c-1.05175,2.59324 -0.42817,5.56514 1.57724,7.51691l12.33562,12.33563h-62.51125c-2.48118,-0.03509 -4.78904,1.2685 -6.03987,3.41161c-1.25083,2.1431 -1.25083,4.79369 0,6.93679c1.25083,2.1431 3.55869,3.4467 6.03987,3.41161h62.51125l-12.33562,12.33563c-1.79734,1.72562 -2.52135,4.28808 -1.89282,6.69912c0.62853,2.41104 2.5114,4.29391 4.92245,4.92245c2.41104,0.62853 4.9735,-0.09548 6.69912,-1.89282l23.4686,-23.46859c1.71744,-1.30466 2.72377,-3.33912 2.71849,-5.49591c-0.00528,-2.15678 -1.02155,-4.1863 -2.74536,-5.48253l-23.44172,-23.44172c-1.29693,-1.33318 -3.07834,-2.08452 -4.93828,-2.08281z"></path>
                        </g>
                    </g>
                </svg>
            </a>
        </div>
    <?php else : ?>
        <div class="enter_registration solo_reg">
            <div class="enter">
                <a rel="nofollow" href="#" class="enter_link">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"
                              class=""></path>
                    </svg>
                </a>
            </div>


        </div>

    <?php endif; ?>
</div>
