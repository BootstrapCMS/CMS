$(document).ready(function () {
    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();
    });
});
