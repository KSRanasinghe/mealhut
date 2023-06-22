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
        <title>Ada Category | MealHut - Delivery or Takeaway</title>
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

                <!-- category header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 font-weight-bold text-capitalize">category</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- category header -->

                <!-- categoery btn -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2 mt-3 pt-1">
                            <div class="col-sm-6">
                                <button class="btn btn-success shadow-none text-capitalize" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    add category
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- categoery btn -->

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
                                                    <th>Category</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $category_rs = Database::search("SELECT * FROM `category`");
                                                $category_num = $category_rs->num_rows;
                                                if ($category_num > 0) {
                                                    for ($i = 0; $i < $category_num; $i++) {
                                                        $category_data = $category_rs->fetch_assoc();
                                                ?>
                                                        <tr>
                                                            <td><?php echo $category_data["id"]; ?></td>
                                                            <td id="name<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></td>
                                                            <td>
                                                                <div class="row justify-content-center">
                                                                    <div class="offset-lg-3 col-lg-6">
                                                                        <button class="btn btn-light border border-1 border-secondary shadow-none text-capitalize col-12 col-lg-auto" onclick="edit('<?php echo $category_data['id']; ?>');">
                                                                            <i class="bi bi-pen me-2"></i>
                                                                            <span class="d-none d-lg-inline">Edit Category</span>
                                                                        </button>
                                                                    </div>
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
                                                    <th>Category</th>
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
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-uppercase" id="exampleModalLabel">add new category</h5>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="cname" class="col-form-label">Category<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="cname" placeholder="Ex: Rice" />
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success shadow-none" onclick="addCategory();">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

                <!--edit modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-uppercase" id="editModalLabel">edit category</h5>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-12 col-lg-3">
                                            <div class="mb-3">
                                                <label for="ecid" class="col-form-label">Category Id<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ecid" placeholder="Ex: Rice" readonly />
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-9">
                                            <div class="mb-3">
                                                <label for="ecname" class="col-form-label">Category<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ecname" placeholder="Ex: Rice" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success shadow-none" onclick="editCategory();">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--edit modal -->

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

        <script src="scripts/category.js"></script>
        <script src="scripts/bootstrap.bundle.js"></script>
        <script src="scripts/alertify.js"></script>
        <!-- edit model -->
        <script>
            function edit(id) {
                var cid = id;
                var name = $('#name' + id).text();
                $('#editModal').modal('show'); //load modal
                $('#ecid').val(cid);
                $('#ecname').val(name);
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