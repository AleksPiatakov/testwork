<?php
/*
  $Id: header.php,v 1.2 2003/09/24 13:57:07 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  if ($messageStack->size > 0) {
    echo $messageStack->output();
  }

?>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script>
    (function(){ var widget_id = '7fHxLsgnxP';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
    	<?php 
        	// #CP - point logos to come from selected template's images directory
		    $template_query = tep_db_query("select configuration_id, configuration_title, configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_TEMPLATE'");
  			$template = tep_db_fetch_array($template_query);
  			$CURR_TEMPLATE = $template['configuration_value'] . '/';
        ?>

<div>
  <div style="float:left;"><a href="index.php"><img src="images/logo.png" border="0" /></a></div>
  <div style="float:left;padding: 26px 6px 0 26px;"><span><?php echo HEADER_TITLE_HELLO; ?>, <b><?php echo $_SESSION['login_first_name']; ?></b>.</span>
  <a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'NONSSL');?>" ><?php echo HEADER_TITLE_LOGOFF; ?></a>
  </div>
  <div style="clear:both;"></div>
</div>