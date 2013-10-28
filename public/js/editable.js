$(document).ready(function() {
    $.fn.editable.defaults.mode = 'inline';
    $('.x-editable').editable({
        ajaxOptions: {
            dataType: 'json'
        },
        success: function(response, newValue) {
            if(!response) {
                return "Unknown error!";
            }
            if(response.success === false) {
                 return response.msg;
            }
        }
    });
});
