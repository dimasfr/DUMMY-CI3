<?php
$this->load->view('template/header_template');
?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Candidate</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <form class="table-search-form row gx-1 align-items-center">
                                <div class="col-auto">
                                    <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn app-btn-secondary" onclick="onSearch()">Search</button>
                                </div>
                            </form>

                        </div><!--//col-->
                        <div class="col-auto">
                            <button class="btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#mod_add_candidate">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                Add Candidate
                            </button>
                        </div>
                        <div class="col-auto">
                            <button class="btn app-btn-secondary" onclick="onDownload()" data-bs-toggle="modal" data-bs-target="#mod_view_report">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                </svg>
                                Download Report
                            </button>
                        </div>
                    </div><!--//row-->
                </div><!--//table-utilities-->
            </div><!--//col-auto-->
        </div><!--//row-->


        <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
            <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
        </nav>


        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr class="text-center">
                                        <th class="cell">Email</th>
                                        <th class="cell">Phone</th>
                                        <th class="cell">Name</th>
                                        <th class="cell">Gender</th>
                                        <th class="cell">Last Salary</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody"></tbody>
                            </table>
                        </div><!--//table-responsive-->

                    </div><!--//app-card-body-->
                </div><!--//app-card-->
                <nav class="app-pagination">
                    <ul class="pagination justify-content-center" id="tpage"></ul>
                </nav><!--//app-pagination-->

            </div><!--//tab-pane-->
        </div><!--//tab-content-->

        <!-- Modal View -->
        <div class="modal fade" id="mod_view_candidate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Candidate Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col text-end">
                                <button type="button" class="btn btn-outline-info" title="Edit" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#mod_edit_candidate" onclick="onEdit()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    </svg> Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger" title="Delete" data-bs-dismiss="modal" onclick="onDelete()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                                        <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                        <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z" />
                                    </svg> Delete
                                </button>
                            </div>
                        </div>
                        <br>
                        <table class="table app-table-hover mb-0 text-left">
                            <input type="hidden" id="stored_data" value="">
                            <input type="hidden" id="detail_id" value="">
                            <tr class="border border-dark">
                                <td>Email</td>
                                <td id="detail_email"></td>
                            </tr>
                            <tr class="border border-dark">
                                <td>Phone Number</td>
                                <td id="detail_phone"></td>
                            </tr>
                            <tr class="border border-dark">
                                <td>Full Name</td>
                                <td id="detail_name"></td>
                            </tr>
                            <tr class="border border-dark">
                                <td>Gender</td>
                                <td id="detail_gender"></td>
                            </tr>
                            <tr class="border border-dark">
                                <td>Date of Birth</td>
                                <td id="detail_date"></td>
                            </tr>
                            <tr class="border border-dark">
                                <td>Place of Birth</td>
                                <td id="detail_place"></td>
                            </tr>
                            <tr class="border border-dark">
                                <td>Years of Experience</td>
                                <td id="detail_years"></td>
                            </tr>
                            <tr class="border border-dark">
                                <td>Last Salary</td>
                                <td id="detail_salary"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal fade" id="mod_add_candidate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <form action="#" id="formAdd" class="form-floating">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Candidate</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ref="close_mod_add_candidate"></button>
                        </div>
                        <div class="modal-body">
                            <h5></h5>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" id="email" required>
                                        <label for="email" class="fw-bold">Email *</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="phone_number" class="form-control" id="phone_number">
                                        <label for="phone_number" class="fw-bold">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="full_name" class="form-control" id="full_name" required>
                                        <label for="full_name" class="fw-bold">Full Name *</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="date" name="dob" class="form-control" id="dob" required>
                                        <label for="dob" class="fw-bold">Date of Birth *</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="pob" class="form-control" id="pob" required>
                                        <label for="pob" class="fw-bold">Place of Birth *</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="F">Female</option>
                                            <option value="M">Male</option>
                                        </select>
                                        <label for="gender" class="fw-bold">Gender</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="year_exp" class="form-control" id="year_exp" required>
                                        <label for="year_exp" class="fw-bold">Year of Experience *</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="number" name="last_salary" class="form-control" id="last_salary" required>
                                        <label for="last_salary" class="fw-bold">Last Salary *</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="onSave()">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal fade" id="mod_edit_candidate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <form action="#" id="formEdit" class="form-floating">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Candidate</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ref="close_mod_edit_candidate"></button>
                        </div>
                        <div class="modal-body">
                            <h5></h5>
                            <input type="hidden" id="edit_id" name="candidate_id" value="">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" id="edit_email" required>
                                        <label for="email" class="fw-bold">Email *</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="phone_number" class="form-control" id="edit_phone">
                                        <label for="phone_number" class="fw-bold">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="full_name" class="form-control" id="edit_name" required>
                                        <label for="full_name" class="fw-bold">Full Name *</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="date" name="dob" class="form-control" id="edit_date" required>
                                        <label for="dob" class="fw-bold">Date of Birth *</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="pob" class="form-control" id="edit_place" required>
                                        <label for="pob" class="fw-bold">Place of Birth *</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <select class="form-control" name="gender" id="edit_gender">
                                            <option value="F">Female</option>
                                            <option value="M">Male</option>
                                        </select>
                                        <label for="gender" class="fw-bold">Gender</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="year_exp" class="form-control" id="edit_years" required>
                                        <label for="year_exp" class="fw-bold">Year of Experience *</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="number" name="last_salary" class="form-control" id="edit_salary" required>
                                        <label for="last_salary" class="fw-bold">Last Salary *</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="onUpdate()">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal fade" id="mod_view_report" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <form action="#" class="form-floating">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Report</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ref="close_mod_view_report"></button>
                        </div>
                        <div class="modal-body">
                            <iframe id="pdfIframe" width="100%" height="500"></iframe>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div><!--//container-fluid-->
