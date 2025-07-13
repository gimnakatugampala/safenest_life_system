document.addEventListener("DOMContentLoaded", function () {
  fetch('../api/api_get_admins.php')
    .then(response => response.json())
    .then(result => {
      if (result.status === 'success') {
        const admins = result.data;
        const tableBody = document.querySelector("tbody");
        tableBody.innerHTML = ""; // Clear any dummy rows

        admins.forEach(admin => {
          
          let statusBadge = "";
          if (admin.user_status_id == 1) {
            statusBadge = `<span class="badge badge-pill badge-success">Active</span>`;
          } else if (admin.user_status_id == 2) {
            statusBadge = `<span class="badge badge-pill badge-danger">Inactive</span>`;
          } else {
            statusBadge = `<span class="badge badge-pill badge-secondary">Unknown</span>`;
          }
          const row = `
            <tr>
              <td class="table-plus">${admin.first_name} ${admin.last_name}</td>
              <td>${statusBadge}</td>
              <td>${admin.email}</td>
              <td>
                <button class="btn btn-success btn-sm activate-btn" data-id="${admin.id}" ${admin.user_status_id == 1 ? 'disabled' : ''}>
                  <span class="icon-copy ti-check"></span>
                </button>
                <button class="btn btn-danger btn-sm deactivate-btn" data-id="${admin.id}" ${admin.user_status_id == 2 ? 'disabled' : ''}>
                  <span class="icon-copy ti-close"></span>
                </button>
              </td>
            </tr>
          `;
          tableBody.innerHTML += row;
        });
         attachStatusButtonListeners(); 
      } else {
        console.error('Error loading admins:', result.message);
      }
    })
    .catch(error => {
      console.error('Fetch error:', error);
    });
});

function attachStatusButtonListeners() {
  const activateButtons = document.querySelectorAll('.activate-btn');
  const deactivateButtons = document.querySelectorAll('.deactivate-btn');

  activateButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-id');
      updateAdminStatus(id, 1);
    });
  });

  deactivateButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-id');
      updateAdminStatus(id, 2);
    });
  });
}

function updateAdminStatus(id, status) {
  fetch('../api/api_update_admin_status.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ id: id, user_status_id: status })
  })
    .then(response => response.json())
    .then(res => {
      if (res.success) {
        Swal.fire('Success', res.message, 'success').then(() => {
          location.reload();
        });
      } else {
        Swal.fire('Error', res.message || 'Update failed', 'error');
      }
    })
    .catch(error => {
      Swal.fire('Error', 'Request failed', 'error');
      console.error('Update error:', error);
    });
}
