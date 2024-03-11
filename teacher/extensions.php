<div class="container-lg">
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
    <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
        <div class="card-body text-dark">
            <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                <h3 class="fw-bold text-primary w-100 m-0">Outside Professional Activities</h3>
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