<!-- settings -->
<button class="btn btn-default no-shadow pos-abt" ui-toggle-class="active" target=".settings">
  <i class="fa fa-spin fa-gear"></i>
</button>
<div class="panel-heading">
  <?php print TEXT_BLOCK_SETTINGS_TITLE; ?>
</div>
<div class="panel-body">
  <div class="m-b-sm">
    <label class="i-switch bg-info pull-right">
      <input class="settings-header-fixed" type="checkbox" ng-model="app.settings.headerFixed">
      <i></i>
    </label>
    <?php print TEXT_BLOCK_SETTINGS_TITLE_FIXED_HEADER; ?>
  </div>
  <div class="m-b-sm">
    <label class="i-switch bg-info pull-right">
      <input class="settings-aside-fixed" type="checkbox">
      <i></i>
    </label>
    <?php print TEXT_BLOCK_SETTINGS_TITLE_FIXED_ASIDE; ?>
  </div>
  <div class="m-b-sm">
    <label class="i-switch bg-info pull-right">
      <input class="settings-aside-folded" type="checkbox">
      <i></i>
    </label>
    <?php print TEXT_BLOCK_SETTINGS_TITLE_FOLDED_ASIDE; ?>
  </div>
  <div>
    <label class="i-switch bg-info pull-right">
      <input class="settings-aside-dock" type="checkbox">
      <i></i>
    </label>
    <?php print TEXT_BLOCK_SETTINGS_TITLE_DOCK_ASIDE; ?>
  </div>
</div>
<!-- /settings -->
