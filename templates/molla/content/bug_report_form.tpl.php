<h1><?php echo BUG_REPORT_TITLE; ?></h1>
<form action="ajax.php" id="BugReportForm">
    <?= csrf() ?>
    <div class="text-center row">
        <div class="form-group col-sm-9 center-block">
            <input type="hidden" placeholder="" name="request" value="BugReportProccess">
            <textarea name="report_text" required class="bug-report-text form-control"
                      placeholder="<?php echo ENTRY_REPORT_TEXT; ?>" rows="10"></textarea>
        </div>
    </div>
    <div class="form-group clearfix">
        <div class="text-center">
            <img class="btn-loader" src="images/ajax-loader.gif">
            <input class="btn btn-default hidden" type="submit" value="<?php echo SEND_MESSAGE; ?>">
        </div>
    </div>
</form>
