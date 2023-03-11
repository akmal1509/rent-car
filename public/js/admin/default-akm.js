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

//Slug Checker
$(document).ready(function () {
  const title = document.querySelector('#name')
  const slug = document.querySelector('#slug')
  const slugStatus = document.querySelector('#slug_status')
  const type = document.querySelector('#type_slug')

  const abc = title.addEventListener('change', function () {
    fetch(
      '/admin/dashboard/createSlug?title=' +
        title.value +
        '&type=' +
        type.value,
    )
      .then((response) => response.json())
      .then((data) => {
        slug.value = data.slug
        if (data.status) {
          slugStatus.removeAttribute('hidden')
        } else {
          slugStatus.setAttribute('hidden', '')
        }
      })
  })

  slug.addEventListener('change', function () {
    fetch('/admin/dashboard/checkSlug?title=' + title.value + '&type=' + type)
      .then((response) => response.json())
      .then((data) => {
        slug.value = data.slug
        if (data.status) {
          slugStatus.removeAttribute('hidden')
        } else {
          slugStatus.setAttribute('hidden', '')
        }
      })
  })
})
