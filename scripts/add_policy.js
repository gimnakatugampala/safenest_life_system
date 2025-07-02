/*  policy_add.js
 *  Requires:
 *    – jQuery
 *    – Dropzone.js  (three instances with class .policy-dropzone)
 *    – SweetAlert2 for nicer alerts
 */
$(function () {
  // ─────────────────────────────────────────
  //  ADD / REMOVE BENEFITS DYNAMICALLY
  // ─────────────────────────────────────────
  window.addBenefit = function () {
    $("#benefits-list").append(`
      <li class="d-flex mb-2">
        <input type="text" name="benefits[]" class="form-control me-2"
               placeholder="Enter a benefit">
        <button type="button" class="btn btn-danger btn-sm"
                onclick="removeBenefit(this)">
          <i class="icon-copy ion-close"></i>
        </button>
      </li>`);
  };

  window.removeBenefit = function (btn) {
    $(btn).closest("li").remove();
  };

  // ─────────────────────────────────────────
  //  SIMPLE VALIDATION
  // ─────────────────────────────────────────
  function validateForm() {
    const requiredSelectors = [
      "input[name='policy_name']",
      "input[name='term_years']",
      "input[name='premium_amount']",
      "input[name='coverage_amount']",
      "input[name='min_age']",
      "input[name='max_age']",
      "textarea[name='description']"
    ];

    for (const sel of requiredSelectors) {
      if (!$(sel).val().trim()) {
        Swal.fire("Missing field", "Please fill all required fields", "warning");
        return false;
      }
    }

    // Require at least one image
    if ($("input[type='file'][name='images[]']")[0].files.length === 0) {
      Swal.fire("No Image", "Please select at least one image", "warning");
      return false;
    }

    return true;
  }

  // ─────────────────────────────────────────
  //  SUBMIT BUTTON HANDLER
  // ─────────────────────────────────────────
  $("#addPolicyBtn").on("click", function () {
    if (!validateForm()) return;

    const form   = $("#formPolicy")[0];
    const fd     = new FormData(form); // includes file inputs automatically

    $.ajax({
      url: "../api/api_add_policy.php",
      type: "POST",
      data: fd,
      processData: false,
      contentType: false,
      success: function (res) {
        if (res.success) {
          Swal.fire("Added!", "Policy saved successfully.", "success")
            .then(() => window.location.reload());
        } else {
          Swal.fire("Error", res.message || "Server error.", "error");
        }
      },
      error: function (xhr) {
        Swal.fire("Error", xhr.responseText || "Server error.", "error");
      }
    });
  });
});
