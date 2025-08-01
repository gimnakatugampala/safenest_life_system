document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("formPolicyApp");
  const sections = form.querySelectorAll("section");
  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");
  const submitBtn = document.getElementById("submitBtn");
  const termsCheckbox = document.getElementById("customCheck1");
  const relationSelect = document.getElementById("relationSelect");

  let currentStep = 0;

  function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
  }

  function showStep(index) {
    sections.forEach((section, i) => {
      section.style.display = i === index ? "block" : "none";
    });
    prevBtn.style.display = index > 0 ? "inline-block" : "none";
    nextBtn.style.display = index < sections.length - 1 ? "inline-block" : "none";
    submitBtn.classList.toggle("d-none", index !== sections.length - 1);
  }

  function validateSection(index) {
    const inputs = sections[index].querySelectorAll("input, select, textarea");
    for (const input of inputs) {
      if (input.disabled || input.type === "checkbox") continue;

      if (input.type === "radio") {
        const radios = sections[index].querySelectorAll(`input[name="${input.name}"]`);
        const checked = Array.from(radios).some(r => r.checked);
        if (!checked) {
          Swal.fire("Missing Input", `Please select an option for ${input.name}`, "warning");
          return false;
        }
      } else if (!input.value.trim()) {
        Swal.fire("Missing Input", `Please fill out the ${input.name || input.id || "field"}`, "warning");
        return false;
      }
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
      Swal.fire("Terms Required", "Please accept the terms and conditions to proceed", "warning");
      return;
    }

    const formData = new FormData(form);
    const policyId = getQueryParam("policy_id");
    if (policyId) {
      formData.append("policy_id", policyId);
    }

    fetch("../api/api_policy_application_form.php", {
      method: "POST",
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          $("#success-modal").modal("show");
          form.reset();
          currentStep = 0;
          showStep(currentStep);
        } else {
          Swal.fire("Error", data.message || "Something went wrong", "error");
        }
      })
      .catch(err => {
        console.error("Error:", err);
        Swal.fire("Error", "Failed to submit the form", "error");
      });
  });

  // Load Relationship Options for Nominee
  fetch("../api/api_get_relationships.php")
    .then(response => response.json())
    .then(data => {
      if (data.success && Array.isArray(data.data)) {
        data.data.forEach(rel => {
          const option = document.createElement("option");
          option.value = rel.id;
          option.textContent = rel.relation;
          relationSelect.appendChild(option);
        });
      } else {
        console.warn("Failed to load relationship list");
      }
    })
    .catch(error => {
      console.error("Error fetching relationships:", error);
    });

  // Load Policy Details from query string
  function loadPolicyDetails() {
    const policyId = getQueryParam("policy_id");
    console.log(policyId)
    if (!policyId) return;

    fetch(`../api/api_get_policy.php?policy_id=${policyId}`)
      .then(res => res.json())
      .then(data => {
        if (data.success && data.policy) {
          const selects = sections[1].querySelectorAll("select");
          if (selects.length >= 4) {
            selects[0].innerHTML = `<option selected>${data.policy.plan}</option>`;
            selects[1].innerHTML = `<option selected>${data.policy.term}</option>`;
            selects[2].innerHTML = `<option selected>${data.policy.premium}</option>`;
            selects[3].innerHTML = `<option selected>${data.policy.eligibility}</option>`;
          }
        } else {
          console.warn("Failed to load policy details:", data.message);
        }
      })
      .catch(err => {
        console.error("Error fetching policy details:", err);
      });
  }

  loadPolicyDetails();
  showStep(currentStep);
});
