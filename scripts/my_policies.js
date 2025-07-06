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
  const policyId = target.dataset.id;
  window.location.href = `../public/checkout.html?policy_id=${policyId}`;
}




  });

 
});
