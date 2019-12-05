// EDIT TALK
const editBtn = document.querySelectorAll('.edit')

const editTalk = async (talk, newDate) => {
  const data = JSON.stringify({ talk: talk, date: newDate })

  const req = await fetch('scripts/update_talk.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: data
  })

  const res = await req.json()

  if (res == 200) {
    location.reload()
  } else if (res == 500) {
    alert('Es ist ein Fehler aufgetreten')
  }
}

editBtn.forEach(btn => {
  const targetID = btn.dataset.target
  const datepicker = flatpickr(btn, {
    locale: 'de',
    onClose: function(selectedDate, dataStr, instance) {
      editTalk(targetID, dataStr)
    }
  })
})
