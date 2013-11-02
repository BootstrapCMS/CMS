var cmsCommentFetchData = new Array();

function cmsCommentFetchGet() {
    if (cmsCommentFetchData.length != 0) {
        $.ajax({
            url: $("#comments").data("url")+"/"+cmsCommentFetchData[0],
            type: "GET",
            dataType: "json",
            timeout: 5000,
            success: function(data, status, xhr) {
                if (!xhr.responseJSON) {
                    cmsCommentFetchData.splice(0, 1);
                    cmsCommentFetchGet();
                    return;
                }
                if (!xhr.responseJSON.contents || !xhr.responseJSON.comment_id) {
                    cmsCommentFetchData.splice(0, 1);
                    cmsCommentFetchGet();
                    return;
                }
                if ($("#comments > div").length == 0) {
                    $("#nocomments").fadeOut(300, function() {
                        $(this).remove();
                        $(xhr.responseJSON.contents).prependTo('#comments').hide().fadeIn(300, function() {
                            cmsTimeAgo("#timeago_comment_"+xhr.responseJSON.comment_id);
                            cmsCommentEdit("#editable_comment_"+xhr.responseJSON.comment_id);
                            cmsCommentDelete("#deletable_comment_"+xhr.responseJSON.comment_id+"_1");
                            cmsCommentDelete("#deletable_comment_"+xhr.responseJSON.comment_id+"_2");
                            cmsCommentFetchData.splice(0, 1);
                            cmsCommentFetchGet();
                        });
                    });
                } else {
                    $(xhr.responseJSON.contents).prependTo('#comments').hide().slideDown(300, function() {
                        cmsTimeAgo("#timeago_comment_"+xhr.responseJSON.comment_id);
                        cmsCommentEdit("#editable_comment_"+xhr.responseJSON.comment_id);
                        cmsCommentDelete("#deletable_comment_"+xhr.responseJSON.comment_id+"_1");
                        cmsCommentDelete("#deletable_comment_"+xhr.responseJSON.comment_id+"_2");
                        cmsCommentFetchData.splice(0, 1);
                        cmsCommentFetchGet();
                    });
                }
            },
            error: function(xhr, status, error) {
                cmsCommentFetchData.splice(0, 1);
                cmsCommentFetchGet();
            }
        });
        return;
    }

    if ($("#comments > div").length == 0 && $("#comments > p").length == 0) {
        $("<p id=\"nocomments\">There are currently no comments.</p>").prependTo("#comments").hide().fadeIn(300, function(){
            cmsCommentLock = false;
            cmsCommentFetch();
        });
    } else {
        cmsCommentLock = false;
        cmsCommentFetch();
    }
}

function cmsCommentFetchNew(data) {
    var length = data.length;
    cmsCommentFetchData = new Array();

    for (var i = 0; i < length; i++) {
        var ok = false;
        $("#comments > div").each(function() {
            if ($(this).data('pk') == data[i].comment_id) {
                ok = true;
            }
        });

        if (ok == false) {
            cmsCommentFetchData.push(data[i].comment_id);
        }
    }

    cmsCommentFetchGet();
}

function cmsCommentFetchProcess(data) {
    var length = data.length;
    var num = 0;
    var done = 0;

    $("#comments > div").each(function() {
        var ok = false;
        for (var i = 0; i < length; i++) {
            if ($(this).data('pk') == data[i].comment_id) {
                if ($(this).data('ver') == data[i].comment_ver) {
                    ok = true;
                }
            }
        }
        if (ok == false) {
            num++;
            $(this).slideUp(300, function() {
                $(this).remove();
                done++;
            });
        }
    });

    var cmsCommentNewCheck = setInterval(function() {
        if (num === done) {
            clearInterval(cmsCommentNewCheck);
            cmsCommentFetchNew(data);
        }
    }, 10);
}

function cmsCommentFetchWork() {
    $.ajax({
        url: $("#comments").data('url'),
        type: "GET",
        dataType: "json",
        timeout: 5000,
        success: function(data, status, xhr) {
            if (!xhr.responseJSON) {
                cmsCommentLock = false;
                cmsCommentFetch();
                return;
            }
            cmsCommentFetchProcess(xhr.responseJSON);
        },
        error: function(xhr, status, error) {
            cmsCommentLock = false;
            cmsCommentFetch();
        }
    });
}

function cmsCommentFetchWait() {
    var cmsCommentFetchCheck = setInterval(function() {
        if (cmsCommentLock == false) {
            cmsCommentLock = true;
            clearInterval(cmsCommentFetchCheck);
            cmsCommentFetchWork()
        }
    }, 10);
    return false;
}

function cmsCommentFetch() {
    setTimeout(function() {
        cmsCommentFetchWait()
    }, 5000);
}
