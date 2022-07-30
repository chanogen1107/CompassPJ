$('#hogeModal').on('click', function () {
  var reserve_date = $(this).attr('reserve_date');
  var reserve_part = $(this).attr('reserve_part');
  var reserve_id = $(this).attr('reserve_id');
  $('.modal-date').html(reserve_date);
  $('.modal-part').html(reserve_part);
  $('.modal-id-hidden').val(reserve_id);
  $('.modal-date-hidden').val(reserve_date);
  $('.modal-part-hidden').val(reserve_part);
  // $('myModalLabel').modal('show');
  // // return false;
})