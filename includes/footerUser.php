<footer id="footer">
    <div class="container-fluid">
        <div class="row justify-contents-center bg-primary pt-3">
            <div class="col-lg-3 col-md-12 col-sm-12 p-3 text-center align-self-center">
                <img src="./assets/images/PUP-Logo.png" alt="" style="height: fit-content; width:150px;">
            </div>
            <div class="col-lg-3 text-white col-md-12 col-sm-12 p-3 text-dark text-center text-lg-start">
                <h5 class="fw-bold fs-5">
                    Polytechnic University of the Philippines
                </h5>
                <p>All content is in the public domain unless otherwise stated.</p>
            </div>
            <div class="col-lg-3 text-white col-md-12 col-sm-12 p-3 text-center text-lg-start">
                <h5 class="fw-bold fs-5">Connect with us</h5>
                <a href="" class="link-light"><i class="bi bi-facebook me-2"></i>/PUPlinkonFacebook</a><br>
                <a href="" class="link-light"><i class="bi bi-envelope-at-fill me-2"></i>PUPmain@gmail.com</a><br>
                <a href="" class="link-light"><i class="bi bi-telephone-fill me-2"></i>123-4567-890</a><br>
            </div>
            <p class="text-center text-muted fs-5">
                Copyright © 2023 The Proponents
            </p>
        </div>

    </div>

</footer>
<!-- Custom Scripts -->
<script src="./modules/jquery-3.1.1.min.js"></script>
<script src="./modules/bootstrap.bundle.min.js"></script>
<script src="./modules/main.js"></script>
<!-- Datatables -->
<script src="./admin/datatables/datatables.min.js"></script>
<?php
    if ($page_title == "Home" || $page_title == "Update Password") {
    ?>
        <script>
            $('#footer').remove();
            $('#backgroundImage').removeClass('d-none');
        </script>
    <?php
    }
?>
</body>

</html>