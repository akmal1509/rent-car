//Slug Checker
$(document).ready(function () {
  const title = document.querySelector('#name')
  const slug = document.querySelector('#slug')
  const slugStatus = document.querySelector('#slug_status')
  const type = document.querySelector('#type_slug')

  const checkTitleChange = title.addEventListener('change', function () {
    fetch(
      '/admin/general/createSlug?title=' + title.value + '&type=' + type.value,
    )
      .then((response) => response.json())
      .then((data) => {
        slug.value = data.slug
        console.log(data)
        if (data.status) {
          slugStatus.removeAttribute('hidden')
          slug.classList.add('is-invalid')
          $('#invalid-slug').css('display', 'none')
          slugStatus.style.display = 'block'
        } else {
          slugStatus.setAttribute('hidden', '')
          slug.classList.remove('is-invalid')
        }
      })
  })

  slug.addEventListener('change', function () {
    fetch('/admin/general/checkSlug?title=' + slug.value + '&type=' + type)
      .then((response) => response.json())
      .then((data) => {
        slug.value = data.slug
        if (data.status) {
          slugStatus.removeAttribute('hidden')
          if (!slug.classList.contains('is-invalid')) {
            slug.classList.add('is-invalid')
          }
        } else {
          slugStatus.setAttribute('hidden', '')
          slug.classList.remove('is-invalid')
        }
      })
  })
})
