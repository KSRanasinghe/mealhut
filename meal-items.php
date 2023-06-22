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
        <title>Add Meal Items | MealHut - Delivery or Takeaway</title>
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

                <!-- meal item header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 font-weight-bold text-capitalize">Meal items</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- meal item header -->

                <!-- meal item btn -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2 mt-3 pt-1">
                            <div class="col-sm-6">
                                <button class="btn btn-success shadow-none text-capitalize" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    add meal item
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- meal item btn -->

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
                                                    <th>Meal</th>
                                                    <th>Category</th>
                                                    <th>Description</th>
                                                    <th>Meal Type</th>
                                                    <th>Price(Rs.)</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $meal_rs = Database::search("SELECT
                                            meal_details.id AS mdid,
                                            meal_details.price,
                                            meal_type.`name` AS mealtype,
                                            product.`name` AS product,
                                            product.description,
                                            category.`name` AS category,
                                            `status`.`name` AS `status`,
                                            images.`code` 
                                        FROM
                                            meal_details
                                            INNER JOIN meal_type ON meal_details.meal_type_id = meal_type.id
                                            INNER JOIN product ON meal_details.product_id = product.id
                                            INNER JOIN category ON product.category_id = category.id
                                            INNER JOIN `status` ON meal_details.status_id = `status`.id
                                            INNER JOIN images ON meal_details.id = images.meal_details_id");

                                                $meal_num = $meal_rs->num_rows;
                                                if ($meal_num > 0) {
                                                    for ($i = 0; $i < $meal_num; $i++) {
                                                        $meal_data = $meal_rs->fetch_assoc();
                                                ?>
                                                        <tr>
                                                            <td><?php echo $meal_data["mdid"]; ?></td>
                                                            <td>
                                                                <div class="image">
                                                                    <img src='<?php echo $meal_data["code"]; ?>' class="img-fluid" style="width: 100px;" />
                                                                </div>
                                                            </td>
                                                            <td id="product<?php echo $meal_data["mdid"]; ?>"><?php echo $meal_data["product"]; ?></td>
                                                            <td id="category<?php echo $meal_data["mdid"]; ?>"><?php echo $meal_data["category"]; ?></td>
                                                            <td id="desc<?php echo $meal_data["mdid"]; ?>"><?php echo $meal_data["description"]; ?></td>
                                                            <td id="mealtype<?php echo $meal_data["mdid"]; ?>"><?php echo $meal_data["mealtype"]; ?></td>
                                                            <td id="price<?php echo $meal_data["mdid"]; ?>"><?php echo $meal_data["price"]; ?>.0</td>
                                                            <td><?php echo $meal_data["status"]; ?></td>
                                                            <td>
                                                                <div class="row d-block g-2 p-2">
                                                                    <button class="btn btn-light border border-1 border-secondary shadow-none" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit Meal" onclick="edit('<?php echo $meal_data['mdid']; ?>');">
                                                                        <i class="bi bi-pen"></i>
                                                                    </button>
                                                                    <button class="btn btn-danger shadow-none" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Change Status" onclick="status('<?php echo $meal_data['mdid']; ?>');">
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
                                                    <th>Meal</th>
                                                    <th>Category</th>
                                                    <th>Description</th>
                                                    <th>Meal Type</th>
                                                    <th>Price(Rs)</th>
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
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-uppercase" id="exampleModalLabel">add new meal</h5>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <div class="mb-2">
                                                <label for="category" class="col-form-label">
                                                    Category<span class="text-danger">*</span></label>
                                                </label>
                                                <select class="form-select shadow-none" aria-label="Default select example" id="category">
                                                    <option selected disabled value="0">Selcet Category</option>
                                                    <?php
                                                    $category_rs = Database::search("SELECT * FROM `category`");
                                                    $category_num = $category_rs->num_rows;
                                                    if ($category_num > 0) {
                                                        for ($i = 0; $i < $category_num; $i++) {
                                                            $category_data = $category_rs->fetch_assoc();
                                                    ?>
                                                            <option value='<?php echo $category_data["id"]; ?>'><?php echo $category_data["name"]; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="mb-2">
                                                <label for="mtype" class="col-form-label">
                                                    Meal Type<span class="text-danger">*</span></label>
                                                </label>
                                                <select class="form-select shadow-none" aria-label="Default select example" id="mtype">
                                                    <option selected disabled value="0">Selcet Meal Type</option>
                                                    <?php
                                                    $mealtype_rs = Database::search("SELECT * FROM `meal_type`");
                                                    $mealtype_num = $mealtype_rs->num_rows;
                                                    if ($mealtype_num > 0) {
                                                        for ($i = 0; $i < $mealtype_num; $i++) {
                                                            $mealtype_data = $mealtype_rs->fetch_assoc();
                                                    ?>
                                                            <option value='<?php echo $mealtype_data["id"]; ?>'><?php echo $mealtype_data["name"]; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="mname" class="col-form-label">
                                                    Meal<span class="text-danger">*</span></label>
                                                </label>
                                                <input type="text" class="form-control" id="mname" placeholder="Ex: Fried Rice" required />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="price" class="col-form-label">Price<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="price" required />
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
                                                        Add a short description of 60 characters (including spaces).
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
                                <h5 class="modal-title text-uppercase" id="exampleModalLabel">edit meal</h5>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <div class="mb-2">
                                                <label for="ecategory" class="col-form-label">
                                                    Category<span class="text-danger">*</span></label>
                                                </label>
                                                <input type="text" class="form-control" id="ecategory" readonly />
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <div class="mb-2">
                                                <label for="emtype" class="col-form-label">
                                                    Meal Type<span class="text-danger">*</span></label>
                                                </label>
                                                <input type="text" class="form-control" id="emtype" readonly />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="emname" class="col-form-label">
                                                    Meal<span class="text-danger">*</span></label>
                                                </label>
                                                <input type="text" class="form-control" id="emname" readonly />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="eprice" class="col-form-label">Price<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="eprice" required />
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
                                                        Add a short description of 60 characters (including spaces).
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
                                                <input type="text" class="form-control" id="emid" />
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

        <script src="scripts/meals.js"></script>
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
                var product = $('#product' + id).text();
                var category = $('#category' + id).text();
                var desc = $('#desc' + id).text();
                var mealtype = $('#mealtype' + id).text();
                var price = $('#price' + id).text();
                $('#editModal').modal('show'); //load modal
                $('#emid').val(id);
                $('#ecategory').val(category);
                $('#emname').val(product);
                $('#emtype').val(mealtype);
                $('#eprice').val(price);
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