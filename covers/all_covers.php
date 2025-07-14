<?php include_once '../includes/header.php'; ?>

<body>
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo"><img src="../vendors/images/deskapp-logo.svg" alt=""></div>
            <div class='loader-progress' id="progress_div">
                <div class='bar' id='bar1'></div>
            </div>
            <div class='percent' id='percent1'>0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>

    <?php include_once '../includes/sub_header.php'; ?>
    <?php include_once '../includes/sidebar.php'; ?>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4>All Covers</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Covers</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Covers</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Export Datatable start -->
                <div class="card-box mb-30 p-4">
                    <div class="pb-20">
                        <div class="table-responsive">
                            <table class="table hover multiple-select-row data-table-export nowrap">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">Cover Code</th>
                                        <th>Cover Name</th>
                                        <th>Description</th>
                                        <th>Premium Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="covers-body">
                                    <!-- Data will load here dynamically -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Export Datatable End -->
                </div>
                <div class="footer-wrap pd-20 mb-20 card-box"></div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const tbody = document.getElementById("covers-body");

                function loadCovers() {
                    fetch("../ajax/get_covers.php")
                        .then(response => {
                            if (!response.ok) throw new Error("Network error");
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                tbody.innerHTML = "";
                                data.data.forEach(cover => {
                                    const tr = document.createElement("tr");
                                    tr.innerHTML = `
                                    <td class="table-plus">${escapeHtml(cover.cover_code)}</td>
                                    <td>${escapeHtml(cover.cover_name)}</td>
                                    <td>${escapeHtml(cover.description)}</td>
                                    <td>${escapeHtml(cover.premium_amount)}</td>
                                    <td>
                                        <a href="edit_cover.php?id=${encodeURIComponent(cover.id)}" class="btn btn-sm btn-primary">Edit</a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteCover(${encodeURIComponent(cover.id)})">Delete</button>
                                    </td>
                                `;
                                    tbody.appendChild(tr);
                                });
                            } else {
                                tbody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Failed to load covers</td></tr>';
                            }
                        })
                        .catch(error => {
                            console.error("Fetch error:", error);
                            tbody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Error loading data</td></tr>';
                        });
                }

                loadCovers();

                function escapeHtml(text) {
                    if (!text) return "";
                    return text.replace(/&/g, "&amp;")
                        .replace(/</g, "&lt;")
                        .replace(/>/g, "&gt;")
                        .replace(/"/g, "&quot;")
                        .replace(/'/g, "&#039;");
                }

                window.deleteCover = function (id) {
                    if (!confirm("Are you sure you want to delete this cover?")) return;

                    fetch("../ajax/delete_cover.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `id=${encodeURIComponent(id)}`
                    })
                        .then(res => {
                            if (!res.ok) throw new Error("Network error");
                            return res.json();
                        })
                        .then(response => {
                            if (response.success) {
                                alert("Cover deleted successfully");
                                loadCovers();
                            } else {
                                alert("Failed to delete cover: " + response.message);
                            }
                        })
                        .catch(error => {
                            console.error("Delete error:", error);
                            alert("Error deleting cover");
                        });
                }
            });
        </script>

        <?php include_once '../includes/footer.php'; ?>