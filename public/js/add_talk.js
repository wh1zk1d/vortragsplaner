const form = document.getElementById('form')
const successAlert = document.querySelector('.alert-success')
const failAlert = document.querySelector('.alert-danger')

form.onsubmit = async e => {
  e.preventDefault()

  const req = await fetch('scripts/add_talk.php', {
    method: 'POST',
    body: new FormData(form)
  })

  const res = await req.json()

  successAlert.style.display = 'none'
  failAlert.style.display = 'none'

  if (res == '200') {
    successAlert.style.display = 'block'
    form.reset()
  } else {
    failAlert.style.display = 'block'
  }
}
