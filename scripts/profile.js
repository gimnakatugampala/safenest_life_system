document.addEventListener('DOMContentLoaded', function () {
    fetch('../api/api_profile.php')
        .then(response => {
            if (!response.ok) {
                console.error('Server returned:', response.status);
                return response.text().then(text => {
                    throw new Error(`Server Error ${response.status}: ${text}`);
                });
            }
            return response.json();
        })
        .then(data => {
            const user = data.user;
            const bank = data.bank;

            // === Update profile image ===
            const profilePhoto = document.getElementById('profile-photo');
            if (user.profile_img && user.profile_img.trim() !== '') {
                // Prepend the app base path to the profile_img path
                profilePhoto.src = '/safenest_life_system/' + user.profile_img + '?t=' + new Date().getTime(); // cache buster
            } else {
                profilePhoto.src = '../vendors/images/photo1.jpg'; // fallback image
            }

            // === Update profile left panel ===
            document.querySelector('.h5.mb-0').textContent = user.full_name || '-';
            document.querySelector('.text-muted.font-14').textContent = user.occupation || '-';

            const contactList = document.querySelector('#profile-contact-info');
            contactList.innerHTML = `
                <li><span>Email Address:</span> ${user.email || '-'}</li>
                <li><span>Phone Number:</span> ${user.phone_number || '-'}</li>
                <li><span>Country:</span> ${user.country || '-'}</li>
                <li><span>Address:</span> ${user.address || '-'}</li>
            `;

            // === Timeline Info ===
            const timelineFields = {
                'Full Name': user.full_name,
                'Occupation': user.occupation,
                'Email': user.email,
                'Date of birth': user.dob ? user.dob.split(' ')[0] : '',
                'Gender': user.gender,
                'Country': user.country,
                'State/Province/Region': user.province,
                'Postal Code': user.postal_code,
                'Phone Number': user.phone_number,
                'Address': user.address
            };

            const timelineContainer = document.querySelector('#user-info-placeholder');
            timelineContainer.innerHTML = '';
            for (const [label, value] of Object.entries(timelineFields)) {
                timelineContainer.innerHTML += `
                    <div class="form-group">
                        <label><b>${label}</b></label>
                        <p class="m-0 p-0">${value || '-'}</p>
                    </div>
                `;
            }

            // === Bank Info ===
            const bankFields = {
                'Bank Account No': bank.bank_account_no,
                'Bank Name': bank.bank_name,
                'Bank Branch Name': bank.bank_branch_name,
                'Account Holder Name': bank.bank_account_holder_name
            };

            const bankContainer = document.querySelector('#bank-info-placeholder');
            bankContainer.innerHTML = '';
            for (const [label, value] of Object.entries(bankFields)) {
                bankContainer.innerHTML += `
                    <div class="form-group">
                        <label><b>${label}</b></label>
                        <p class="m-0 p-0">${value || '-'}</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading profile:', error);
        });
});
