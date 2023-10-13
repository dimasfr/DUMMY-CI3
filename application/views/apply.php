<?php
$this->load->view('template/header_template');
?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Apply Vacancy</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <form class="docs-search-form row gx-1 align-items-center">
                                <div class="col-auto">
                                    <input type="text" id="search-docs" name="searchdocs" class="form-control search-docs" placeholder="Search">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn app-btn-secondary">Search</button>
                                </div>
                            </form>

                        </div><!--//col-->
                        <div class="col-auto">

                            <select class="form-select w-auto" id="ocandidate"></select>
                        </div>
                    </div><!--//row-->
                </div><!--//table-utilities-->
            </div><!--//col-auto-->
        </div><!--//row-->

        <div class="row g-4" id="tcontent"></div><!--//row-->
        <nav class="app-pagination mt-5">
            <ul class="pagination justify-content-center" id="tpage"></ul>
        </nav><!--//app-pagination-->
    </div><!--//container-fluid-->
</div><!--//app-content-->

<script>
    var BASE_URL = '<?= base_url() ?>';

    $(function() {
        $.ajax({
            url: BASE_URL + "apply/getTable",
            type: "POST",
            success: function(response) {
                setupContent(response);
                setupPage(response);
            }
        })

        $.ajax({
            url: BASE_URL + "apply/getCandidate",
            type: "POST",
            success: function(response) {
                $('#ocandidate').empty();
                if (response.length > 0) {
                    response.forEach(element => {
                        $('#ocandidate').append(`<option value="` + element.candidate_id + `">` + element.full_name + `</option>`);
                    });
                }
            }
        })
    })

    function onSearch() {
        let search = $('#search-orders').val();
        $.ajax({
            url: BASE_URL + "apply/getTable",
            data: {
                search
            },
            type: "POST",
            success: function(response) {
                setupContent(response);
                setupPage(response);
            }
        })
    }

    function goPage(url) {
        $.ajax({
            url: url,
            type: "POST",
            success: function(response) {
                setupContent(response);
                setupPage(response);
            }
        })
    }

    function setupContent(response) {
        $('#tcontent').empty();
        if (response.result.length > 0) {
            response.result.forEach(element => {
                $('#tcontent').append(`

                <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                    <div class="app-card app-card-doc shadow-sm  h-100">
                        <div class="app-card-thumb-holder p-3">
                            <div class="app-card-thumb">
                                <img class="thumb-image" src="assets/images/doc-thumb-1.jpg" alt="">
                            </div>
                            <a class="app-card-link-mask" href="#file-link"></a>
                        </div>
                        <div class="app-card-body p-3 has-card-actions">

                            <h4 class="app-doc-title truncate mb-0"><a href="#file-link">` + element.vacancy_name + `</a></h4>
                            <div class="app-doc-meta text-center">
                                <button type="button" class="btn btn-info" onclick="onApply('` + element.vacancy_id + `')">Apply</button>
                            </div><!--//app-doc-meta-->

                        </div><!--//app-card-body-->

                    </div><!--//app-card-->
                </div><!--//col-->
            `);
            });
        } else {
            $('#tcontent').append(`
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

    function onApply(vacancy) {
        let vacancy_id = vacancy;
        let candidate_id = $('#ocandidate').val()

        $.ajax({
            url: BASE_URL + "apply/apply",
            data: {
                vacancy_id,
                candidate_id
            },
            type: "POST",
            success: function(response) {
                if (response.status) {
                    alert('Success Applying')
                } else {
                    alert(response.msg)
                }
            }
        })
    }
</script>

<?php
$this->load->view('template/bottom_template');
?>