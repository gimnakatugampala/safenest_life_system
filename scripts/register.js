document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("formRegister");
  const sections = form.querySelectorAll("section");
  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");
  const submitBtn = document.getElementById("submitBtn");
  let currentStep = 0;

  function showStep(index) {
    sections.forEach((section, i) => {
      section.style.display = i === index ? "block" : "none";
    });

    prevBtn.style.display = index > 0 ? "inline-block" : "none";
    nextBtn.style.display = index < sections.length - 1 ? "inline-block" : "none";
    submitBtn.classList.toggle("d-none", index !== sections.length - 1);
  }

  prevBtn.addEventListener("click", function () {
    if (currentStep > 0) {
      currentStep--;
      showStep(currentStep);
    }
  });

  nextBtn.addEventListener("click", function () {
    if (currentStep < sections.length - 1) {
      currentStep++;
      showStep(currentStep);
    }
  });

  submitBtn.addEventListener("click", function () {
    const formData = new FormData(form);

    fetch("../api/api_register.php", {
      method: "POST",
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert("Registration successful!");
          window.location.href = "../auth/login.php";
        } else {
          alert("Error: " + data.message);
        }
      })
      .catch(err => {
        console.error("Error:", err);
        alert("Something went wrong.");
      });
  });

  showStep(currentStep);
});