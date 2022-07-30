$('#testModal').on('click', function () {
  var reserve_date = $(this).attr('reserve_date');
  var reserve_part = $(this).attr('reserve_part');
  var reserve_id = $(this).attr('reserve_id');
  $('.modal-date').val(reserve_date);
  $('.modal-part').val(reserve_part);
  $('.modal-id-hidden').val(reserve_id);
  $('myModalLabel').modal('show');
  // return false;
})