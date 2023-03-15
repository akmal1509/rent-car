//Variable token for POST
var token = $("meta[name='csrf-token']").attr('content')

//Image Preview Backend
function previewImage() {
  const image = document.querySelector('#featured-image-input')
  const imgPreview = document.querySelector('.featured-image-preview')

  imgPreview.classList.remove('d-none')

  const oFReader = new FileReader()
  oFReader.readAsDataURL(image.files[0])

  oFReader.onload = function (oFREvent) {
    imgPreview.src = oFREvent.target.result
  }
}

//Delete specific data
function deleteData(id, type, urlData) {
  var method = $("meta[name='method-delete']").attr('content')
  $.ajax({
    type: 'POST',
    url: '/admin/cars/' + id,
    data: {
      id: id,
      type: type,
      _token: token,
      _method: method,
    },
    success: function () {
      location.replace('/admin/' + urlData)
    },
  })
}

//Delete permanent Data
function forceDeleteData(id, type, urlData) {
  $.ajax({
    type: 'POST',
    url: '/admin/general/force',
    data: {
      id: id,
      type: type,
      _token: token,
    },
    success: function () {
      location.replace('/admin/' + urlData + '/trashed')
    },
  })
}

//restore softDelete Data
function restoreData(id, type, urlData) {
  $.ajax({
    type: 'POST',
    url: '/admin/' + urlData + '/restore',
    data: {
      id: id,
      type: type,
      _token: token,
    },
    success: function () {
      location.replace('/admin/' + urlData + '/trashed')
    },
  })
}

//Duplicate Data
function duplicateData(id, type, slug, urlData) {
  $.ajax({
    type: 'POST',
    url: '/admin/' + urlData + '/duplicate',
    data: {
      id: id,
      type: type,
      slug: slug,
      _token: token,
    },
    success: function (data) {
      location.replace('/admin/' + urlData)
      console.log(data)
    },
  })
}

function bulkAction(type, urlData) {
  var checkedData = []
  var action = $('#bulk').val()
  $('.akm-check-box:checked').each(function () {
    checkedData.push($(this).data('id'))
  })
  if (checkedData <= 0) {
    alert('Please select atleast one record')
  }
  $.ajax({
    type: 'POST',
    url: '/admin/' + urlData + '/bulk',
    data: {
      type: type,
      id: checkedData,
      action: action,
      _token: token,
    },
    success: function (data) {
      location.replace('/admin/' + urlData)
      console.log(data)
    },
  })
}

//Logout
function logout() {
  $.ajax({
    type: 'POST',
    url: '/logout',
    data: {
      _token: token,
    },
    success: function (data) {
      location.replace('/mejakami')
    },
  })
}
