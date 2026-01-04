// Dynamiczne dodawanie komentarzy i odpowiedzi bez przeładowania strony
document.getElementById('mainForm')?.addEventListener('submit', function (e) {
	e.preventDefault()
	let formData = new FormData(this)
	fetch('/submit.php', { method: 'POST', body: formData, headers: {'X-Requested-With': 'XMLHttpRequest'} })
		.then(res => res.json())
		.then(data => {
			const commentsDiv = document.getElementById('comments')
			const noComments = commentsDiv.querySelector('.no-comments')
			if (noComments) noComments.remove()
			
			const newComment = document.createElement('div')
			newComment.className = 'comment'
			newComment.innerHTML = `
				<div class="comment-header">
					<strong>${data.name}</strong>
					<small class="time-ago" data-time="${data.created_at}"></small>
				</div>
				<p>${data.message.replace(/\n/g, '<br>')}</p>
				<div class="comment-actions">
					<button class="btn-link btn-reply" onclick="toggleReplyForm(this)">Odpowiedz</button>
				</div>
				<form class="replyForm" style="display:none" method="POST" action="/submit.php">
					<input type="hidden" name="parent_id" value="${data.id}">
					<input type="hidden" name="book_id" value="${formData.get('book_id')}">
					<input type="text" name="message" placeholder="Odpowiedz..." required>
					<button type="submit" class="btn btn-small">Wyślij</button>
				</form>
				<div class="replies" style="display:none"></div>
			`
			
			commentsDiv.insertBefore(newComment, commentsDiv.firstChild)
			this.reset()
			updateTimeAgo()
		})
})

document.addEventListener('submit', function (e) {
	if (e.target.classList.contains('replyForm')) {
		e.preventDefault()
		const form = e.target
		fetch('/submit.php', { method: 'POST', body: new FormData(form), headers: {'X-Requested-With': 'XMLHttpRequest'} })
			.then(res => res.json())
			.then(data => {
				// Dodaj nowy komentarz do DOM
				const parentComment = form.closest('.comment')
				const repliesDiv = parentComment.querySelector(':scope > .replies')
				
				const newComment = document.createElement('div')
				newComment.className = 'comment'
				newComment.style.marginLeft = '30px'
				newComment.innerHTML = `
					<div class="comment-header">
						<strong>${data.name}</strong>
						<small class="time-ago" data-time="${data.created_at}"></small>
					</div>
					<p>${data.message.replace(/\n/g, '<br>')}</p>
					<div class="comment-actions">
						<button class="btn-link btn-reply" onclick="toggleReplyForm(this)">Odpowiedz</button>
					</div>
					<form class="replyForm" style="display:none" method="POST" action="/submit.php">
						<input type="hidden" name="parent_id" value="${data.id}">
						<input type="hidden" name="book_id" value="${form.querySelector('[name="book_id"]').value}">
						<input type="text" name="message" placeholder="Odpowiedz..." required>
						<button type="submit" class="btn btn-small">Wyślij</button>
					</form>
					<div class="replies" style="display:none"></div>
				`
				
				if (repliesDiv) {
					repliesDiv.insertBefore(newComment, repliesDiv.firstChild)
					// Pokaż odpowiedzi jeśli były ukryte
					if (repliesDiv.style.display === 'none') {
						repliesDiv.style.display = 'block'
					}
					// Aktualizuj licznik odpowiedzi
					const showRepliesBtn = parentComment.querySelector(':scope > .comment-actions > .btn-show-replies')
					if (showRepliesBtn) {
						const count = parseInt(showRepliesBtn.textContent.match(/\d+/)[0]) + 1
						showRepliesBtn.textContent = `Ukryj odpowiedzi (${count})`
					} else {
						// Dodaj przycisk jeśli nie istniał
						const actionsDiv = parentComment.querySelector(':scope > .comment-actions')
						const btn = document.createElement('button')
						btn.className = 'btn-link btn-show-replies'
						btn.onclick = function() { toggleReplies(this) }
						btn.textContent = 'Ukryj odpowiedzi (1)'
						actionsDiv.appendChild(btn)
					}
				}
				
				form.reset()
				updateTimeAgo()
			})
	}
})

function toggleReplyForm(btn) {
	const comment = btn.closest('.comment')
	const form = comment.querySelector(':scope > .replyForm')
	const replies = comment.querySelector(':scope > .replies')
	const showRepliesBtn = comment.querySelector(':scope > .comment-actions > .btn-show-replies')
	
	if (form.style.display === 'none') {
		form.style.display = 'flex'
		btn.textContent = 'Ukryj'
		if (replies && replies.style.display === 'none') {
			replies.style.display = 'block'
			if (showRepliesBtn) {
				const count = showRepliesBtn.textContent.match(/\d+/)[0]
				showRepliesBtn.textContent = `Ukryj odpowiedzi (${count})`
			}
		}
	} else {
		form.style.display = 'none'
		btn.textContent = 'Odpowiedz'
	}
}

function toggleReplies(btn) {
	const comment = btn.closest('.comment')
	const replies = comment.querySelector(':scope > .replies')
	if (replies.style.display === 'none') {
		replies.style.display = 'block'
		const count = btn.textContent.match(/\d+/)[0]
		btn.textContent = `Ukryj odpowiedzi (${count})`
	} else {
		replies.style.display = 'none'
		const count = btn.textContent.match(/\d+/)[0]
		btn.textContent = `Pokaż odpowiedzi (${count})`
	}
}

function timeAgo(timestamp) {
	const now = Math.floor(Date.now() / 1000)
	const diff = now - timestamp
	
	if (diff < 60) return `${diff} sekund temu`
	if (diff < 3600) {
		const mins = Math.floor(diff / 60)
		return `${mins} ${mins === 1 ? 'minutę' : mins < 5 ? 'minuty' : 'minut'} temu`
	}
	if (diff < 86400) {
		const hours = Math.floor(diff / 3600)
		return `${hours} ${hours === 1 ? 'godzinę' : hours < 5 ? 'godziny' : 'godzin'} temu`
	}
	if (diff < 2592000) {
		const days = Math.floor(diff / 86400)
		return `${days} ${days === 1 ? 'dzień' : 'dni'} temu`
	}
	if (diff < 31536000) {
		const months = Math.floor(diff / 2592000)
		return `${months} ${months === 1 ? 'miesiąc' : months < 5 ? 'miesiące' : 'miesięcy'} temu`
	}
	const years = Math.floor(diff / 31536000)
	return `${years} ${years === 1 ? 'rok' : years < 5 ? 'lata' : 'lat'} temu`
}

function updateTimeAgo() {
	document.querySelectorAll('.time-ago').forEach(el => {
		const timestamp = parseInt(el.dataset.time)
		el.textContent = timeAgo(timestamp)
	})
}

updateTimeAgo()
setInterval(updateTimeAgo, 60000)
