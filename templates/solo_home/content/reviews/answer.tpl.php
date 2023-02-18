<div class="add_comment_box">
    <div class="row add-comment-row">
        <div class="col-xs-12 comment-skin-body">
            <input type="hidden" name="cid" value="{{customer_id}}">
            <input type="hidden" name="pid" value="{{product_id}}">
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
                <button type="button" class="btn btn-info" onclick="addReview('.add_comment_box')">
                    {{buttonSend}}
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
