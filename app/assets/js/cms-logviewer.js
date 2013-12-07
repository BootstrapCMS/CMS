$(document).ready(function () {
    
    $('.stack-trace').hide();
    
    $('.toggle-stack').on('click', function (e) {
        var stack = $(this).siblings('.stack-trace');
        var icon = $(this).children('i');
        stack.slideToggle('fast', function () {
            icon.toggleClass('icon-expand-alt icon-collapse-alt');
        });
    });
    
});
