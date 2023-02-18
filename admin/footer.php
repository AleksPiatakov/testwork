<?php
if ($PHP_SELF != $adminFolder . '/seoassistant.php') { ?>
    </div>
<?php } ?>
</div>
<!-- footer -->
<footer id="footer" role="footer">
    <div class="col-sm-12 quote-wrapper">
        <div class="row quote_container">
            <p class="quote_container_text"></p>
            <span></span>
        </div>
    </div>
    <!-- fix width -->
    <div class="fix-width">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo getConstantValue("FOOTER_INSTRUCTION", ""); ?></div>
                        <div class="panel-body">
                            <iframe class="footer_frame" id="instruction" src="https://solomono.net/<?php echo $languages_code;?>/instruction.php"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo getConstantValue("FOOTER_NEWS", "");?></div>
                        <div class="panel-body">
                            <iframe class="footer_frame" id="news" src="https://solomono.net/<?php echo $languages_code;?>/news.php"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo getConstantValue("FOOTER_SUPPORT_SOLOMONO", ""); ?></div>
                        <div class="panel-body">
                           <ul class="footer-admin__support">
                               <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:admin@solomono.net">admin@solomono.net</a></li>
                               <li><i class="fa fa-phone" aria-hidden="true"></i><a class="footer-admin__support-tel" href="tel:+380978297989">+38 097 829-79-89</a></li>
                               <li><i class="fa fa-question-circle-o" aria-hidden="true"></i><a target="_blank" href="https://solomono.net/<?php echo $languages_code;?>/contacts-a-76.html"><?php echo FOOTER_SUPPORT_TECHNICAL?></a></li>
                               <li><i class="fa fa-globe" aria-hidden="true"></i><a target="_blank" href="https://solomono.net/<?php echo $languages_code;?>/">solomono.net</a></li>
                           </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 align_center"><?= getenv('APP_VERSION')?></div>
            </div>


            <!-- old - delete
            <a href="https://solomono.net" target="blanck">©
                <span class="text-u-l">Solomono</span> 2014-<?php /*print date('Y'); */ ?>
            </a>-->
        </div>
    </div>
    <!-- /fix width -->
</footer>
<!-- /footer -->

<div class="settings panel panel-default block hide">
    <?php require(DIR_WS_INCLUDES . 'material/blocks/settings.php'); ?>
</div>

  <script>
	  var USE_CRITICAL_CSS = '<?= USE_CRITICAL_CSS?>';
      $.ajax({
          url: 'https://<?=SOLOMONO_SITE . '/api/v1/api.php'?>',
            data: {
                request:'getRandomQuote',
                language:'<?=$languages_code?>'
            },
          method:'GET',
          success: function (data) {
              try {
                  data = decodeURI(data);
                  let response = JSON.parse(data);
                  if(typeof response != 'object')
                      response = JSON.parse(response);
                  if(response){
                      $('.quote_container').find('p').text('"' + response['text'] +'"');
                      $('.quote_container').find('span').text('"' + response['from']+'"');
                  }
              }catch (e) {
                  return;
              }
          }
      })
  </script>
<?php

if (isset($_SESSION['gaCurrentId']) and !empty($_SESSION['gaCurrentId'])) {
    ?>
    <script>
        window.gaCurrentId = JSON.parse('<?php print json_encode($_SESSION["gaCurrentId"]); ?>');
    </script>
    <?php
}

if ($_SERVER['REQUEST_URI']==DIR_WS_ADMIN . 'index.php' or $_SERVER['REQUEST_URI']==DIR_WS_ADMIN) { ?>
    <script>
        (function (w, d, s, g, js, fjs) {
            g = w.gapi || (w.gapi = {});
            g.analytics = {
                q: [], ready: function (cb) {
                    this.q.push(cb)
                }
            };
            js = d.createElement(s);
            fjs = d.getElementsByTagName(s)[0];
            js.src = 'https://apis.google.com/js/platform.js';
            fjs.parentNode.insertBefore(js, fjs);
            js.onload = function () {
                g.load('analytics')
            };
        }(window, document, 'script'));
    </script>
<!--    <script src="--><?php //echo DIR_WS_INCLUDES; ?><!--solomono/js/view-selector2.js"></script>-->
<!--    <script src="--><?php //echo DIR_WS_INCLUDES; ?><!--solomono/js/ga.js"></script>-->
<?php } ?>

<script src="<?php echo DIR_WS_INCLUDES; ?>material/js/ui-load.js"></script>
<script src="<?php echo DIR_WS_INCLUDES; ?>material/js/ui-jp.config.js"></script>
<script src="<?php echo DIR_WS_INCLUDES; ?>material/js/ui-jp.js"></script>
<script src="<?php echo DIR_WS_INCLUDES; ?>material/js/ui-nav.js"></script>
<script src="<?php echo DIR_WS_INCLUDES; ?>material/js/ui-toggle.js"></script>
<script src="<?php echo DIR_WS_INCLUDES; ?>material/js/ui-client.js"></script>
<script src="<?php echo DIR_WS_INCLUDES; ?>material/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<script>$.fn.collapse.Constructor.TRANSITION_DURATION = 0</script>
<!--  <script src="--><?php //echo DIR_WS_INCLUDES; ?><!--solomono/libs/jquery-ui-1.12.1/jquery-ui.min.js"></script>-->
<script src="<?php echo DIR_WS_INCLUDES; ?>solomono/js/components/actions_overview.js"></script>
<script defer src="<?php echo DIR_WS_INCLUDES; ?>solomono/js/solomono.js?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES.'solomono/js/solomono.js')?>"></script>
<script src="<?php echo DIR_WS_INCLUDES; ?>solomono/js/solomono_admin.js?t=<?=filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES.'solomono/js/solomono_admin.js')?>"></script>
<script src="<?php echo DIR_WS_INCLUDES; ?>javascript/colorpicker/js/colorpicker.js"></script>
<script src="<?php echo DIR_WS_INCLUDES; ?>solomono/libs/simplePagination/jquery.SimplePagination.js"></script>
<script src="<?php echo DIR_WS_INCLUDES?>ckeditor/ckeditor.js"></script>
<script src="<?php echo DIR_WS_INCLUDES;?>ckfinder/ckfinder.js"></script>
<script src="<?php echo DIR_WS_INCLUDES; ?>javascript/OverlayScrollbars/jquery.overlayScrollbars.min.js"></script>

<?php
if ($current_file == 'index') { ?>
    <script defer src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <?php include(DIR_WS_INCLUDES.'solomono/js/plot_init.php'); ?>
<?php } else if ($current_file == 'stats_monthly_sales') { ?>
    <script defer src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <?php include(DIR_WS_INCLUDES.'solomono/js/plot_init_cols.php'); ?>
<?php } else if ($current_file == 'dashboard') { ?>
<script defer src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="<?php echo DIR_WS_INCLUDES; ?>solomono/js/charts.js"></script>
<?php } ?>



<?php if (strstr($_SERVER['PHP_SELF'],'new_admin-panel.php')): ?>
  <script src="<?php echo DIR_WS_INCLUDES;?>solomono/js/new_admin-panel.js?t=<?=filesize(DIR_WS_INCLUDES.'solomono/js/new_admin-panel.js')?>"></script>
<?php endif; ?>


<link rel="stylesheet" href="/includes/javascript/selectize/selectize.css" type="text/css">
<script src="/includes/javascript/selectize/selectize.js"></script>
