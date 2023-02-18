<div class="add_comment_box">
    <p>{{header}}</p>
    <div class="row add-comment-row">
        <div class="col-md-4 comment-skin-body">
            <input type="hidden" name="cid" value="{{customer_id}}"> <input type="hidden" name="pid"
                                                                            value="{{product_id}}"> <input type="hidden"
                                                                                                           name="parent_id"
                                                                                                           value="0"
                                                                                                           class="form-control">
            <div class="form-group">
                <input class="form-control" placeholder="{{placeholderName}}" type="text" name="name" id="nickAnswer"
                       maxlength="40" value="{{customer_name}}" size="20">
            </div>

            <div class="form-group">
                <textarea class="form-control" placeholder="{{placeholderComment}}" rows="5"
                          name="text"></textarea>
            </div>
            <div class="form-group">
                <div class="rating_wrapper">
                    <div class="sp_rating">
                        <div class="base">
                            <div class="average" style="width: 100%;"></div>
                        </div>
                        <div class="status">
                            <div class="score review_score">
                                <span class="score1" data-val="1"></span> <span class="score2" data-val="2"></span>
                                <span class="score3" data-val="3"></span> <span class="score4" data-val="4"></span>
                                <span class="score5" data-val="5"></span>
                            </div>
                        </div>
                        <input type="hidden" name="rating" value="5">
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-group">
                {{recaptchaContainer}}
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-info" onclick="addReview('.add_comment_box')">{{buttonSend}}
                </button>
            </div>
        </div>
    </div>
</div>
