function cmsCommentEditShow(that) {
    setTimeout(function() {
        console.log($("#main_comment_"+$(that).date('pk')).text());
    }, 50);

    bootbox.prompt("Edit Comment", function(result) {
        console.log(result);

        if (!result) {
            cmsCommentLock = false;
            result;
        }

        $.ajax({
            url: $(that).attr("href"),
            type: "PATCH",
            data: {body: result},
            dataType: "json",
            timeout: 5000,
            success: function(data, status, xhr) {
                if (!xhr.responseJSON) {
                    cmsCommentLock = false;
                    return;
                }
                if (xhr.responseJSON.success !== true || !xhr.responseJSON.msg || !xhr.responseJSON.comment_id || !xhr.responseJSON.comment_ver || !xhr.responseJSON.comment_text) {
                    cmsCommentLock = false;
                    return;
                }
                $("#editable_comment_"+xhr.responseJSON.comment_id+"_1").data("ver", xhr.responseJSON.comment_ver);
                $("#editable_comment_"+xhr.responseJSON.comment_id+"_2").data("ver", xhr.responseJSON.comment_ver);
                $("#comment_"+xhr.responseJSON.comment_id).data("ver", xhr.responseJSON.comment_ver);
                $("#main_comment_"+xhr.responseJSON.comment_id).fadeOut(150, function() {
                    $(this).text(xhr.responseJSON.comment_text);
                    $(this).fadeIn(150, function() {
                        cmsCommentLock = false;
                    });
                });
            },
            error: function(xhr, status, error) {
                cmsCommentLock = false;
            }
        });
    });
}

function cmsCommentEdit(bindval) {
    bindval = bindval || ".editable";
    $(bindval).click(function() {
        var that = this;
        var cmsCommentEditCheck = setInterval(function() {
            if (cmsCommentLock == false) {
                clearInterval(cmsCommentEditCheck);
                cmsCommentLock = true;
                cmsCommentEditShow(that);
            }
        }, 10);
        return false;
    });
}
