$(function() {
    $('.form_datetime').datetimepicker({
        format: "dd MM yyyy - HH:ii P",
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 1,
        showMeridian: 1
    });
});
