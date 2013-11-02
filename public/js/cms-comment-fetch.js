var cmsCommentFetchRaw;
var cmsCommentFetchData;

function cmsCommentFetchGet() {
    if (cmsCommentFetchData.length != 0) {
        console.log('get - '+cmsCommentFetchData[0]);
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
                            cmsTimeAgo("'#timeago_comment_"+xhr.responseJSON.comment_id+"'");
                            cmsCommentEdit("'#editable_comment_"+xhr.responseJSON.comment_id+"_1'");
                            cmsCommentEdit("'#editable_comment_"+xhr.responseJSON.comment_id+"_2'");
                            cmsCommentDelete("'#deletable_comment_"+xhr.responseJSON.comment_id+"_1'");
                            cmsCommentDelete("'#deletable_comment_"+xhr.responseJSON.comment_id+"_2'");
                            cmsCommentFetchData.splice(0, 1);
                            cmsCommentFetchGet();
                        });
                    });
                } else {
                    $(xhr.responseJSON.contents).prependTo('#comments').hide().slideDown(300, function() {
                        cmsTimeAgo("'#timeago_comment_"+xhr.responseJSON.comment_id+"'");
                        cmsCommentEdit("'#editable_comment_"+xhr.responseJSON.comment_id+"_1'");
                        cmsCommentEdit("'#editable_comment_"+xhr.responseJSON.comment_id+"_2'");
                        cmsCommentDelete("'#deletable_comment_"+xhr.responseJSON.comment_id+"_1'");
                        cmsCommentDelete("'#deletable_comment_"+xhr.responseJSON.comment_id+"_2'");
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

function cmsCommentFetchNew() {
    var length = cmsCommentFetchRaw.length;
    cmsCommentFetchData = new Array();

    for (var i = 0; i < length; i++) {
        var ok = false;
        $("#comments > div").each(function() {
            if ($(this).data('pk') == cmsCommentFetchRaw[i].comment_id) {
                ok = true;
            }
        });

        if (ok == false) {
            cmsCommentFetchData.push(cmsCommentFetchRaw[i].comment_id);
        }
    }

    cmsCommentFetchGet();
}

function cmsCommentFetchReplace() {
    if (cmsCommentFetchData.length != 0) {
        console.log('replace - '+cmsCommentFetchData[0]);
        $.ajax({
            url: $("#comments").data("url")+"/"+cmsCommentFetchData[0],
            type: "GET",
            dataType: "json",
            timeout: 5000,
            success: function(data, status, xhr) {
                if (!xhr.responseJSON) {
                    cmsCommentFetchData.splice(0, 1);
                    cmsCommentFetchReplace();
                    return;
                }
                if (!xhr.responseJSON.comment_id || !xhr.responseJSON.comment_ver || !xhr.responseJSON.comment_text) {
                    cmsCommentFetchData.splice(0, 1);
                    cmsCommentFetchReplace();
                    return;
                }
                $("'#editable_comment_"+xhr.responseJSON.comment_id+"_1'").data("ver", xhr.responseJSON.comment_ver);
                $("'#editable_comment_"+xhr.responseJSON.comment_id+"_2'").data("ver", xhr.responseJSON.comment_ver);
                $("'#comment_"+xhr.responseJSON.comment_id+"'").data("ver", xhr.responseJSON.comment_text);
                $("'#main_comment_"+xhr.responseJSON.comment_id+"'").text(xhr.responseJSON.comment_text);
                console.log('updated comment with id '+xhr.responseJSON.comment_id+' to version '+xhr.responseJSON.comment_ver+' with text of '+xhr.responseJSON.comment_text);
                cmsCommentFetchData.splice(0, 1);
                cmsCommentFetchReplace();
            },
            error: function(xhr, status, error) {
                cmsCommentFetchData.splice(0, 1);
                cmsCommentFetchReplace();
            }
        });
        return;
    }

    cmsCommentFetchNew();
}

function cmsCommentFetchUpdate() {
    var length = cmsCommentFetchRaw.length;
    cmsCommentFetchData = new Array();

    for (var i = 0; i < length; i++) {
        $("#comments > div").each(function() {
            console.log('selected id '+$(this).data('pk'));
            if ($(this).data('pk') == cmsCommentFetchRaw[i].comment_id) {
                console.log('matched id '+$(this).data('pk'));
                if ($(this).data('ver') != cmsCommentFetchRaw[i].comment_ver) {
                    console.log('old version detected');
                    cmsCommentFetchData.push(cmsCommentFetchRaw[i].comment_id);
                } else {
                    console.log('new version detected');
                }
            } else {
                console.log('id not on the list');
            }
        });
    }

    cmsCommentFetchReplace();
}

function cmsCommentFetchProcess() {
    var length = cmsCommentFetchRaw.length;
    var num = 0;
    var done = 0;

    $("#comments > div").each(function() {
        var ok = false;
        for (var i = 0; i < length; i++) {
            if ($(this).data('pk') == cmsCommentFetchRaw[i].comment_id) {
                ok = true;
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
            cmsCommentFetchUpdate();
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
            cmsCommentFetchRaw = xhr.responseJSON;
            cmsCommentFetchProcess();
        },
        error: function(xhr, status, error) {
            if (!xhr.responseJSON) {
                cmsCommentLock = false;
                cmsCommentFetch();
                return;
            }
            if (xhr.responseJSON.url && xhr.responseJSON.code == 404) {
                window.location.replace(xhr.responseJSON.url);
                return;
            }
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
