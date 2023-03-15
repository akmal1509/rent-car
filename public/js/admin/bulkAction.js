$(document).ready(function () {
  $('#bulk').on('change', function () {
    const data = $(this).val()
    if (data) {
      $('#button-bulk').attr('disabled', false)
    } else {
      $('#button-bulk').attr('disabled', true)
    }
  })
})
