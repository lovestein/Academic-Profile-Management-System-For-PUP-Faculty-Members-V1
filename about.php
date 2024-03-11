<?php
$page_title = "About";
include '../includes/headerUser.php';
?>

<!-- Cover Photo -->
<section class="bg-img-cover">
    <div class="container-lg">
        <div class="row justify-content-center align-items-center p-5">
            <div class="col text-center">
                <h1 class="text-primary fw-bold display-2">ALL ABOUT PUP</h1>
                <h4 class="text-dark fw-bold">Get to know our Sintang Paaralan</h4>
            </div>
        </div>
    </div>
</section>
<!-- Main Contents -->
<section>
    <div class="container-fluid">
        <div class="row">

            <!-- Colleges Tabs Section -->
            <div class="col-lg-3 col-sm-12">
                <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
                    <div class="card-body">
                        <!-- Title -->
                        <div class="card-title border-2 border-bottom border-primary">
                            <h3 class="fw-bold text-primary">Colleges</h3>
                        </div>
                        <!-- Tabs -->
                        <nav class=" d-flex align-items-start">
                            <div class="nav nav-tabs nav nav-justified w-100 flex-column nav-pills me-3 border-0 fw-bold" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="navCAFTab" data-bs-toggle="tab" data-bs-target="#navCAF" type="button" role="tab" aria-controls="navCAF" aria-selected="true">
                                    College of Accountancy and Finance <strong>(CAF)</strong>
                                </button>
                                <button class="nav-link" id="navCADBETab" data-bs-toggle="tab" data-bs-target="#navCADBE" type="button" role="tab" aria-controls="navCADBE" aria-selected="false">
                                    College of Architecture, Design and the Built Environment <strong>(CADBE)</strong>
                                </button>
                                <button class="nav-link" id="navCALTab" data-bs-toggle="tab" data-bs-target="#navCAL" type="button" role="tab" aria-controls="navCAL" aria-selected="false">
                                    College of Arts and Letters <strong>(CAL)</strong>
                                </button>
                                <button class="nav-link" id="navCBATab" data-bs-toggle="tab" data-bs-target="#navCBA" type="button" role="tab" aria-controls="navCBA" aria-selected="false">
                                    College of Business Administration <strong>(CBA)</strong>
                                </button>
                                <button class="nav-link" id="navCOCTab" data-bs-toggle="tab" data-bs-target="#navCOC" type="button" role="tab" aria-controls="navCOC" aria-selected="false">
                                    College of Communication <strong>(COC)</strong>
                                </button>
                                <button class="nav-link" id="navCCISTab" data-bs-toggle="tab" data-bs-target="#navCCIS" type="button" role="tab" aria-controls="navCCIS" aria-selected="false">
                                    College of Computer and Information Sciences <strong>(CCIS)</strong>
                                </button>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Colleges Tabs Contents -->
            <div class="col-lg-9 col-sm-12">
                <div class="tab-content" id="nav-tabContent">

                    <!-- College of Accountancy and Finance (CAF) -->
                    <div class="tab-pane fade show active" id="navCAF" role="tabpanel" aria-labelledby="navCAFTab" tabindex="0">
                        <?php include './about/caf.php'; ?>
                    </div>

                    <!-- College of Architecture, Design and the Built Environment (CADBE) -->
                    <div class="tab-pane fade" id="navCADBE" role="tabpanel" aria-labelledby="navCADBETab" tabindex="0">
                        <?php include './about/cadbe.php'; ?>
                    </div>

                    <!-- College of Arts and Letters (CAL) -->
                    <div class="tab-pane fade" id="navCAL" role="tabpanel" aria-labelledby="navCALTab" tabindex="0">
                        <?php include './about/cal.php'; ?>
                    </div>

                    <!-- College of Business Administration (CBA) -->
                    <div class="tab-pane fade" id="navCBA" role="tabpanel" aria-labelledby="navCBATab" tabindex="0">
                        <?php include './about/cba.php'; ?>
                    </div>

                    <!-- College of Communication (COC) -->
                    <div class="tab-pane fade" id="navCOC" role="tabpanel" aria-labelledby="navCOCTab" tabindex="0">
                        <?php include './about/coc.php'; ?>
                    </div>

                    <!-- College of Computer and Information Sciences (CCIS) -->
                    <div class="tab-pane fade" id="navCCIS" role="tabpanel" aria-labelledby="navCCISTab" tabindex="0">
                        <?php include './about/ccis.php'; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?php
include '../includes/footerUser.php';
?>