document.addEventListener('DOMContentLoaded', () => {
	const form = document.getElementById('loginForm');
	const msgBox = document.getElementById('loginMsg');

	if (!form || !msgBox) return;

	form.addEventListener('submit', async (e) => {
		e.preventDefault();

		const formData = new FormData(form);

		msgBox.textContent = 'Logging in...';
		msgBox.className = '';
		msgBox.classList.add('text-primary');

		try {
			const response = await fetch('../api/api_login.php', {
				method: 'POST',
				body: formData
			});

			const rawText = await response.text(); // get full response body
			console.log('Raw response from server:', rawText);

			let result;
			try {
				result = JSON.parse(rawText);
			} catch (jsonErr) {
				msgBox.className = '';
				msgBox.classList.add('text-danger');
				msgBox.textContent = 'Server error: response not valid JSON.';
				console.error('Failed to parse JSON:', jsonErr);
				return;
			}

			msgBox.className = ''; // reset styles

			if (result.success) {
				msgBox.classList.add('text-success');
				msgBox.textContent = 'Login successful! Redirecting...';
				setTimeout(() => window.location.href = '../dashboard', 1500);
			} else {
				msgBox.classList.add('text-danger');
				msgBox.textContent = result.message || 'Login failed. Please try again.';
			}
		} catch (err) {
			console.error('Login request failed:', err);
			msgBox.className = '';
			msgBox.classList.add('text-danger');
			msgBox.textContent = 'An error occurred. Please try again.';
		}
	});
});
