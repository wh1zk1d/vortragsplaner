// GET DOM objects
const pdfBtn = document.querySelector('.pdf-export')
const editBtn = document.querySelectorAll('.edit')
const deleteBtn = document.querySelectorAll('.delete')

// EDIT TALK
const editTalk = async (talk, newDate) => {
  const data = JSON.stringify({ talk: talk, date: newDate })

  const req = await fetch('scripts/update_talk.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: data,
  })

  const res = await req.json()

  if (res == 200) {
    location.reload()
  } else if (res == 500) {
    alert('Es ist ein Fehler aufgetreten')
  }
}

editBtn.forEach((btn) => {
  btn.addEventListener('click', function (e) {
    e.preventDefault()
  })

  const targetID = btn.dataset.target
  const datepicker = flatpickr(btn, {
    locale: 'de',
    onClose: function (selectedDate, dataStr, instance) {
      editTalk(targetID, dataStr)
    },
  })
})

// DELETE TALK
const deleteTalk = async (talk) => {
  const req = await fetch(`scripts/delete_talk.php?id=${talk}`, {
    method: 'DELETE',
  })

  const res = await req

  res.status === 200 ? location.reload() : alert('Da ist was schief gelaufen')
}

deleteBtn.forEach((btn) => {
  btn.addEventListener('click', function (e) {
    e.preventDefault()
    const talkID = btn.dataset.target

    if (window.confirm(`Soll Vortrag ${talkID} wirklich gelöscht werden?`)) {
      deleteTalk(talkID)
    }
  })
})

// PDF EXPORT
if (pdfBtn) {
  pdfBtn.addEventListener('click', function () {
    const doc = new jsPDF()

    const table = document.getElementById('table')
    const aTable = doc.autoTableHtmlToJson(table, true)

    let data = []

    const rows = aTable.rows
    rows.forEach((row) => {
      row.splice(4, 1)

      data = [...data, row.map((raw) => raw.content)]
    })

    doc.autoTable({
      theme: 'plain',
      head: [['Nr.', 'Thema', 'Themenbereich', 'Zul. gehalten']],
      body: data,
    })

    doc.save('vortragsliste.pdf')
  })
}
