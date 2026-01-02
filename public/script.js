// Dynamiczne dodawanie komentarzy i odpowiedzi bez przeładowania strony
document.getElementById('mainForm').addEventListener('submit', function (e) {
	e.preventDefault()
	let formData = new FormData(this)
	fetch('submit.php', { method: 'POST', body: formData }).then(() => location.reload())
})

document.addEventListener('submit', function (e) {
	if (e.target.classList.contains('replyForm')) {
		e.preventDefault()
		fetch('submit.php', { method: 'POST', body: new FormData(e.target) }).then(() => location.reload())
	}
})
