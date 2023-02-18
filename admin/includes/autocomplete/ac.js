  // Solomono jQuery Autocomplete module for osCommerce. 2017
  // full descriprion of UI autocomplete here: http://api.jqueryui.com/autocomplete/

      jQuery(document).ready(function() {
      	$("input[name=keywords]").autocomplete({
      		url: 'includes/autocomplete/ac.php', // link to php source
      		minLength: 2, // minimum number of characters a user must type before a search is performed
            resultsClass: "ac_results",
            delay: 200, // delay in milliseconds between when a keystroke occurs and when a search is performed
            minChars: 2,
            matchSubset: 1,
            autoFill: false,
            matchContains: 1,
            cacheLength: 10,
            selectFirst: true,
            formatItem: function( row, i, num ) {  // custom style for products listing in search box
                return '<div class="search_image_wrap"><img src="' + row[2] + '" class="picsearch"></div>' + '<span><p class=qntid>' + 'ID: ' + row[3] + ' </p>' + '<p class=qnt1>' + row[0] + ' </p></span><span><p class=qntp>' + row[4] + '</p>' + '<p class=qnt>' + row[1] + ' </p></span>';
            },
            maxItemsToShow: 8,
            onItemSelect: function( event, ui ) {  // what to do when we click on product
                $('*[name=products_id]').val(event.extra[2]);
                $('*[name=products_price]').val(event.extra[3]);
                return false;
            },
      	});
      });