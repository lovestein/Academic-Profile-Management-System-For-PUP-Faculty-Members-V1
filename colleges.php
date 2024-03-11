<?php
$page_title = "Colleges";
include '../includes/headerUser.php';

?>
<!-- Title -->
<section class="bg-img-cover">
    <div class="container-lg">
        <div class="row justify-content-center align-items-center p-5">
            <div class="col text-center">
                <h1 class="text-primary fw-bold display-2">Gateway for Faculty & Staff</h1>
                <h4 class="text-dark fw-bold">Resources, offices, and services for PUP faculty and staff</h4>
                <!-- Search Bar -->
                <div class="container-md pt-3">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-5 col-md-12 p-1">
                            <div class="input-group">
                                <input class="form-control bg-light rounded-end rounded-pill border-end-0" id="searchFacultyOfficialStaff" placeholder="Search Faculty or Staff." data-bs-toggle="dropdown" aria-expanded="false">
                                <ul id="searchResult" class="dropdown-menu">
                                
                                </ul>
                                <span class="input-group-text rounded-start rounded-pill bg-light border-start-0"><span class="icon-search text-primary"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section>
    <div class="container-fluid">
        <!-- Button Tabs -->
        <ul class="nav nav-pills fs-5 p-1 m-1 fw-bold justify-content-center gap-3 nav-justified flex-column flex-sm-row border-3 border-bottom border-primary" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="faculty-tab" data-bs-toggle="tab" data-bs-target="#faculty-tab-pane" type="button" role="tab" aria-controls="faculty-tab-pane" aria-selected="true">Faculty</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="officialStaff-tab" data-bs-toggle="tab" data-bs-target="#officialStaff-tab-pane" type="button" role="tab" aria-controls="officialStaff-tab-pane" aria-selected="false">Officials & Staff</button>
            </li>
        </ul>

        <!-- Sections Contents -->
        <div class="tab-content" id="myTabContent">
            <!-- Faculty Content -->
            <div class="tab-pane fade show active" id="faculty-tab-pane" role="tabpanel" aria-labelledby="faculty-tab" tabindex="0">
                <?php include './colleges/faculty.php'; ?>
            </div>

            <!-- Officials & Staff Content -->
            <div class="tab-pane fade" id="officialStaff-tab-pane" role="tabpanel" aria-labelledby="officialStaff-tab" tabindex="0">
                <?php include './colleges/officialStaff.php'; ?>
            </div>

        </div>
    </div>
</section>

<?php
include '../includes/footerUser.php';
?>