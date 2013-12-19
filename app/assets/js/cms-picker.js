$(function() {
    $('.form_datetime').datetimepicker({
        format: "mm/dd/yyyy hh:ii",
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 1,
        showMeridian: 1
    });
});
