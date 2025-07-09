document.addEventListener("DOMContentLoaded", async () => {
    const genderMap = {
        "Male": "1",
        "Female": "2"
    };

    const countryMap = {
        "Sri Lanka": "1",
        "India": "2",
        "United Kingdom": "3",
        "United States": "4"
    };

    // Helper: Set text safely
    const setTextSafe = (id, text) => {
        const el = document.getElementById(id);
        if (el) el.innerText = text;
    };

    // Helper: Set image safely
    const setImageSafe = (id, src) => {
        const el = document.getElementById(id);
        if (el) el.src = src;
    };

    let cropper;
    const imageInput = document.getElementById("profile_image");
    const imagePreview = document.getElementById("image_preview");

    // Load and initialize CropperJS
    imageInput?.addEventListener("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                imagePreview.src = event.target.result;

                if (cropper) cropper.destroy();
                cropper = new Cropper(imagePreview, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1
                });
            };
            reader.readAsDataURL(file);
        }
    });

    // Crop & Upload image
    const cropBtn = document.getElementById("crop_and_upload");
    cropBtn?.addEventListener("click", function () {
        if (!cropper) {
            alert("Please select an image first.");
            return;
        }

        cropper.getCroppedCanvas({ width: 300, height: 300 }).toBlob(async function (blob) {
            const formData = new FormData();
            formData.append("cropped_image", blob, "profile.jpg");

            try {
                const response = await fetch("../api/api_edit_profile.php", {
                    method: "POST",
                    body: formData
                });

                const result = await response.json();
                if (result.success) {
                    alert("Profile image updated successfully!");
                    setImageSafe("profile-photo", result.image_url + "?t=" + new Date().getTime());
                    $('#modal').modal('hide');
                } else {
                    alert("Failed to update profile image: " + result.message);
                }
            } catch (error) {
                console.error("Profile image update error:", error);
                alert("Something went wrong while uploading image.");
            }
        }, "image/jpeg");
    });

    // Load Profile & Bank Data
    try {
        const response = await fetch("../api/api_profile.php");
        const result = await response.json();

        if (result.error) {
            alert(result.error);
            return;
        }

        const { user, bank } = result;

        // Set profile card
        setTextSafe("profile-name", user.full_name || "-");
        setTextSafe("profile-email", user.email || "-");
        setTextSafe("profile-dob", user.dob || "-");
        setTextSafe("profile-phone", user.phone_number || "-");
        setTextSafe("profile-country", user.country || "-");
        setTextSafe("profile-occupation", user.occupation || "-");
        setTextSafe("profile-address", user.address || "-");

        if (user.profile_img) {
            setImageSafe("profile-photo", "../" + user.profile_img + "?t=" + new Date().getTime());
        }

        // Populate Profile Form
        const profileForm = document.getElementById("edit-profile-form");
        if (profileForm) {
            profileForm.full_name.value = user.full_name || "";
            profileForm.email.value = user.email || "";
            profileForm.dob.value = user.dob || "";
            profileForm.phone_number.value = user.phone_number || "";
            profileForm.occupation.value = user.occupation || "";
            profileForm.address.value = user.address || "";
            profileForm.city.value = user.city || "";
            profileForm.state.value = user.state || "";
            profileForm.province.value = user.province || "";
            profileForm.postal_code.value = user.postal_code || "";
            profileForm.gender_id.value = genderMap[user.gender] || "";
            profileForm.country_id.value = countryMap[user.country] || "";
        }

        // Populate Bank Form
        const bankForm = document.getElementById("edit-bank-form");
        if (bankForm) {
            bankForm.bank_account_no.value = bank.bank_account_no || "";
            bankForm.bank_name.value = bank.bank_name || "";
            bankForm.bank_branch_name.value = bank.bank_branch_name || "";
            bankForm.bank_account_holder_name.value = bank.bank_account_holder_name || "";
        }

    } catch (error) {
        console.error("Failed to load profile:", error);
        alert("Failed to load profile data.");
    }

    // Handle Profile Form Submission
    const profileForm = document.getElementById("edit-profile-form");
    profileForm?.addEventListener("submit", async function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        try {
            const response = await fetch("../api/api_edit_profile.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                alert("Profile updated successfully!");
                location.reload();
            } else {
                alert("Failed to update profile: " + result.message);
            }
        } catch (error) {
            console.error("Profile update error:", error);
            alert("Something went wrong while updating your profile.");
        }
    });

    // Handle Bank Form Submission
    const bankForm = document.getElementById("edit-bank-form");
    bankForm?.addEventListener("submit", async function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        try {
            const response = await fetch("../api/api_edit_profile.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                alert("Bank info updated successfully!");
                location.reload();
            } else {
                alert("Failed to update bank info: " + result.message);
            }
        } catch (error) {
            console.error("Bank info update error:", error);
            alert("Something went wrong while updating bank information.");
        }
    });
});
