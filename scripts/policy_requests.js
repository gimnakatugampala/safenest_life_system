document.addEventListener("DOMContentLoaded", function () {
  const tableBody = document.getElementById("pending-policy-body");

  // Load initial data
  fetch("../api/api_get_policy_application.php")
    .then((res) => res.json())
    .then((data) => {
      if (data.success && Array.isArray(data.data)) {
        const rowsHtml = data.data.map((item) => `
          <tr>
            <td class="table-plus">${item.policy_name}</td>
            <td>${item.customer_name}</td>
            <td>${item.premium_amount}</td>
            <td>${item.coverage_amount}</td>
            <td>${item.age_limit}</td>
            <td>${item.req_date}</td>
            <td><span class="badge badge-pill badge-info">Pending</span></td>
            <td>
              <button 
                data-id="${item.id}" 
                data-toggle="modal" 
                data-target="#bd-example-modal-lg" 
                class="btn btn-primary btn-sm view-btn">
                <span class="icon-copy ti-eye"></span>
              </button>
              <button 
                data-id="${item.id}" 
                class="btn btn-success btn-sm approve-btn">
                <span class="icon-copy ti-check"></span>
              </button>
              <button 
                data-id="${item.id}" 
                class="btn btn-danger btn-sm reject-btn">
                <span class="icon-copy ti-close"></span>
              </button>
            </td>
          </tr>
        `).join("");
        tableBody.innerHTML = rowsHtml;
      } else {
        tableBody.innerHTML = `<tr><td>No pending policies found.</td></tr>`;
      }
    })
    .catch(() => {
      tableBody.innerHTML = `<tr><td>Error loading data.</td></tr>`;
    });

  // Handle button actions
  // Handle button actions
  tableBody.addEventListener("click", function (e) {
    const target = e.target.closest("button");
    if (!target) return;
    const id = target.dataset.id;

    if (target.classList.contains("view-btn")) {
      fetch(`../api/api_get_policy_application.php?id=${id}`)
        .then((r) => r.json())
        .then((d) => {
          if (d.success && d.data) {
            let html = `<dl class="row">`;
            for (const [k, v] of Object.entries(d.data)) {
              html += `<dt class="col-sm-4 text-capitalize">${k.replace(/_/g, " ")}</dt>
                       <dd class="col-sm-8">${v}</dd>`;
            }
            html += `</dl>`;
            document.getElementById("viewContent").innerHTML = html;
          } else {
            Swal.fire("Error", d.message || "Failed to fetch policy details.", "error");
          }
        })
        .catch(() => Swal.fire("Error", "Error loading policy details.", "error"));
    }

    if (target.classList.contains("approve-btn")) {
      Swal.fire({
        title: "Are you sure?",
        text: "You are about to approve this application.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Yes, approve it",
        cancelButtonText: "Cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          updateStatus(id, 2, target.closest("tr"));
        }
      });
    }

    if (target.classList.contains("reject-btn")) {
      Swal.fire({
        title: "Are you sure?",
        text: "You are about to reject this application.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, reject it",
        cancelButtonText: "Cancel"
      }).then((result) => {
        if (result.isConfirmed) {
          updateStatus(id, 3, target.closest("tr"));
        }
      });
    }
  });

    function updateStatus(id, status, rowElement) {
    fetch(`../api/api_update_application.php`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id, status })
    })
      .then((r) => r.json())
      .then((d) => {
        if (d.success) {
          Swal.fire("Success", d.message || "Updated successfully.", "success");
          if (rowElement) rowElement.remove();
        } else {
          Swal.fire("Error", d.message || "Update failed.", "error");
        }
      })
      .catch(() => Swal.fire("Error", "Failed to update application status.", "error"));
  }
});
