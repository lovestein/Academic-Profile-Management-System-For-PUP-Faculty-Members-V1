<div class="container-fluid">

    <!-- Books -->
    <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
        <div class="card-body text-dark">
            <div class="card-title border-2 border-bottom border-primary d-flex">
                <h3 class="fw-bold text-primary w-100">Books</h3>
            </div>
            <div class="card-text m-0 fs-5">
                <?php
                $sql = "SELECT * FROM `books` WHERE `book_user_id` = '$user_id'";
                $result = mysqli_query($con, $sql);
                $check_result = mysqli_num_rows($result) > 0;
                if ($check_result) {
                ?><ul>
                        <?php
                        while ($data = mysqli_fetch_array($result)) {
                            $book_publish_date = new DateTime($data['book_publish_date']);

                            if ($data['book_url'] == NULL) {
                        ?>
                                <li class="mb-3">
                                    <a href="#" class="text-decoration-none fw-bold fst-italic" target="_blank">"<?= $data['book_title'] ?>"</a>
                                    <p class="text-muted ms-3 fs-6">Published on <strong><?= date_format($book_publish_date, "F, Y") ?></strong> by <strong><?= $data['book_author'] ?></strong></p>
                                    <p class="ms-3 fs-6 m-0"><?= $data['book_description'] ?></p>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="mb-3">
                                    <a href="<?= $data['book_url'] ?>" class="text-decoration-none fw-bold fst-italic" target="_blank">"<?= $data['book_title'] ?>"</a>
                                    <p class="text-muted ms-3 fs-6">Published on <strong><?= date_format($book_publish_date, "F, Y") ?></strong> by <strong><?= $data['book_author'] ?></strong></p>
                                    <p class="ms-3 fs-6 m-0"><?= $data['book_description'] ?></p>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                <?php
                } else {
                ?>
                    No books yet.
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Research Papers/Reports -->
    <div class="card my-3 p-1 border-0 shadow-lg rounded-5">
        <div class="card-body text-dark">
            <div class="card-title border-2 border-bottom border-primary d-flex">
                <h3 class="fw-bold text-primary w-100">Researh Papers/Reports</h3>
            </div>
            <div class="card-text fs-5">
                <?php
                $sql = "SELECT * FROM `selected_publications` WHERE `publication_user_id` = '$user_id'";
                $result = mysqli_query($con, $sql);
                $check_result = mysqli_num_rows($result) > 0;
                if ($check_result) {
                ?><ul>
                        <?php
                        while ($data = mysqli_fetch_array($result)) {
                            $publication_date = new DateTime($data['publication_date']);

                            if ($data['publication_link'] == NULL) {
                        ?>
                                <li>
                                    <a href="#" class="text-decoration-none fw-bold fst-italic" target="_blank">"<?= $data['publication_title'] ?>"</a>
                                    <p class="text-muted ms-3 fs-6"><small>Published on <strong><?= date_format($publication_date, "F, Y") ?></strong> by <strong><?= $data['publication_author'] ?></strong></small></p>
                                    <p class="ms-3 fs-6 m-0"><?= $data['publication_description'] ?></p>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="mb-3">
                                    <a href="<?= $data['publication_link'] ?>" class="text-decoration-none fw-bold fst-italic" target="_blank">"<?= $data['publication_title'] ?>"</a>
                                    <p class="text-muted ms-3 fs-6">Published on <strong><?= date_format($publication_date, "F, Y") ?></strong> by <strong><?= $data['publication_author'] ?></strong></p>
                                    <p class="ms-3 fs-6 m-0"><?= $data['publication_description'] ?></p>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                <?php
                } else {
                ?>
                    No research paper or reports published yet.
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</div>