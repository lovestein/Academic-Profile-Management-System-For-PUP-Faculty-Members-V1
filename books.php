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
                            <h2 class="text-center fw-bold w-100 text-primary">Books</h2>
                        </div>
                        <div class="card-body">
                            <table id="booksTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Description</th>
                                        <th>Link URL</th>
                                        <th>Date Published</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT 
                                                up.user_id,
                                                up.user_name,
                                                b.book_id,
                                                b.book_user_id,
                                                b.book_title,
                                                b.book_author,
                                                b.book_description,
                                                b.book_url,
                                                b.book_publish_date
                                            FROM 
                                                books b
                                            JOIN 
                                                user_profiles up ON b.book_user_id = up.user_id
                                            WHERE 
                                                up.user_type = 'User'";

                                    // Result
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                    // Check if data are retrieved
                                    $check_result = mysqli_num_rows($result) > 0;
                                    if ($check_result) {

                                        while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                            <tr>
                                                <td><?= $data['user_name'] ?></td>
                                                <td><?= $data['book_title'] ?></td>
                                                <td><?= $data['book_author'] ?></td>
                                                <td><?= $data['book_description'] ?></td>
                                                <td><?= $data['book_url'] ?></td>
                                                <td><?= $data['book_publish_date'] ?></td>
                                                <td class="justify-content-center d-flex gap-2">
                                                    <button value="<?= $data['book_id'] ?>" class="editBookButton btn btn-success"><span class="icon-pencil"></span></button>
                                                    <button value="<?= $data['book_id'] ?>" class="deleteBookButton btn btn-danger"><span class="icon-trash"></span></button>
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