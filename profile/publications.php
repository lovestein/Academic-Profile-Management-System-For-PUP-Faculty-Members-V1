<div class="container-fluid">

    <!-- Books -->
    <div id="booksCard" class="card my-3 p-1 border-0 shadow-lg rounded-5">
        <div class="card-body text-dark">
            <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                <h3 class="fw-bold text-primary w-100 m-0">Books</h3>
                <?php
                $sql = "SELECT * FROM `books` WHERE `book_user_id` = '$user_id'";
                $result = mysqli_query($con, $sql);
                $check_result = mysqli_num_rows($result) > 0;
                if ($check_result) {
                ?>
                    <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modifyBooksModal">
                        <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Books"></span>
                    </button>
                <?php
                }
                ?>
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
                    <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#createBooksModal"><span class="icon-plus-circle fs-3"></span></button>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Research Papers/Reports -->
    <div id="publicationsCard" class="card my-3 p-1 border-0 shadow-lg rounded-5">
        <div class="card-body text-dark">
            <div class="card-title border-2 border-bottom border-primary d-flex align-items-center">
                <h3 class="fw-bold text-primary w-100 m-0">Research Papers/Reports</h3>
                <?php
                $sql = "SELECT * FROM `selected_publications` WHERE `publication_user_id` = '$user_id'";
                $result = mysqli_query($con, $sql);
                $check_result = mysqli_num_rows($result) > 0;
                if ($check_result) {
                ?>
                    <button class="m-1 btn btn-primary rounded-circle flex-shrink-1" data-bs-toggle="modal" data-bs-target="#modifyPublicationsModal">
                        <span class="icon-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modify Research Paper/Resports"></span>
                    </button>
                <?php
                }
                ?>
            </div>
            <div class="card-text m-0 fs-4">
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
                    <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#createPublicationsModal"><span class="icon-plus-circle fs-3"></span></button>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</div>

<!-- Books Modals -->
<!-- Create Book Modal -->
<div class="modal fade" id="createBooksModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create Book</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreateBook" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreateBook" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createBookForm" class="row g-2">
                    <input type="hidden" name="bookUserID" value="<?= $user_id ?>">
                    <div class="col-lg-6 col-sm-12">
                        <label for="createBookTitle" class="form-label fw-bold">Book Title</label>
                        <input id="createBookTitle" type="text" class="form-control bg-light" name="createBookTitle" placeholder="Enter book title.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="createBookAuthor" class="form-label fw-bold">Book Author(s)</label>
                        <input id="createBookAuthor" type="text" class="form-control bg-light" name="createBookAuthor" placeholder="Enter book author(s).">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="createBookDescription" class="form-label fw-bold">Book Description</label>
                        <textarea id="createBookDescription" name="createBookDescription" type="text" class="form-control bg-light" style="height: 100px;"></textarea>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="createBookLink" class="form-label fw-bold">Book Reference Link (Optional)</label>
                        <input id="createBookLink" type="text" class="form-control bg-light" name="createBookLink" placeholder="Enter book reference link.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="createBookPublishDate" class="form-label fw-bold">Publication Date</label>
                        <input id="createBookPublishDate" type="date" class="form-control bg-light" name="createBookPublishDate">
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

