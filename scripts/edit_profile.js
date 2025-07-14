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

    const fieldLabels = {
        full_name: "Full Name",
        email: "Email",
        dob: "Date of Birth",
        gender_id: "Gender",
        country_id: "Country",
        address: "Address",
        phone_number: "Phone Number",
        occupation: "Occupation",
        city: "City",
        state: "State",
        province: "Province",
        postal_code: "Postal Code",
        bank_account_no: "Bank Account Number",
        bank_name: "Bank Name",
        bank_branch_name: "Bank Branch Name",
        bank_account_holder_name: "Bank Account Holder Name"
    };

    const setTextSafe = (id, text) => {
        const el = document.getElementById(id);
        if (el) el.innerText = text;
    };

    const setImageSafe = (id, src) => {
        const el = document.getElementById(id);
        if (el) el.src = src;
    };

    const showWarning = (input, message = null) => {
        const label = fieldLabels[input.name || input.id] || input.name || input.id || "field";

        // Scroll to the invalid input
        input.scrollIntoView({ behavior: "smooth", block: "center" });
        input.focus();

        Swal.fire({
            icon: "warning",
            title: "Missing or Invalid Field",
            text: message || `Please fill out the ${label}`
        });
    };

    let cropper;
    const imageInput = document.getElementById("profile_image");
    const imagePreview = document.getElementById("image_preview");

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

    const cropBtn = document.getElementById("crop_and_upload");
    cropBtn?.addEventListener("click", function () {
        if (!cropper) {
            Swal.fire({ icon: "warning", title: "No Image", text: "Please select an image first." });
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
                    Swal.fire({ icon: "success", title: "Success", text: "Profile image updated successfully!" });
                    setImageSafe("profile-photo", result.image_url + "?t=" + new Date().getTime());
                    $('#modal').modal('hide');
                    // Redirect to edit profile page after successful upload
                    setTimeout(() => {
                    window.location.href = "http://localhost/safenest_life_system/edit-profile/";
                    }, 2000);
                } else {
                    Swal.fire({ icon: "error", title: "Failed", text: result.message });
                }
            } catch (error) {
                console.error("Profile image update error:", error);
                Swal.fire({ icon: "error", title: "Error", text: "Something went wrong while uploading image." });
            }
        }, "image/jpeg");
    });

    try {
        const response = await fetch("../api/api_profile.php");
        const result = await response.json();

        if (result.error) {
            alert(result.error);
            return;
        }

        const { user, bank } = result;

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

        const bankForm = document.getElementById("edit-bank-form");
        if (bankForm) {
            bankForm.bank_account_no.value = bank.bank_account_no || "";
            bankForm.bank_name.value = bank.bank_name || "";
            bankForm.bank_branch_name.value = bank.bank_branch_name || "";
            bankForm.bank_account_holder_name.value = bank.bank_account_holder_name || "";
        }

    } catch (error) {
        console.error("Failed to load profile:", error);
    }

    const validateProfileForm = (form) => {
        const onlyLetters = /^[A-Za-z\s]{5,}$/;
        const notOnlyNumbers = /^(?!^\d+$)^.+$/;
        const onlyNumbers = /^\d+$/;
        const phoneRegex = /^(\+?\d{10,15})$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        const requiredFields = ["full_name", "email", "dob", "gender_id", "country_id", "address", "phone_number"];

        for (const field of requiredFields) {
            const input = form[field];
            if (!input || !input.value.trim()) {
                showWarning(input);
                return false;
            }
        }

        if (!onlyLetters.test(form.full_name.value.trim())) return showWarning(form.full_name, "Full Name should be valid and only contain letters.");
        if (!emailRegex.test(form.email.value.trim())) return showWarning(form.email, "Please enter a valid email address.");
        if (!notOnlyNumbers.test(form.address.value.trim())) return showWarning(form.address, "Address cannot be only numbers.");
        if (form.city.value && !notOnlyNumbers.test(form.city.value.trim())) return showWarning(form.city, "City cannot be only numbers.");
        if (form.state.value && !notOnlyNumbers.test(form.state.value.trim())) return showWarning(form.state, "State cannot be only numbers.");
        if (form.province.value && !notOnlyNumbers.test(form.province.value.trim())) return showWarning(form.province, "Province cannot be only numbers.");
        if (form.postal_code.value && !onlyNumbers.test(form.postal_code.value.trim())) return showWarning(form.postal_code, "Postal Code must be only numbers.");
        if (!phoneRegex.test(form.phone_number.value.trim())) return showWarning(form.phone_number, "Phone Number must be 10–15 digits, with or without country code.");
        if (form.occupation.value && !onlyLetters.test(form.occupation.value.trim())) return showWarning(form.occupation, "Occupation should only contain letters.");

        return true;
    };

    const validateBankForm = (form) => {
        const onlyLetters = /^[A-Za-z\s]{3,}$/;
        const onlyNumbers = /^\d+$/;

        const requiredFields = ["bank_account_no", "bank_name", "bank_branch_name", "bank_account_holder_name"];

        for (const field of requiredFields) {
            const input = form[field];
            if (!input || !input.value.trim()) {
                showWarning(input);
                return false;
            }
        }

        if (!onlyNumbers.test(form.bank_account_no.value.trim())) return showWarning(form.bank_account_no, "Bank Account Number must be only numbers.");
        if (!onlyLetters.test(form.bank_name.value.trim())) return showWarning(form.bank_name, "Bank Name must be valid and only contain letters.");
        if (!onlyLetters.test(form.bank_branch_name.value.trim())) return showWarning(form.bank_branch_name, "Branch Name must be valid and only contain letters.");
        if (!onlyLetters.test(form.bank_account_holder_name.value.trim())) return showWarning(form.bank_account_holder_name, "Account Holder Name must be valid and only contain letters.");

        return true;
    };

    const profileForm = document.getElementById("edit-profile-form");
    profileForm?.addEventListener("submit", async function (e) {
        e.preventDefault();
        if (!validateProfileForm(this)) return;

        const formData = new FormData(this);
        try {
            const response = await fetch("../api/api_edit_profile.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                Swal.fire({ icon: "success", title: "Success", text: "Profile updated successfully!" });
                setTimeout(() => {
                location.reload();
                }, 5000);
            } else {
                Swal.fire({ icon: "error", title: "Failed", text: result.message });
            }
        } catch (error) {
            console.error("Profile update error:", error);
            Swal.fire({ icon: "error", title: "Error", text: "Something went wrong while updating your profile." });
        }
    });

    const bankForm = document.getElementById("edit-bank-form");
    bankForm?.addEventListener("submit", async function (e) {
        e.preventDefault();
        if (!validateBankForm(this)) return;

        const formData = new FormData(this);
        try {
            const response = await fetch("../api/api_edit_profile.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                Swal.fire({ icon: "success", title: "Success", text: "Bank info updated successfully!" });
            } else {
                Swal.fire({ icon: "error", title: "Failed", text: result.message });
            }
        } catch (error) {
            console.error("Bank info update error:", error);
            Swal.fire({ icon: "error", title: "Error", text: "Something went wrong while updating bank information." });
        }
    });
});
