<?php
  require('includes/application_top.php');
  $current_file = 'dashboard';

  include_once('html-open.php');
  include_once('header.php');
  
?>


  <!-- body //-->
  <div class="container backup">
    <div class="wrapper-title">
      <div class="bg-light lter ng-scope">
        <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE; ?></h1>
      </div>
    </div>
    <!-- body_text //-->
    
    <div class="charts-section">
        
        <div class="months-comparison-chart">
            <span class="title">Today</span>    
            <div id="months-comparison-chart" class="item-chart"></div>
        </div>

        <div class="charts-group">
            <span class="title">Reports overview</span>

            <div class="charts-list">
                <span class="item">
                    <div class="gross-volume chart-el"></div>
                </span>
                <span class="item">
                    <div class="new-customers chart-el"></div>
                </span>
                <span class="item">
                    <div class="successful-payments chart-el"></div>
                </span>

                <span class="item">
                    <div class="revenue-per-customer chart-el"></div>
                </span>
                <span class="item">
                    <div class="high-risk-payments chart-el"></div>
                </span>
                <span class="item">
                    <div class="net-volume-sales chart-el"></div>
                </span>
                
            </div>
        </div>
    </div>

    <!-- body_text_smend //-->
  </div>
<!-- body_smend //-->
<?php
    include_once('footer.php');
    include_once('html-close.php');
    require(DIR_WS_INCLUDES . 'application_bottom.php');
?>