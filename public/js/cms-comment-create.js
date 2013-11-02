function cmsCommentMessage(message, type) {
    $("#commentstatus").replaceWith("<label id=\"commentstatus\" class=\"has-"+type+"\"><div class=\"editable-error-block help-block\" style=\"display: block;\">"+message+"</div></label>");
}

function cmsCommentCreateSubmit(that) {
    cmsCommentMessage("Submitting comment...", "info");
    $(that).ajaxSubmit({ 
        dataType: 'json',
        clearForm: true,
        resetForm: true,
        timeout: 5000,
        success: function(data, status, xhr) {
            if (!xhr.responseJSON) {
                cmsCommentMessage("There was an unknown error!", "error");
                cmsCommentLock = false;
                return;
            }
            if (xhr.responseJSON.success !== true) {
                if (!xhr.responseJSON.msg) {
                    cmsCommentMessage("There was an unknown error!", "error");
                    cmsCommentLock = false;
                    return;
                }
                cmsCommentMessage(xhr.responseJSON.msg, "error");
                cmsCommentLock = false;
                return;
            }
            if (!xhr.responseJSON.msg || !xhr.responseJSON.comment) {
                cmsCommentMessage("There was an unknown error!", "error");
                cmsCommentLock = false;
                return;
            }
            cmsCommentMessage(xhr.responseJSON.msg, "success");
            if ($("#comments > div").length == 0) {
                $("#nocomments").fadeOut(300, function() {
                    $(this).remove();
                    $(xhr.responseJSON.comment).prependTo('#comments').hide().fadeIn(300, function() {
                        cmsTimeAgo();
                        cmsCommentEdit();
                        cmsCommentDelete();
                        cmsCommentLock = false;
                    });
                });
            } else {
                $(xhr.responseJSON.comment).prependTo('#comments').hide().slideDown(300, function() {
                    cmsTimeAgo();
                    cmsCommentEdit();
                    cmsCommentDelete();
                    cmsCommentLock = false;
                });
            }
        },
        error: function(xhr, status, error) {
            if (!xhr.responseJSON || !xhr.responseJSON.msg) {
                cmsCommentMessage("There was an unknown error!", "error");
                cmsCommentLock = false;
                return;
            }
            cmsCommentMessage(xhr.responseJSON.msg, "error");
            cmsCommentLock = false;
        }
    });
}

function cmsCommentCreate(bindval, body) {
    bindval = bindval || "#commentform";
    body = body || "textarea#body";
    $(bindval).submit(function() {
        cmsCommentMessage("Waiting for lock to clear...", "info");
        var that = this;
        var cmsCommentCreateCheck = setInterval(function() {
            if (cmsCommentLock == false) {
                clearInterval(cmsCommentCreateCheck);
                cmsCommentLock = true;
                cmsCommentCreateSubmit(that);
            }
        }, 10);
        return false;
    });
    $(body).keydown(function (e) {
        if (e.ctrlKey && e.keyCode === 13) {
            $(bindval).trigger("submit");
        }
    });
}
