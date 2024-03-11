<div class="container-fluid">
    <!-- Transparent Engagement -->
    <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
        <div class="card-body text-dark">
            <div class="card-title border-2 border-bottom border-primary">
                <h3 class="fw-bold text-primary">Tranparent Engagement</h3>
            </div>
            <p class="card-text fs-5">
                To better understand how to solve public problems by improving policy and leadership, we engage directly with policymakers, public leaders, governments, nonprofit organizations, and for-profit businesses whose activities affect those problems. To better understand how to solve public problems by improving policy and leadership, we engage directly with policymakers, public leaders, governments, nonprofit organizations, and for-profit businesses whose activities affect those problems.
            </p>
        </div>
    </div>

    <!-- Outside Professional Activities Table List -->
    <div id="extensionsCard" class="card my-3 p-1 border-0 shadow-lg rounded-5">
        <div class="card-body text-dark">
            <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                <h3 class="fw-bold text-primary w-100 m-0">Outside Professional Activities</h3>
                <?php
                $sql = "SELECT * FROM `extensions` WHERE `extension_user_id` = '$user_id'";
                $result = mysqli_query($con, $sql);
                $check_result = mysqli_num_rows($result) > 0;
                if ($check_result) {
                ?>
                    <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modifyExtensionsModal">
                        <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Extensions"></span>
                    </button>
                <?php
                } else {
                ?>
                    <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#createExtensionsModal">
                        <span class="icon-plus-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Create Extension"></span>
                    </button>
                <?php
                }
                ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped text-center rounded-4 overflow-hidden align-middle">
                    <thead class="text-bg-primary">
                        <tr>
                            <th scope="col">
                                <h3>
                                    Organization
                                </h3>
                            </th>
                            <th scope="col">
                                <h3>
                                    Relationship
                                </h3>
                            </th>
                            <th scope="col">
                                <h3>
                                    Tenurity
                                </h3>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold fs-5">
                        <?php
                        $sql = "SELECT * FROM `extensions` WHERE `extension_user_id` = '$user_id'";
                        $result = mysqli_query($con, $sql);
                        $check_result = mysqli_num_rows($result) > 0;
                        if ($check_result) {
                            while ($data = mysqli_fetch_array($result)) {
                        ?>
                                <tr>
                                    <td class="w-25"><?= $data['extension_name'] ?></td>
                                    <td class="w-25"><?= $data['extension_relationship'] ?></td>
                                    <td class="w-25"><?= $data['extension_start_date'] ?> — <?= $data['extension_end_date'] ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="3">
                                    <h4 class="text-center fw-bold text-muted">No extensions yet.</h4>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Extenstions Modals -->
<!-- Create Extension Modal -->
<div class="modal fade" id="createExtensionsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create Extension</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreateExtension" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateExtension" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createExtensionForm" class="row g-2">
                    <input type="hidden" name="extensionUserID" value="<?= $user_id ?>">
                    <div class="col-lg-6 col-sm-12">
                        <label for="createExtensionName" class="form-label fw-bold">Extension Name</label>
                        <input id="createExtensionName" type="text" class="form-control bg-light" name="createExtensionName" placeholder="Enter extension name.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="createExtensionRelationship" class="form-label fw-bold">Extension Relationship</label>
                        <input id="createExtensionRelationship" type="text" class="form-control bg-light" name="createExtensionRelationship" placeholder="Enter extension relationship.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="createExtensionStartDate" class="form-label fw-bold">Start Date</label>
                        <select id="createExtensionStartDate" class="form-select form-control bg-light" name="createExtensionStartDate">
                            <option selected>Select Year</option>
                            <?php
                            $currentYear = date("Y");
                            for ($year = 1950; $year <= $currentYear; $year++) {
                            ?>
                                <option value="<?= $year ?>"><?= $year ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="createExtensionEndDate" class="form-label fw-bold">End Date</label>
                        <select id="createExtensionEndDate" class="form-select form-control bg-light" name="createExtensionEndDate">
                            <option selected>Select Year</option>
                            <?php
                            $currentYear = date("Y");
                            for ($year = 1950; $year <= $currentYear; $year++) {
                            ?>
                                <option value="<?= $year ?>"><?= $year ?></option>
                            <?php
                            }
                            ?>
                            <option value="Present">Present</option>
                        </select>
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modify List of Extensions Modal -->
<div class="modal fade" id="modifyExtensionsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Modify Extensions</h1>
            </div>
            <div class="modal-body">
                <div id="displayExtensions" class="table-responsive">
                    <table class="table table-striped text-center rounded-4 overflow-hidden align-middle">
                        <thead class="text-bg-primary">
                            <tr>
                                <th scope="col">
                                    <h3>
                                        Organization
                                    </h3>
                                </th>
                                <th scope="col">
                                    <h3>
                                        Relationship
                                    </h3>
                                </th>
                                <th scope="col">
                                    <h3>
                                        Tenurity
                                    </h3>
                                </th>
                                <th scope="col">
                                    <h3>
                                        Actions
                                    </h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold fs-5">
                            <?php
                            $sql = "SELECT * FROM `extensions` WHERE `extension_user_id` = '$user_id'";
                            $result = mysqli_query($con, $sql);
                            $check_result = mysqli_num_rows($result) > 0;
                            if ($check_result) {
                                while ($data = mysqli_fetch_array($result)) {
                            ?>
                                    <tr>
                                        <td class="w-25"><?= $data['extension_name'] ?></td>
                                        <td class="w-25"><?= $data['extension_relationship'] ?></td>
                                        <td class="w-25"><?= $data['extension_start_date'] ?> — <?= $data['extension_end_date'] ?></td>
                                        <td class="w-25">
                                            <button value="<?= $data['extension_id'] ?>" class="editExtensionButton btn btn-success"><span class="icon-pencil"></span></button>
                                            <button value="<?= $data['extension_id'] ?>" class="deleteExtensionButton btn btn-danger"><span class="icon-trash"></span></button>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="3">
                                        <h4 class="text-center fw-bold text-muted">No extensions yet.</h4>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#insertExtensionsModal"><span class="icon-plus-circle fs-3"></span></button>
                <div class="modal-footer mt-2 pb-0 px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="saveExtensions" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Insert Extension Modal -->
<div class="modal fade" id="insertExtensionsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Insert Extension</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertInsertExtension" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageInsertExtension" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="insertExtensionForm" class="row g-2">
                    <input type="hidden" name="insertExtensionUserID" value="<?= $user_id ?>">
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertExtensionName" class="form-label fw-bold">Extension Name</label>
                        <input id="insertExtensionName" type="text" class="form-control bg-light" name="insertExtensionName" placeholder="Enter extension name.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertExtensionRelationship" class="form-label fw-bold">Extension Relationship</label>
                        <input id="insertExtensionRelationship" type="text" class="form-control bg-light" name="insertExtensionRelationship" placeholder="Enter extension relationship.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertExtensionStartDate" class="form-label fw-bold">Start Date</label>
                        <select id="insertExtensionStartDate" class="form-select form-control bg-light" name="insertExtensionStartDate">
                            <option selected>Select Year</option>
                            <?php
                            $currentYear = date("Y");
                            for ($year = 1950; $year <= $currentYear; $year++) {
                            ?>
                                <option value="<?= $year ?>"><?= $year ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertExtensionEndDate" class="form-label fw-bold">End Date</label>
                        <select id="insertExtensionEndDate" class="form-select form-control bg-light" name="insertExtensionEndDate">
                            <option selected>Select Year</option>
                            <?php
                            $currentYear = date("Y");
                            for ($year = 1950; $year <= $currentYear; $year++) {
                            ?>
                                <option value="<?= $year ?>"><?= $year ?></option>
                            <?php
                            }
                            ?>
                            <option value="Present">Present</option>
                        </select>
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyExtensionsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Extension Modal -->
<div class="modal fade" id="editExtensionsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Extension</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditExtension" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditExtension" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editExtensionForm" class="row g-2">
                    <input type="hidden" id="editExtensionID" name="editExtensionID">
                    <div class="col-lg-6 col-sm-12">
                        <label for="editExtensionName" class="form-label fw-bold">Extension Name</label>
                        <input id="editExtensionName" type="text" class="form-control bg-light" name="editExtensionName" placeholder="Enter extension name.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="editExtensionRelationship" class="form-label fw-bold">Extension Relationship</label>
                        <input id="editExtensionRelationship" type="text" class="form-control bg-light" name="editExtensionRelationship" placeholder="Enter extension relationship.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="editExtensionStartDate" class="form-label fw-bold">Start Date</label>
                        <select id="editExtensionStartDate" class="form-select form-control bg-light" name="editExtensionStartDate">
                            <option selected>Select Year</option>
                            <?php
                            $currentYear = date("Y");
                            for ($year = 1950; $year <= $currentYear; $year++) {
                            ?>
                                <option value="<?= $year ?>"><?= $year ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="editExtensionEndDate" class="form-label fw-bold">End Date</label>
                        <select id="editExtensionEndDate" class="form-select form-control bg-light" name="editExtensionEndDate">
                            <option selected>Select Year</option>
                            <?php
                            $currentYear = date("Y");
                            for ($year = 1950; $year <= $currentYear; $year++) {
                            ?>
                                <option value="<?= $year ?>"><?= $year ?></option>
                            <?php
                            }
                            ?>
                            <option value="Present">Present</option>
                        </select>
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyExtensionsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Extension Modal -->
<div class="modal fade" id="deleteExtensionsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete Extension</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeleteExtension" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeleteExtension" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deleteExtensionForm" class="row g-2">
                    <input type="hidden" id="deleteExtensionID" name="deleteExtensionID">
                    <p>Confirm deletion of the extension with <strong id="deleteExtensionName"></strong> as <strong id="deleteExtensionRelationship"></strong> from <strong id="deleteExtensionStartDate"></strong> - <strong id="deleteExtensionEndDate"></strong>?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyExtensionsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>