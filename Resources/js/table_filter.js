$(document).ready(function(){
  $('.table-filter').keyup(function(){
    // alert('keyup');
    var table = $(this).data('target-table');
    var rows = $(table).find('tr');
    var input = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

    rows.show().filter(function() {
      var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
      return !~text.indexOf(input);
    }).hide();
  })
});
