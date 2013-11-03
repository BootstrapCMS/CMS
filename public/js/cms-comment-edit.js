function cmsCommentSubmit(that) {
    $.ajax({
        url: $("#comments").data("url")+"/"+$(that).data("pk"),
        type: "PATCH",
        data: {body: $("#edit_body").text()},
        dataType: "json",
        timeout: 5000,
        success: function(data, status, xhr) {
            if (!xhr.responseJSON) {
                $("#edit_comment").modal("hide");
                return;
            }
            if (xhr.responseJSON.success !== true || !xhr.responseJSON.msg || !xhr.responseJSON.comment_id || !xhr.responseJSON.comment_ver || !xhr.responseJSON.comment_text) {
                $("#edit_comment").modal("hide");
                return;
            }
            $("#comment_"+xhr.responseJSON.comment_id).data("ver", xhr.responseJSON.comment_ver);
            $("#main_comment_"+xhr.responseJSON.comment_id).fadeOut(150, function() {
                $(this).text(xhr.responseJSON.comment_text);
                $(this).fadeIn(150, function() {
                    $("#edit_comment").modal("hide");
                });
            });
        },
        error: function(xhr, status, error) {
            $("#edit_comment").modal("hide");
        }
    });
}

function cmsCommentEditShow(that) {
    $("#edit_comment_ok").data("pk", $(that).data('pk'));
    $("#edit_body").text($("#main_comment_"+$(that).data('pk')).text().replace(/<br\s*[\/]?>/gi, "\n"));
    $("#edit_comment").modal("show");
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

function cmsCommentModel() {
    $("#edit_comment").on("hidden.bs.modal", function () {
        cmsCommentLock = false;
    });
    $("#edit_comment_ok").click(function () {
        var that = this;
        cmsCommentSubmit(that);
    });
}
