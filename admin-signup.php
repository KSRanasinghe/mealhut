<?php
session_start();
if (isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Registration | MealHut - Delivery or Takeaway</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- /.DataTables -->
        <link rel="stylesheet" href="./css/adminStyle.css" />
        <link rel="stylesheet" href="./css/bootstrap.css" />
        <link rel="stylesheet" href="./css/alertify.css" />
        <link rel="icon" href="images/mealhut.png" />
    </head>

    <body class="hold-transition sidebar-mini sidebar-collapse bg-light">
        <div class="wrapper">
            <!-- header -->
            <?php require "adminheader.php"; ?>
            <!-- header -->

            <div class="content-wrapper">

                <!-- Admin header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 font-weight-bold text-capitalize">Admin Registration</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Admin header -->

                <!-- signup card -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body p-3">

                                        <div class="col-12">
                                            <div class="row mb-2">
                                                <div class="col-12 col-lg-4 mb-2">
                                                    <label class="form-label text-dark text-capitalize" style="font-size: 14px;">
                                                        first name<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" required style="font-size: 14px;" placeholder="First Name" id="fname" />
                                                </div>
                                                <div class="col-12 col-lg-4 mb-2">
                                                    <label class="form-label text-dark text-capitalize" style="font-size: 14px;">
                                                        last name<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" required style="font-size: 14px;" placeholder="Last Name" id="lname" />
                                                </div>
                                                <div class="col-12 col-lg-4 mb-2">
                                                    <label class="form-label text-dark text-capitalize" style="font-size: 14px;">
                                                        email<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" required style="font-size: 14px;" placeholder="example@gmail.com" id="email" />
                                                </div>
                                                <div class="col-12 col-lg-4 mb-2">
                                                    <label class="form-label text-dark" style="font-size: 14px;">
                                                        OTP<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control shadow-none" required style="font-size: 14px;" id="otp" placeholder="OTP" disabled />
                                                </div>
                                                <div class="col-12 col-lg-4 mb-2 mt-2 mt-lg-4 pt-lg-2">
                                                    <button class="btn btn-danger shadow-none col-12" onclick="otp();" id="otpbtn">Generate OTP</button>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-12 col-lg-4 mb-2">
                                                    <label class="form-label text-dark text-capitalize" style="font-size: 14px;">
                                                        admin type<span class="text-danger">*</span>
                                                    </label>
                                                    <select class="form-select text-capitalize shadow-none" id="utype" disabled>
                                                        <option disabled selected value="0">select admin type</option>
                                                        <?php
                                                        $ut_rs = Database::search("SELECT * FROM `user_type`");
                                                        $ut_num = $ut_rs->num_rows;

                                                        if ($ut_num > 0) {
                                                            for ($i = 0; $i < $ut_num; $i++) {
                                                                $ut_data = $ut_rs->fetch_assoc();
                                                        ?>
                                                                <option value="<?php echo $ut_data["id"]; ?>"><?php echo $ut_data["name"]; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-lg-4 mb-2">
                                                    <label class="form-label text-dark text-capitalize" style="font-size: 14px;">
                                                        password<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="password" class="form-control shadow-none" required style="font-size: 14px;" id="pswd" disabled />
                                                    <div id="passwordHelpBlock" class="form-text d-block d-lg-none" style="font-size: 13px;">
                                                        Your password must be 8-20 characters long, contain at least one uppercase,one lowercase, one number and one symbol (like $@_), and must not contain spaces or emoji.
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4 mb-2">
                                                    <label class="form-label text-dark text-capitalize" style="font-size: 14px;">
                                                        confirm password<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="password" class="form-control shadow-none" required style="font-size: 14px;" id="repswd" disabled />
                                                </div>
                                            </div>

                                            <div class="row mb-0 mb-lg-2">
                                                <div class="col-4 mb-2 align-self-start d-none d-lg-block"></div>
                                                <div class="col-8 mb-2 align-self-end d-none d-lg-block">
                                                    <div class="form-text" style="font-size: 13px;">
                                                        Your password must be 8-20 characters long, contain at least one uppercase,one lowercase, one number and one symbol (like $@_), and must not contain spaces or emoji.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-12 col-lg-4 mb-2 mt-lg-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input shadow-none" type="radio" name="flexRadioDefault" id="uname" checked>
                                                        <label class="form-check-label text-dark" for="uname" style="font-size: 14px;">
                                                            Use your email as your username.
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-8 mb-2">
                                                    <button class="btn btn-success shadow-none mt-1 mb-3 col-12" id="regbtn" onclick="register();" disabled>
                                                        Register
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- signup card -->

                <!-- Admins table header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 font-weight-bold text-capitalize">MealHut Admins</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Admins table header -->

                <!-- table card -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fist Name</th>
                                                    <th>Last Name</th>
                                                    <th>User Type</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $user_rs = Database::search("SELECT
                                            `user`.id AS `uid`,
                                            `user`.fname,
                                            `user`.lname,
                                            `user`.email,
                                            `user`.`password`,
                                            user_type.`name` AS utype,
                                            `status`.`name` AS `status` 
                                        FROM
                                            `user`
                                            INNER JOIN user_type ON `user`.user_type_id = user_type.id
                                            INNER JOIN `status` ON `user`.status_id = `status`.id");
                                                $user_num = $user_rs->num_rows;

                                                if ($user_num > 0) {
                                                    for ($i = 0; $i < $user_num; $i++) {
                                                        $user_data = $user_rs->fetch_assoc();
                                                ?>
                                                        <tr>
                                                            <td><?php echo $user_data["uid"]; ?></td>
                                                            <td><?php echo $user_data["fname"]; ?></td>
                                                            <td><?php echo $user_data["lname"]; ?></td>
                                                            <td><?php echo $user_data["utype"]; ?></td>
                                                            <td><?php echo $user_data["email"]; ?></td>
                                                            <td><?php echo $user_data["password"]; ?></td>
                                                            <td><?php echo $user_data["status"]; ?></td>
                                                            <td>
                                                                <div class="row px-3">
                                                                    <button class="btn btn-danger shadow-none text-capitalize col-12" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Change Status" onclick="status('<?php echo $user_data['uid']; ?>');">
                                                                        <i class="bi bi-arrow-repeat"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fist Name</th>
                                                    <th>Last Name</th>
                                                    <th>User Type</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- table card -->

            </div>

            <!-- footer -->
            <footer class="main-footer">
                <p class="text-center text-dark d-none d-lg-block" style="font-size: 14px; margin-bottom: -0.5%;">
                    Copyright &copy; MealHut &trade;. All rights reserved. The MealHut name, logos, and related marks are trademarks of MealHut, Inc.
                </p>
                <p class="text-center text-dark d-block d-lg-none" style="font-size: 14px;margin-bottom: -0.5%;">
                    Copyright &copy; MealHut Sri Lanka.
                </p>
            </footer>
            <!-- footer -->
        </div>

        <script src="scripts/adminEntrance.js"></script>
        <script src="scripts/bootstrap.bundle.js"></script>
        <script src="scripts/alertify.js"></script>
        <!-- tooltip -->
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="plugins/jszip/jszip.min.js"></script>
        <script src="plugins/pdfmake/pdfmake.min.js"></script>
        <script src="plugins/pdfmake/vfs_fonts.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- Page specific script -->
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        window.location = "admin-entrance.php";
    </script>
<?php
}
?>