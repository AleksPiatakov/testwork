/* для блока із статистикою */
gapi.analytics.ready(function() {
  /**
   * Authorize the user immediately if the user has already granted access.
   * If no access has been created, render an authorize button inside the
   * element with the ID "embed-api-auth-container".
   */
  gapi.analytics.auth.authorize({
    container: 'embed-api-auth-container',
    clientid: '144192216421-9s0s34npldqgfdl90dalfgmuleqgufpo.apps.googleusercontent.com'
  });

  /**
   * Create a new ViewSelector instance to be rendered inside of an
   * element with the id "view-selector-container".
   */
  if (window.gaCurrentId === undefined && typeof(window.gaCurrentId) === 'object') {
    var gaCurrentId = window.gaCurrentId;
    var viewSelector = new gapi.analytics.ext.ViewSelector2({
      container: 'view-selector-container',
      option: {
        class: 'm-t'
      }
    }).set({accountId: gaCurrentId.account.id})
      .set({propertyId: gaCurrentId.property.id})
      .set({viewId: gaCurrentId.view.id})
      .execute();
  } else {
    var viewSelector = new gapi.analytics.ext.ViewSelector2({
      container: 'view-selector-container',
      option: {
        class: 'm-t'
      }
    }).execute();
  }

  /**
   * Create a new DataChart instance with the given query parameters
   * and Google chart options. It will be rendered inside an element
   * with the id "chart-container".
   */
  var dataChart1 = new gapi.analytics.googleCharts.DataChart({
    query: {
      metrics: 'ga:sessions',
      dimensions: 'ga:date',
      'start-date': '30daysAgo',
      'end-date': 'today'
    },
    chart: {
      container: 'data-chart-1-container',
      type: 'LINE',
      options: {
        width: '100%'
      }
    }
  });

  var dataChart2 = new gapi.analytics.googleCharts.DataChart({
    query: {
      metrics: 'ga:sessions',
      dimensions: 'ga:fullReferrer',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
      sort: ['-ga:sessions']
    },
    chart: {
      container: 'data-chart-2-container',
      type: 'PIE',
      options: {
        width: '100%',
        pieHole: 4/9
      }
    }
  });

  /**
   * Render the dataChart on the page whenever a new view is selected.
   */
  viewSelector.on('viewChange', function(data) {
    if (!gaCurrentId) {
      $.post('index.php', {'gaCurrentId': data}, function() {}, 'json');
    } else {
      data = gaCurrentId;
      gaCurrentId = '';
    }

    dataChart1.set({query: {ids: data.ids}}).execute();
    dataChart2.set({query: {ids: data.ids}}).execute();
  });
});
