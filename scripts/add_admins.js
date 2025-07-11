document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("adminForm");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    // Collect form fields
    const firstName = form.querySelector('input[name="first_name"]').value.trim();
    const lastName = form.querySelector('input[name="last_name"]').value.trim();
    const email = form.querySelector('input[name="email"]').value.trim();
    const password = form.querySelector('input[name="password"]').value;
    const confirmPassword = form.querySelector('input[name="confirm_password"]').value;

    // Basic validation
    if (!firstName || !lastName || !email || !password || !confirmPassword) {
      Swal.fire({
        icon: "warning",
        title: "Missing Fields",
        text: "Please fill all required fields.",
      });
      return;
    }

    // Password strength check
    if (password.length < 8) {
      Swal.fire({
        icon: "warning",
        title: "Weak Password",
        text: "Password must be at least 8 characters long.",
      });
      return;
    }

    // Password match check
    if (password !== confirmPassword) {
      Swal.fire({
        icon: "error",
        title: "Password Mismatch",
        text: "Password and Confirm Password do not match.",
      });
      return;
    }

    // Prepare data to send
    const formData = new FormData();
    formData.append("first_name", firstName);
    formData.append("last_name", lastName);
    formData.append("email", email);
    formData.append("password", password);

    // Send via AJAX to api_add_admins.php
    fetch("../api/api_add_admins.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          Swal.fire({
            icon: "success",
            title: "Admin Added",
            text: "The new admin was successfully created.",
          }).then(() => {
            form.reset();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: data.message || "Something went wrong.",
          });
        }
      })
      .catch((err) => {
        console.error("Error:", err);
        Swal.fire({
          icon: "error",
          title: "Request Failed",
          text: "Please try again later.",
        });
      });
  });
});
