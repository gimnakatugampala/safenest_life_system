function logoutUser() {
  fetch('../api/api_logout.php')
    .then(res => res.json())
    .then(data => {
      if (data.status === 'success') {
        window.location.href = '../auth/login.php'; // or adjust this path if needed
      }
    })
    .catch(error => {
      console.error('Logout failed:', error);
    });
}
