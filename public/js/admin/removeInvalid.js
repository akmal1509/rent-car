$(document).ready(function () {
  $('.akm-check').on('change', function () {
    if ($(this).attr('id') == 'featured-image-input') {
      $('.featured-image-backend').removeClass('is-invalid')
    }
    $(this).removeClass('is-invalid')
  })
})
