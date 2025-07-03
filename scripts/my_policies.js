document.addEventListener("DOMContentLoaded", function () {
  const tableBody = document.getElementById("policy-body");

  // Load initial data
  fetch("../api/api_my_policies.php")
    .then((res) => res.json())
    .then((data) => {
        console.log(data)
      if (data.success && Array.isArray(data.data)) {
        const rowsHtml = data.data.map((item) => `
          <tr>
            <td class="table-plus">${item.policy_name}</td>
         
            <td>${item.premium_amount}</td>
            <td>${item.coverage_amount}</td>
            <td>${item.age_limit}</td>
            <td>${item.req_date}</td>
            <td><span class="badge badge-pill badge-${item.status_id == 1 ? "info" : item.status_id == 2 ? "success" : "danger" }">${item.status_id == 1 ? "Pending" : item.status_id == 2 ? "Approve" : "Reject" }</span></td>
            <td>
              <button 
                data-id="${item.id}" 
                class="btn btn-primary btn-sm view-btn">
                Pay Now
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
    console.log(id)

    if (target.classList.contains("view-btn")) {
  fetch(`../api/api_my_policies.php?id=${id}`)
    .then((r) => r.json())
    .then((d) => {
      if (d.success && d.data) {
        const labels = {
          id: "Application ID",
          policy_name: "Policy Name",
          customer_name: "Customer Name",
          premium_amount: "Premium Amount",
          coverage_amount: "Coverage Amount",
          age_limit: "Age Limit",
          req_date: "Requested Date",
          status_id: "Status ID",
          first_name: "First Name",
          last_name: "Last Name",
          full_name: "Full Name",
          dob: "Date of Birth",
          age: "Age",
          full_name_nominee: "Nominee Full Name",
          age_nominee: "Nominee Age",
          is_accepted: "Is Accepted",
          relationship_id_nominee: "Relationship ID",
          user_life_policy_life_policy_id: "Policy ID",
          comment: "Comment"
        };

        let html = `<dl class="row">`;
        for (const [key, value] of Object.entries(d.data)) {
          const label = labels[key] || key.replace(/_/g, " ");
          html += `
            <dt class="col-sm-4 text-capitalize">${label}</dt>
            <dd class="col-sm-8">${value}</dd>
          `;
        }
        html += `</dl>`;
        document.getElementById("viewContent").innerHTML = html;
      } else {
        Swal.fire("Error", d.message || "Failed to fetch policy details.", "error");
      }
    })
    .catch(() => Swal.fire("Error", "Error loading policy details.", "error"));
}



  });

 
});
