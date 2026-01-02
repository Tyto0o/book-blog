document.getElementById('mainForm').addEventListener('submit', function (e) {
	e.preventDefault()
	let formData = new FormData(this)
	let name = document.getElementById('mainName').value
	let message = document.getElementById('mainMessage').value

	fetch('submit.php', { method: 'POST', body: formData, headers: {'X-Requested-With': 'XMLHttpRequest'} })
		.then(res => res.json())
		.then(data => {
			let now = new Date().toISOString().slice(0, 19).replace('T', ' ')
			let div = document.createElement('div')
			div.innerHTML =
				'<p><b>' +
				name +
				'</b> <small>(' +
				now +
				')</small><br>' +
				message +
				'</p><form class="replyForm" method="POST" action="submit.php" style="display:inline"><input type="hidden" name="parent_id" value="' + data.id + '"><input type="text" name="name" size="10" required><input type="text" name="message" size="30" required><button type="submit">Odpowiedz</button></form>'
			document.getElementById('comments').insertBefore(div, document.getElementById('comments').firstChild)
			this.reset()
		})
})

document.addEventListener('submit', function (e) {
	if (e.target.classList.contains('replyForm')) {
		e.preventDefault()
		fetch('submit.php', { method: 'POST', body: new FormData(e.target) }).then(() => location.reload())
	}
})
