function cmsCommentDeleteSubmit(that) {
    $.ajax({
        url: $(that).attr("href"),
        type: "DELETE",
        dataType: "json",
        timeout: 5000,
        success: function(data, status, xhr) {
            if (!xhr.responseJSON) {
                cmsCommentLock = false;
                return;
            }
            if (xhr.responseJSON.success !== true || !xhr.responseJSON.msg || !xhr.responseJSON.comment_id) {
                cmsCommentLock = false;
                return;
            }
            $("#comment_"+xhr.responseJSON.comment_id).slideUp(cmsCommentTime, function() {
                $(this).remove();
                if ($("#comments > div").length == 0 && $("#comments > p").length == 0) {
                    $("<p id=\"nocomments\">There are currently no comments.</p>").prependTo("#comments").hide().fadeIn(cmsCommentTime, function() {
                        cmsCommentLock = false;
                    });
                } else {
                    cmsCommentLock = false;
                }
            });
        },
        error: function(xhr, status, error) {
            cmsCommentLock = false;
        }
    });
}

function cmsCommentDelete(bindval) {
    bindval = bindval || ".deletable";
    $(bindval).click(function() {
        var that = this;
        var cmsCommentDeleteCheck = setInterval(function() {
            if (cmsCommentLock == false) {
                clearInterval(cmsCommentDeleteCheck);
                cmsCommentLock = true;
                cmsCommentDeleteSubmit(that);
            }
        }, 10);
        return false;
    });
}