<!-- Modify List of Books Modal -->
<div class="modal fade" id="modifyBooksModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Modify Books</h1>
            </div>
            <div class="modal-body">
                <div id="displayBooks" class="row g-2">
                    <?php
                    $sql = "SELECT * FROM `books` WHERE `book_user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;
                    if ($result) {
                        while ($data = mysqli_fetch_array($result)) {
                            $book_publish_date = new DateTime($data['book_publish_date']);
                    ?>
                            <div class="col-lg-6 col-sm-12">
                                <label for="bookTitle" class="form-label fw-bold">Book Title</label>
                                <input id="bookTitle" value="<?= $data['book_title'] ?>" type="text" class="form-control bg-light" name="bookTitle" disabled>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="bookAuthor" class="form-label fw-bold">Book Author(s)</label>
                                <input id="bookAuthor" value="<?= $data['book_author'] ?>" type="text" class="form-control bg-light" name="bookAuthor" disabled>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <label for="bookDescription" class="form-label fw-bold">Book Description</label>
                                <textarea id="bookDescription" name="bookDescription" type="text" class="form-control bg-light" style="height: 100px;" disabled><?= $data['book_description'] ?></textarea>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="bookLink" class="form-label fw-bold">Book Reference Link (Optional)</label>
                                <input id="bookLink" value="<?= $data['book_url'] ?>" type="text" class="form-control bg-light" name="bookLink" disabled>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="bookPublicationDate" class="form-label fw-bold">Publication Date</label>
                                <input id="bookPublicationDate" value="<?= date_format($book_publish_date, "F, Y") ?>" type="text" class="form-control bg-light" name="bookPublicationDate" disabled>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <label class="form-label fw-bold">Actions</label>
                                <div class="d-grid gap-2 ms-1 d-block">
                                    <button value="<?= $data['book_id'] ?>" class="editBookButton btn btn-success"><span class="icon-pencil"></span></button>
                                    <button value="<?= $data['book_id'] ?>" class="deleteBookButton btn btn-danger"><span class="icon-trash"></span></button>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <p>Data could not be retrieved.</p>
                    <?php
                    }
                    ?>
                </div>
                <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#insertBooksModal"><span class="icon-plus-circle fs-3"></span></button>
                <div class="modal-footer mt-2 pb-0 px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="saveBooks" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Insert Book Modal -->
<div class="modal fade" id="insertBooksModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Insert Book</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertInsertBook" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageInsertBook" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="insertBookForm" class="row g-2">
                    <input type="hidden" name="insertBookUserID" value="<?= $user_id ?>">
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertBookTitle" class="form-label fw-bold">Book Title</label>
                        <input id="insertBookTitle" type="text" class="form-control bg-light" name="insertBookTitle" placeholder="Enter book title.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertBookAuthor" class="form-label fw-bold">Book Author(s)</label>
                        <input id="insertBookAuthor" type="text" class="form-control bg-light" name="insertBookAuthor" placeholder="Enter book author(s).">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="insertBookDescription" class="form-label fw-bold">Book Description</label>
                        <textarea id="insertBookDescription" name="insertBookDescription" type="text" class="form-control bg-light" style="height: 100px;"></textarea>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertBookLink" class="form-label fw-bold">Book Reference Link (Optional)</label>
                        <input id="insertBookLink" type="text" class="form-control bg-light" name="insertBookLink" placeholder="Enter book reference link.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertBookPublishDate" class="form-label fw-bold">Publication Date</label>
                        <input id="insertBookPublishDate" type="date" class="form-control bg-light" name="insertBookPublishDate">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyBooksModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Book Modal  -->
<div class="modal fade" id="editBooksModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Book</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditBook" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditBook" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editBookForm" class="row g-2">
                    <input type="hidden" id="editBookID" name="editBookID">
                    <div class="col-lg-6 col-sm-12">
                        <label for="editBookTitle" class="form-label fw-bold">Book Title</label>
                        <input id="editBookTitle" type="text" class="form-control bg-light" name="editBookTitle" placeholder="Enter book title.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="editBookAuthor" class="form-label fw-bold">Book Author(s)</label>
                        <input id="editBookAuthor" type="text" class="form-control bg-light" name="editBookAuthor" placeholder="Enter book author(s).">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="editBookDescription" class="form-label fw-bold">Book Description</label>
                        <textarea id="editBookDescription" name="editBookDescription" type="text" class="form-control bg-light" style="height: 100px;"></textarea>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="editBookLink" class="form-label fw-bold">Book Reference Link (Optional)</label>
                        <input id="editBookLink" type="text" class="form-control bg-light" name="editBookLink" placeholder="Enter book reference link.">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="editBookPublishDate" class="form-label fw-bold">Publication Date</label>
                        <input id="editBookPublishDate" type="date" class="form-control bg-light" name="editBookPublishDate">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyBooksModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Book Modal -->
<div class="modal fade" id="deleteBooksModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete Book</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeleteBook" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeleteBook" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deleteBookForm" class="row g-2">
                    <input type="hidden" id="deleteBookID" name="deleteBookID">
                    <p>Confirm deletion of <strong id="deleteBookTitle"></strong> published on <strong id="deleteBookPublishDate"></strong> by <strong id="deleteBookPublishAuthor"></strong>?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyBooksModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Publications Modals -->
<!-- Create Publication Modal -->
<div class="modal fade" id="createPublicationsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Create Publication</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertCreatePublication" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageCreatePublication" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="createPublicationForm" class="row g-2">
                    <input type="hidden" name="publicationUserID" value="<?= $user_id ?>">
                    <div class="col-lg-12 col-sm-12">
                        <label for="createPublicationTitle" class="form-label fw-bold">Publication Title</label>
                        <input id="createPublicationTitle" type="text" class="form-control bg-light" name="createPublicationTitle" placeholder="Enter publication title.">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="createPublicationDescription" class="form-label fw-bold">Publication Description</label>
                        <textarea id="createPublicationDescription" name="createPublicationDescription" type="text" class="form-control bg-light" style="height: 100px;"></textarea>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="createPublicationAuthor" class="form-label fw-bold">Publication Author(s)</label>
                        <input id="createPublicationAuthor" type="text" class="form-control bg-light" name="createPublicationAuthor" placeholder="Enter publication author(s).">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="createPublicationDate" class="form-label fw-bold">Publication Date</label>
                        <input id="createPublicationDate" type="date" class="form-control bg-light" name="createPublicationDate">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="createPublicationLink" class="form-label fw-bold">Publication Reference Link (Optional)</label>
                        <input id="createPublicationLink" type="text" class="form-control bg-light" name="createPublicationLink" placeholder="Enter publication reference link.">
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

<!-- Modify List of Publication Modal -->
<div class="modal fade" id="modifyPublicationsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Modify Publications</h1>
            </div>
            <div class="modal-body">
                <div id="displayPublications" class="row g-2">
                    <?php
                    $sql = "SELECT * FROM `selected_publications` WHERE `publication_user_id` = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $check_result = mysqli_num_rows($result) > 0;
                    if ($result) {
                        while ($data = mysqli_fetch_array($result)) {
                            $publication_date = new DateTime($data['publication_date']);
                    ?>
                            <div class="col-lg-12 col-sm-12">
                                <label for="publicationTitle" class="form-label fw-bold">Publication Title</label>
                                <input id="publicationTitle" value="<?= $data['publication_title'] ?>" type="text" class="form-control bg-light" name="publicationTitle" disabled>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <label for="publicationDescription" class="form-label fw-bold">Publication Description</label>
                                <textarea id="publicationDescription" name="publicationDescription" type="text" class="form-control bg-light" style="height: 100px;" disabled><?= $data['publication_description'] ?></textarea>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <label for="publicationAuthor" class="form-label fw-bold">Publication Author(s)</label>
                                <input id="publicationAuthor" value="<?= $data['publication_author'] ?>" type="text" class="form-control bg-light" name="publicationAuthor" disabled>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="publicationDate" class="form-label fw-bold">Publication Date</label>
                                <input id="publicationDate" value="<?= date_format($publication_date, "F, Y") ?>" type="text" class="form-control bg-light" name="publicationDate" disabled>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="publicationLink" class="form-label fw-bold">Publication Reference Link (Optional)</label>
                                <input id="publicationLink" value="<?= $data['publication_link'] ?>" type="text" class="form-control bg-light" name="publicationLink" disabled>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <label class="form-label fw-bold">Actions</label>
                                <div class="d-grid gap-2 ms-1 d-block">
                                    <button value="<?= $data['publication_id'] ?>" class="editPublicationButton btn btn-success"><span class="icon-pencil"></span></button>
                                    <button value="<?= $data['publication_id'] ?>" class="deletePublicationButton btn btn-danger"><span class="icon-trash"></span></button>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <p>Data could not be retrieved.</p>
                    <?php
                    }
                    ?>
                </div>
                <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#insertPublicationsModal"><span class="icon-plus-circle fs-3"></span></button>
                <div class="modal-footer mt-2 pb-0 px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="savePublications" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Insert Publication Modal -->
<div class="modal fade" id="insertPublicationsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Insert Publication</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertInsertPublication" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageInsertPublication" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="insertPublicationForm" class="row g-2">
                    <input type="hidden" name="insertPublicationUserID" value="<?= $user_id ?>">
                    <div class="col-lg-12 col-sm-12">
                        <label for="insertPublicationTitle" class="form-label fw-bold">Publication Title</label>
                        <input id="insertPublicationTitle" type="text" class="form-control bg-light" name="insertPublicationTitle" placeholder="Enter publication title.">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="insertPublicationDescription" class="form-label fw-bold">Publication Description</label>
                        <textarea id="insertPublicationDescription" name="insertPublicationDescription" type="text" class="form-control bg-light" style="height: 100px;"></textarea>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="insertPublicationAuthor" class="form-label fw-bold">Publication Author(s)</label>
                        <input id="insertPublicationAuthor" type="text" class="form-control bg-light" name="insertPublicationAuthor" placeholder="Enter publication author(s).">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertPublicationDate" class="form-label fw-bold">Publication Date</label>
                        <input id="insertPublicationDate" type="date" class="form-control bg-light" name="insertPublicationDate">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="insertPublicationLink" class="form-label fw-bold">Publication Reference Link (Optional)</label>
                        <input id="insertPublicationLink" type="text" class="form-control bg-light" name="insertPublicationLink" placeholder="Enter publication reference link.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyPublicationsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Publication Modal -->
<div class="modal fade" id="editPublicationsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Edit Publication</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert Message -->
                <div id="formAlertEditPublication" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageEditPublication" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="editPublicationForm" class="row g-2">
                    <input type="hidden" name="editPublicationID" id="editPublicationID">
                    <div class="col-lg-12 col-sm-12">
                        <label for="editPublicationTitle" class="form-label fw-bold">Publication Title</label>
                        <input id="editPublicationTitle" type="text" class="form-control bg-light" name="editPublicationTitle" placeholder="Enter publication title.">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="editPublicationDescription" class="form-label fw-bold">Publication Description</label>
                        <textarea id="editPublicationDescription" name="editPublicationDescription" type="text" class="form-control bg-light" style="height: 100px;"></textarea>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="editPublicationAuthor" class="form-label fw-bold">Publication Author(s)</label>
                        <input id="editPublicationAuthor" type="text" class="form-control bg-light" name="editPublicationAuthor" placeholder="Enter publication author(s).">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="editPublicationDate" class="form-label fw-bold">Publication Date</label>
                        <input id="editPublicationDate" type="date" class="form-control bg-light" name="editPublicationDate">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="editPublicationLink" class="form-label fw-bold">Publication Reference Link (Optional)</label>
                        <input id="editPublicationLink" type="text" class="form-control bg-light" name="editPublicationLink" placeholder="Enter publication reference link.">
                    </div>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyPublicationsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Publication Modal -->
<div class="modal fade" id="deletePublicationsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title w-100 text-center fs-5">Delete Publication</h1>
            </div>
            <div class="modal-body">
                <!-- Form Alert -->
                <div id="formAlertDeletePublication" class="toast w-100 my-2">
                    <div class="d-flex">
                        <div id="formAlertMessageDeletePublication" class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <form id="deletePublicationForm" class="row g-2">
                    <input type="hidden" id="deletePublicationID" name="deletePublicationID">
                    <p>Confirm deletion of <strong id="deletePublicationTitle"></strong> published on <strong id="deletePublicationDate"></strong> by <strong id="deletePublicationAuthor"></strong>?</p>
                    <div class="modal-footer mt-2 pb-0 px-0">
                        <button type="button" class="btn btn-secondary" data-bs-target="#modifyPublicationsModal" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>