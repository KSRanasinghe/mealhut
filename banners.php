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
        <title>Add Promotion Banner | MealHut - Delivery or Takeaway</title>
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

                <!-- promotion banner header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 font-weight-bold text-capitalize">promotion banners</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- promotion banner header -->

                <!-- promotion banner btn -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2 mt-3 pt-1">
                            <div class="col-sm-6">
                                <button class="btn btn-success shadow-none text-capitalize" onclick="addBanner(4);">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    add promotion banner
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- promotion banner btn -->

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
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Created / Updated by</th>
                                                    <th>Date / Time</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $banner_rs = Database::search("SELECT
                                            banner.id,
                                            banner.title,
                                            banner.description,
                                            banner.img,
                                            banner.datetime,
                                            `user`.fname,
                                            `user`.lname,
                                            `status`.`name` 
                                        FROM
                                            banner
                                            INNER JOIN `user` ON banner.user_id = `user`.id
                                            INNER JOIN `status` ON banner.status_id = `status`.id");

                                                $banner_num = $banner_rs->num_rows;

                                                if ($banner_num > 0) {
                                                    for ($i = 0; $i < $banner_num; $i++) {
                                                        $banner_data = $banner_rs->fetch_assoc();
                                                ?>
                                                        <tr>
                                                            <td><?php echo $banner_data["id"]; ?></td>
                                                            <td>
                                                                <div class="image">
                                                                    <img src='<?php echo $banner_data["img"]; ?>' class="img-fluid" style="width: 100px;" />
                                                                </div>
                                                            </td>
                                                            <td id="title<?php echo $banner_data["id"]; ?>"><?php echo $banner_data["title"]; ?></td>
                                                            <td id="desc<?php echo $banner_data["id"]; ?>"><?php echo $banner_data["description"]; ?></td>
                                                            <td><?php echo $banner_data["fname"] . " " . $banner_data["lname"]; ?></td>
                                                            <td><?php echo $banner_data["datetime"]; ?></td>
                                                            <td><?php echo $banner_data["name"]; ?></td>
                                                            <td>
                                                                <div class="row d-block g-2 p-2">
                                                                    <button class="btn btn-light border border-1 border-secondary shadow-none" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit Banner" onclick="edit('<?php echo $banner_data['id']; ?>');">
                                                                        <i class="bi bi-pen"></i>
                                                                    </button>
                                                                    <button class="btn btn-danger shadow-none" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Change Status" onclick="status('<?php echo $banner_data['id']; ?>');">
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
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Created / Updated by</th>
                                                    <th>Date / Time</th>
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

                <!-- modal -->
                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-uppercase" id="exampleModalLabel">add new promotion banner</h5>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="title" class="col-form-label">Title<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="title" required />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="desc" class="col-form-label">
                                                    Description<span class="text-danger">*</span></label>
                                                </label>
                                                <div class="form-floating">
                                                    <textarea class="form-control shadow-none" id="desc" style="height: 114px" aria-describedby="d"></textarea>
                                                    <div id="d" class="form-text" style="font-size: 13px;">
                                                        Add a short description of 100 characters.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="img" class="col-form-label">
                                                    Image<span class="text-danger">*</span></label>
                                                </label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control shadow-none" id="img" aria-describedby="i" />
                                                </div>
                                                <div id="i" class="form-text" style="font-size: 13px;">
                                                    Add an 600 &Cross; 600 image (jpg/ jpeg/ png/ svg) for propper outcome.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success shadow-none" onclick="add();">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

                <!-- edit modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-uppercase" id="exampleModalLabel">edit promotion banner</h5>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="etitle" class="col-form-label">
                                                    Title<span class="text-danger">*</span></label>
                                                </label>
                                                <input type="text" class="form-control" id="etitle" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="edesc" class="col-form-label">
                                                    Description<span class="text-danger">*</span></label>
                                                </label>
                                                <div class="form-floating">
                                                    <textarea class="form-control shadow-none" id="edesc" style="height: 114px" aria-describedby="d"></textarea>
                                                    <div id="ed" class="form-text" style="font-size: 13px;">
                                                        Add a short description of 100 characters (including spaces).
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="eimg" class="col-form-label">
                                                    Image<span class="text-danger">*</span></label>
                                                </label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control shadow-none" id="eimg" aria-describedby="ei" />
                                                </div>
                                                <div id="ei" class="form-text" style="font-size: 13px;">
                                                    Add an 600 &Cross; 600 image (jpg/ jpeg/ png/ svg) for propper outcome.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-none">
                                            <div class="mb-2">
                                                <input type="text" class="form-control" id="eid" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success shadow-none" onclick="update();">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- edit modal -->

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

        <script src="scripts/banners.js"></script>
        <script src="scripts/bootstrap.bundle.js"></script>
        <script src="scripts/alertify.js"></script>
        <!-- tooltip -->
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
        <!-- editModal -->
        <script>
            function edit(id) {
                var title = $('#title' + id).text();
                var desc = $('#desc' + id).text();
                $('#editModal').modal('show'); //load modal
                $('#eid').val(id);
                $('#etitle').val(title);
                $('#edesc').val(desc);
            }
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