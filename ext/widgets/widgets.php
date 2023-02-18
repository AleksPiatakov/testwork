    <script>
         window.fbAsyncInit = function() {
             FB.init({
                 appId      : '<?php echo $fb_app_id;?>',
                 xfbml      : true,
                 version    : 'v2.5'
             });
         //   FB.Event.subscribe('edge.create', function(response) {alert('You will get discount 5%');});
         //   FB.Event.subscribe('edge.remove',function(response) {alert('Your discount 5% was canceled!');});
         };   

         (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/<?php echo $lng->language['code']; ?>_<?php echo strtoupper($lng->language['code']); ?>/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
    </script>