</div><!--//app-content-->

<script>
    var BASE_URL = '<?= base_url() ?>';

    $(function() {
        $.ajax({
            url: BASE_URL + "candidate/getTable",
            type: "POST",
            success: function(response) {
                setupTable(response);
                setupPage(response);
            }
        })
    })

    function onSearch() {
        let search = $('#search-orders').val();
        $.ajax({
            url: BASE_URL + "candidate/getTable",
            data: {
                search
            },
            type: "POST",
            success: function(response) {
                setupTable(response);
                setupPage(response);
            }
        })
    }

    function goPage(url) {
        $.ajax({
            url: url,
            type: "POST",
            success: function(response) {
                setupTable(response);
                setupPage(response);
            }
        })
    }

    function setupTable(response) {
        $('#tbody').empty();
        if (response.result.length > 0) {
            response.result.forEach(element => {
                $('#tbody').append(`
                    <tr class="text-center">
                        <td class="cell"><span class="truncate">` + element.email + `</span></td>
                        <td class="cell"><span class="cell-data">` + element.phone_number + `</span></td>
                        <td class="cell">` + element.full_name + `</td>
                        <td class="cell"><span class="badge bg-success">` + element.gender + `</span></td>
                        <td class="cell">` + element.last_salary + `</td>
                        <td class="cell"><a class="btn-sm app-btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#mod_view_candidate" onclick="onDetail('` + btoa(JSON.stringify(element)) + `')">View</a></td>
                    </tr>
                `);
            });
        } else {
            $('#tbody').append(`
                <tr>
                    <td class="cell" colspan="7">No Data Found...</td>
                </tr>
            `);
        }
    }

    function setupPage(response) {
        $('#tpage').empty();
        let pagination = response.pagination;
        var tempElement = document.createElement("div");
        tempElement.innerHTML = pagination;
        var pageLinks = [];
        var linkElements = tempElement.getElementsByTagName("a");
        for (var i = 0; i < linkElements.length; i++) {
            var link = linkElements[i];
            var linkObject = {
                href: link.getAttribute("href").replace(/\\/g, ''),
                dataCiPaginationPage: link.getAttribute("data-ci-pagination-page"),
                text: link.innerText
            };
            pageLinks.push(linkObject);
        }

        if (pageLinks.length > 0) {
            pageLinks.forEach(element => {
                let html = '';
                if (element.text == '>') {
                    html = 'Next';
                    $('#tpage').append(`
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="goPage('` + element.href + `')">Next</a>
                    </li>
                `);
                } else if (element.text == '<') {
                    $('#tpage').append(`
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="goPage('` + element.href + `')">Previous</a>
                    </li>
                `);
                } else if ((element.text).includes('last')) {
                    $('#tpage').append(`
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="goPage('` + element.href + `')">Last</a>
                    </li>
                `);
                } else if ((element.text).includes('first')) {
                    $('#tpage').append(`
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="goPage('` + element.href + `')">First</a>
                    </li>
                `);
                } else {
                    $('#tpage').append(`
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="goPage('` + element.href + `')">` + element.text + `</a>
                    </li>
                `);
                }
            });
        }
    }

    function onDetail(element) {
        let data = JSON.parse(atob(element));
        $('#stored_data').val(element);
        $('#detail_id').val(data.candidate_id);
        $('#detail_email').html(data.email);
        $('#detail_phone').html(data.phone_number);
        $('#detail_name').html(data.full_name);
        $('#detail_gender').html(data.gender);
        $('#detail_date').html(data.dob);
        $('#detail_place').html(data.pob);
        $('#detail_years').html(data.year_exp);
        $('#detail_salary').html(data.last_salary);
    }

    function onSave() {
        let form = document.getElementById('formAdd')
        let fd = new FormData(form)
        $.ajax({
            url: BASE_URL + "candidate/add",
            data: fd,
            processData: false,
            contentType: false,
            type: "POST",
            success: function(response) {
                if (!response.status) {
                    alert('Duplicated Data Detected!');
                } else {
                    location.reload();
                }
            }
        })
    }

    function onEdit() {
        let data = JSON.parse(atob($('#stored_data').val()));
        $('#edit_id').val(data.candidate_id);
        $('#edit_email').val(data.email);
        $('#edit_phone').val(data.phone_number);
        $('#edit_name').val(data.full_name);
        $('#edit_gender').val(data.gender);
        $('#edit_date').val(data.dob);
        $('#edit_place').val(data.pob);
        $('#edit_years').val(data.year_exp);
        $('#edit_salary').val(data.last_salary);
    }

    function onUpdate() {
        let form = document.getElementById('formEdit')
        let fd = new FormData(form)
        $.ajax({
            url: BASE_URL + "candidate/edit",
            data: fd,
            processData: false,
            contentType: false,
            type: "POST",
            success: function(response) {
                if (!response.status) {
                    alert('Error Detected!');
                } else {
                    location.reload();
                }
            }
        })
    }

    function onDelete() {
        var r = confirm("Deleted data can't recovered");
        if (r == true) {
            let id = $('#detail_id').val();
            $.ajax({
                url: BASE_URL + "candidate/delete/" + id,
                type: "POST",
                success: function(response) {
                    if (!response.status) {
                        alert('Error!');
                    } else {
                        location.reload();
                    }
                }
            })
        }
    }

    function onDownload() {
        $.ajax({
            url: BASE_URL + "candidate/download",
            type: "POST",
            success: function(data) {
                var pdfBase64 = data.pdfBase64;
                // Example: Display the PDF in an iframe
                $('#pdfIframe').attr('src', 'data:application/pdf;base64,' + pdfBase64);
            },
            error: function() {
                // Handle errors if the PDF generation fails
                alert('PDF generation failed');
            }
        })
    }
</script>

<?php
$this->load->view('template/bottom_template');
?>