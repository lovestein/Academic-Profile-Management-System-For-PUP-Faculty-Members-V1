<?php
include '../includes/headerAdmin.php';
?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid p-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-center fw-bold w-100 text-primary">Timeline Posts</h2>
                        </div>
                        <div class="card-body">
                            <table id="timelinePostsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Link URL</th>
                                        <th>Media</th>
                                        <th>Posted On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT 
                                                tp.timeline_post_id,
                                                tp.timeline_post_user_id,
                                                up.user_name,
                                                tp.timeline_post_type,
                                                tp.timeline_post_title,
                                                tp.timeline_post_description,
                                                tp.timeline_post_start_date,
                                                tp.timeline_post_end_date,
                                                tp.timeline_post_url,
                                                tp.timeline_post_media,
                                                tp.timeline_post_date
                                            FROM 
                                                timeline_posts tp
                                            JOIN 
                                                user_profiles up ON tp.timeline_post_user_id = up.user_id
                                            WHERE up.user_type = 'User'";

                                    // Result
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                    // Check if data are retrieved
                                    $check_result = mysqli_num_rows($result) > 0;
                                    if ($check_result) {

                                        while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                            <tr>
                                                <td><?= $data['user_name'] ?></td>
                                                <td><?= $data['timeline_post_type'] ?></td>
                                                <td><?= $data['timeline_post_title'] ?></td>
                                                <td><?= $data['timeline_post_description'] ?></td>
                                                <td><?= $data['timeline_post_start_date'] ?></td>
                                                <td><?= $data['timeline_post_end_date'] ?></td>
                                                <td><?= $data['timeline_post_url'] ?></td>
                                                <td><?= $data['timeline_post_media'] ?></td>
                                                <td><?= $data['timeline_post_date'] ?></td>
                                                <td class="justify-content-center d-flex gap-2">
                                                    <button value="<?= $data['timeline_post_id'] ?>" class="editTimelinePostButton btn btn-success"><span class="icon-pencil"></span></button>
                                                    <button value="<?= $data['timeline_post_id'] ?>" class="deleteTimelinePostButton btn btn-danger"><span class="icon-trash"></span></button>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include '../includes/footerAdmin.php';
?>