document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("formRegister");
  const sections = form.querySelectorAll("section");
  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");
  const submitBtn = document.getElementById("submitBtn");
  const termsCheckbox = document.getElementById("customCheck1");
  let currentStep = 0;

  
  function populateOverview() {
  const email = form.querySelector('input[name="email"]').value;
  const password = form.querySelector('input[name="password"]').value;
  const fullName = form.querySelector('input[name="full_name"]').value;
  const city = form.querySelector('input[name="city"]').value;
  const state = form.querySelector('input[name="state"]').value;
  const gender = form.querySelector('input[name="gender"]:checked')?.nextElementSibling.textContent.trim() || "-";

  document.getElementById("overviewEmail").textContent = email;
  document.getElementById("overviewPassword").textContent = '*'.repeat(password.length);
  document.getElementById("overviewFullName").textContent = fullName;
  document.getElementById("overviewCity").textContent = city;
  document.getElementById("overviewState").textContent = state;
  document.getElementById("overviewGender").textContent = gender;
}

  function showStep(index) {
    sections.forEach((section, i) => {
      section.style.display = i === index ? "block" : "none";
    });

    prevBtn.style.display = index > 0 ? "inline-block" : "none";
    nextBtn.style.display = index < sections.length - 1 ? "inline-block" : "none";
    submitBtn.classList.toggle("d-none", index !== sections.length - 1);

      // Populate overview when on last step
  if (index === sections.length - 1) {
    populateOverview();
  }
  }



  function validateSection(index) {
    const inputs = sections[index].querySelectorAll("input");
    let password = "", confirmPassword = "";

    for (let input of inputs) {
      if (input.type === "radio") {
        const name = input.name;
        const radios = sections[index].querySelectorAll(`input[name="${name}"]`);
        const isChecked = Array.from(radios).some(r => r.checked);
        if (!isChecked) {
          Swal.fire({
            icon: "warning",
            title: "Required",
            text: `Please select a value for ${name}`
          });
          return false;
        }
      } else {
        if (!input.value.trim()) {
          Swal.fire({
            icon: "warning",
            title: "Missing Field",
            text: `Please fill out the ${input.name || input.id || "field"}`
          });
          return false;
        }

        if (input.name === "password") {
          password = input.value;
          if (password.length < 8) {
            Swal.fire({
              icon: "warning",
              title: "Weak Password",
              text: "Password must be at least 8 characters"
            });
            return false;
          }
        }

        if (input.name === "confirm_password") {
          confirmPassword = input.value;
        }
      }
    }

    if (password && confirmPassword && password !== confirmPassword) {
      Swal.fire({
        icon: "warning",
        title: "Password Mismatch",
        text: "Passwords do not match"
      });
      return false;
    }

    return true;
  }

  prevBtn.addEventListener("click", function () {
    if (currentStep > 0) {
      currentStep--;
      showStep(currentStep);
    }
  });

  nextBtn.addEventListener("click", function () {
    if (validateSection(currentStep)) {
      currentStep++;
      showStep(currentStep);
    }
  });

  submitBtn.addEventListener("click", function () {
    if (!validateSection(currentStep)) return;

    if (!termsCheckbox.checked) {
      Swal.fire({
        icon: "warning",
        title: "Terms Not Accepted",
        text: "You must agree to the terms and privacy policy before submitting."
      });
      return;
    }

    const formData = new FormData(form);

    fetch("../api/api_register.php", {
      method: "POST",
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          Swal.fire({
            icon: "success",
            title: "Registration Complete",
            text: "Redirecting to login...",
            confirmButtonText: "OK"
          }).then(() => {
            window.location.href = "../auth/login.php";
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: data.message || "Something went wrong"
          });
        }
      })
      .catch(err => {
        console.error("Error:", err);
        Swal.fire({
          icon: "error",
          title: "Request Failed",
          text: "Please try again later"
        });
      });
  });

  showStep(currentStep);
});
