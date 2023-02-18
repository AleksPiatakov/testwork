/* --------- SEARCH --------- */
/*  jQuery('#searchpr').on({
      focus: function() {
          jQuery(this).val() == this.defaultValue && jQuery(this).val('');
      },
      blur: function() {
          !jQuery(this).val() && jQuery(this).val(this.defaultValue);
      }
  });  */
var id_search = $("#searchpr").attr('id');
$("#searchpr").autocomplete("ajax_search.php", {
    resultsClass: "ac_results " + id_search,
    delay: 200,
    minChars: 2,
    matchSubset: 1,
    autoFill: false,
    matchContains: 1,
    cacheLength: 10,
    selectFirst: true,
    formatItem: liFormat,
    maxItemsToShow: 8,
    onItemSelect: selectItem
});
$("#searchpr1").autocomplete("ajax_search.php", {
    delay: 200,
    minChars: 2,
    matchSubset: 1,
    autoFill: false,
    matchContains: 1,
    cacheLength: 10,
    selectFirst: true,
    formatItem: liFormat,
    maxItemsToShow: 8,
    onItemSelect: selectItem
});
/* --------- END SEARCH --------- */