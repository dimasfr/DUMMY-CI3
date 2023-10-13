<?php
$this->load->view('template/header_template');
?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Vacancy</h1>
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
                            <button class="btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#mod_add_vacancy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                Add Vacancy
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
                                        <th class="cell">Vacancy Name</th>
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

        <!-- Modal Add -->
        <div class="modal fade" id="mod_add_vacancy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <form action="#" id="formAdd" class="form-floating">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Vacancy</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ref="close_mod_add_vacancy"></button>
                        </div>
                        <div class="modal-body">
                            <h5></h5>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="vacancy_name" class="form-control" id="vacancy_name" required>
                                        <label for="vacancy_name" class="fw-bold">Vacancy Name *</label>
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
        <div class="modal fade" id="mod_edit_vacancy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <form action="#" id="formEdit" class="form-floating">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Vacancy</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ref="close_mod_edit_vacancy"></button>
                        </div>
                        <div class="modal-body">
                            <h5></h5>
                            <input type="hidden" id="edit_id" name="vacancy_id" value="">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="vacancy_name" class="form-control" id="edit_vacancy" required>
                                        <label for="vacancy_name" class="fw-bold">Vacancy Name *</label>
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
                <form action="#" id="formEdit" class="form-floating">
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
            url: BASE_URL + "vacancy/getTable",
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
            url: BASE_URL + "vacancy/getTable",
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
                        <td class="cell"><span class="truncate">` + element.vacancy_name + `</span></td>
                        <td class="cell">
                            <a class="btn-sm app-btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#mod_edit_vacancy" onclick="onEdit('` + btoa(JSON.stringify(element)) + `')">Edit</a>
                            <a class="btn-sm app-btn-secondary" href="#" onclick="onDelete('` + element.vacancy_id + `')">Delete</a>
                        </td>
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

    function onSave() {
        let form = document.getElementById('formAdd')
        let fd = new FormData(form)
        $.ajax({
            url: BASE_URL + "vacancy/add",
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

    function onEdit(element) {
        let data = JSON.parse(atob(element));
        $('#edit_id').val(data.vacancy_id);
        $('#edit_vacancy').val(data.vacancy_name);
    }

    function onUpdate() {
        let form = document.getElementById('formEdit')
        let fd = new FormData(form)
        $.ajax({
            url: BASE_URL + "vacancy/edit",
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

    function onDelete(id) {
        var r = confirm("Deleted data can't recovered");
        if (r == true) {
            $.ajax({
                url: BASE_URL + "vacancy/delete/" + id,
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
            url: BASE_URL + "vacancy/download",
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