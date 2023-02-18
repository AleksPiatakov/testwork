<div class="row">
    <div class="col-xs-12">
        <div class="wrapper_stats_keywords" id="stats_keywords"  >
                <?php require "form_swap_temp.php";?>
        </div>
        <div class="add_words">
            <div class="col-xs-5"><input type="text" value="" class="form-control" name="sws_word"></div>
            <div class="col-xs-5"><input type="text" value="" class="form-control" name="sws_replacement"></div>
            <div class="col-xs-2" style="margin-bottom: 15px; padding: 0;"><button type="button" style="width: 100%" id="add_button" class="btn btn-default"><?php echo BUTTON_ADD; ?></button></div>
        </div>
    </div>
    <div class="form-group text-right">
        <div class="col-sm-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#stats_keywords').on('click', '.input_wrapper', function () {
            $('.input_wrapper input').addClass('disabled').removeClass('active');
            var $input = $(this).find('input');
            $input.removeClass('disabled').addClass('active').select();
        });

        $('#stats_keywords').on('change', '.input_wrapper input', function () {
            var $this = $(this);
            var word_id = $(this).closest('tr').attr('data-id');
            var field = $this.attr('name');
            var value = $this.val();
            $.post(window.location.pathname, {action: "updateWord", sws_id: word_id, field: field, value: value}, function (response) {
                if(response['success'] == true){
                    $('#stats_keywords').html(response['html']);
                }
            }, "json");
            $this.addClass('disabled').removeClass('active');
        });

        $('#add_button').click(function () {
            var $this = $(this).closest('.add_words');
            var sws_word = $this.find('input[name="sws_word"]').val();
            var sws_replacement = $this.find('input[name="sws_replacement"]').val();
            $.post(window.location.pathname, {action: "insertWord", sws_word: sws_word, sws_replacement: sws_replacement}, function (response) {
                if(response['success'] == true){
                    $('#stats_keywords').html(response['html']);
                }
            }, "json");
        })

        $('#stats_keywords').on('click', '.fa-trash-o', function () {
            var $this = $(this);
            var word_id = $(this).closest('tr').attr('data-id');
            $.post(window.location.pathname, {action: "deleteWord", sws_id: word_id}, function (response) {
                if(response['success'] == true){
                    $('#stats_keywords').html(response['html']);
                }
            }, "json");
            $this.addClass('disabled').removeClass('active');
        });
    });
</script>