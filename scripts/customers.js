document.addEventListener("DOMContentLoaded", function () {
  fetch('../api/api_get_all_customers.php')
    .then(response => response.json())
    .then(result => {
      if (result.status === 'success') {
        const customers = result.data;
        const tableBody = document.getElementById("customerTableBody");
        tableBody.innerHTML = "";

        customers.forEach(customer => {
          const row = `
            <tr>
              <td>${customer.customer_name}</td>
              <td>${customer.dob}</td>
              <td>${customer.nominee}</td>
              <td>${customer.policy_name}</td>
              <td>${customer.contact_number}</td>
              <td>${customer.email}</td>
            </tr>`;
          tableBody.innerHTML += row;
        });
      } else {
        console.error('Failed to load customers:', result.message);
      }
    })
    .catch(error => {
      console.error('Error loading customer data:', error);
    });
});
