$(document).ready(function() {
  if (typeof js_datetime_format === 'undefined') {
    js_datetime_format = 'D/M/YYYY HH:mm';
  }
  $('#datetimepicker1').datetimepicker({
    format: js_datetime_format
  });
});
