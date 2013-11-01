function cmsTimeAgo(bindval) {
    bindval = bindval || "abbr.timeago";
    $(bindval).timeago();
}

$(document).ready(cmsTimeAgo());
