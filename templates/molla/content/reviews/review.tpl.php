<div class="comment clearfix" style="margin-left:0px;" data-id="{{review_id}}">

    <div class="comment_top clearfix">
        <div class="comment_head left" style="width:65%;float: left">
            <span class="comment_author"><b><span id="n135">{{name}} </span></b>
            </span> <br> <span class="comment_date">{{date_added}}</span>
        </div>
        <div class="comment_head right" style="width:35%;float: right">
            <div class="rating_wrapper" style="float: right">
                <div class="sp_rating">
                    <div class="base">
                        <div class="average" style="width:{{rating}}%">{{rating}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="comment_text left">
        <div>{{text}}</div>
    </div>
    {{answer_button}} {{children}}

</div>
