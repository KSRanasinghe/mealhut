<?php require "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback | Order Meal Online - Delivery or Takeaway</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/alertify.css" />
    <link rel="icon" href="images/mealhut.png" />
</head>

<body class="banner-signin">

    <!-- banner -->
    <div class="container-fluid">
        <?php require "header.php"; ?>
        <div class="row mx-auto">

            <div class="col-12 offset-lg-2 col-lg-8">
                <div class="row">

                    <!-- Card -->
                    <div class="card shadow custome-card-2">
                        <div class="card-body">

                            <div class="col-12 mt-3 pb-1">
                                <h4 class="card-title text-uppercase fw-semibold text-dark text-center">feedback</h4>
                                <hr class="col-12" />
                            </div>

                            <div class="col-12 justify-content-center">
                                <div class="row">

                                    <div class="col-12 col-md-6">
                                        <div class=" col-12 pb-3">
                                            <div class="row">
                                                <div class="offset-0 col-4 pb-3">
                                                    <label class="form-label fw-light text-black fs-6">
                                                        Title <span class="text-danger">*</span></label>
                                                    <select class="form-select shadow-none" style="height: 35px; font-size: 14px;" required id="title">
                                                        <option value="0" selected disabled></option>
                                                        <?php
                                                        $title_rs = Database::search("SELECT * FROM `title`");
                                                        $title_num = $title_rs->num_rows;

                                                        for ($i = 0; $i < $title_num; $i++) {
                                                            $title_data = $title_rs->fetch_assoc();
                                                        ?>
                                                            <option value='<?php echo $title_data["id"]; ?>'><?php echo $title_data["name"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="offset-0 col-8 pb-3">
                                                    <label class="form-label fw-light text-black fs-6">
                                                        First Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control shadow-none" placeholder="First Name" required style="font-size: 14px;" id="fname" />
                                                </div>
                                                <div class="offset-0 col-12 pb-3">
                                                    <label class="form-label fw-light text-black fs-6">
                                                        Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control shadow-none" placeholder="Last Name" required style="font-size: 14px;" id="lname" />
                                                </div>
                                                <div class="offset-0 col-12 pb-3">
                                                    <label class="form-label fw-light text-black fs-6">
                                                        Email <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control shadow-none" placeholder="example@gmail.com" required style="font-size: 14px;" id="email" />
                                                </div>
                                                <div class="offset-0 col-12 pb-3">
                                                    <label class="form-label fw-light text-black fs-6">
                                                        Confirm Email <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control shadow-none" placeholder="example@gmail.com" required style="font-size: 14px;" id="cemail" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class=" col-12 pb-3">
                                            <div class="row">
                                                <div class="offset-0 col-12 pb-3">
                                                    <label class="form-label fw-light text-black fs-6">
                                                        Inquiry Type <span class="text-danger">*</span></label>
                                                    <select class="form-select shadow-none" style="height: 35px; font-size: 14px;" required id="inq">
                                                        <option value="0" selected disabled></option>
                                                        <?php
                                                        $inquiry_type_rs = Database::search("SELECT * FROM `inquiry_type`");
                                                        $inquiry_type_num = $inquiry_type_rs->num_rows;

                                                        for ($i = 0; $i < $inquiry_type_num; $i++) {
                                                            $inquiry_type_data = $inquiry_type_rs->fetch_assoc();
                                                        ?>
                                                            <option value='<?php echo $inquiry_type_data["id"]; ?>'>
                                                                <?php echo $inquiry_type_data["name"]; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="offset-0 col-12 pb-3">
                                                    <div class="row">
                                                        <div class="offset-0 col-3">
                                                            <label class="form-label fw-light text-black fs-6">
                                                                Code <span class="text-danger">*</span></label>
                                                            <input type="text" value="+94" class="form-control shadow-none" readonly style="font-size: 14px;" />
                                                        </div>
                                                        <div class="offset-0 col-9">
                                                            <label class="form-label fw-light text-black fs-6">
                                                                Phone No <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control shadow-none" required style="font-size: 14px;" pattern="[1-9]{9}" placeholder="Mobile (Ex: 777123456)" id="mobile" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="offset-0 col-12 pb-3">
                                                    <label class="form-label fw-light text-black fs-6">
                                                        Message <span class="text-danger">*</span></label>
                                                    <div class="form-floating">
                                                        <textarea class="form-control shadow-none" id="msg" style="height: 114px"></textarea>
                                                        <label for="msg">Message</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <button class="btn btn-success mb-3 shadow-none" onclick="send();">
                                                <i class="bi bi-send me-2"></i>
                                                Send</button>
                                            <div class="col-12" id="orBtn">
                                                <div class="row">
                                                    <div class="offset-2 col-8">
                                                        <div class="row mb-3">
                                                            <div class="col-4">
                                                                <hr />
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="row">
                                                                    <span class="text-black fw-light fs-5 text-uppercase text-center">or</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <hr />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-secondary shadow-none" onclick="changeView();">
                                                        <i class="bi bi-headset me-2"></i>
                                                        Hotline</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Card -->

                    <!-- hotline card -->
                    <div class="card shadow d-none custome-card-3" id="hotline">
                        <div class="card-body">

                            <div class="col-12 mt-3 pb-1">
                                <h4 class="card-title text-uppercase fw-semibold text-dark text-center">hotline</h4>
                                <hr class="col-12" />
                            </div>

                            <div class="col-12 justify-content-center mb-3">
                                <div class="row">
                                    <span class="fs-4 fw-bold text-dark text-center">
                                        <i class="bi bi-telephone-forward me-3"></i>
                                        011 2334 587</span>
                                    <span class="fs-4 fw-bold text-dark text-center">
                                        <i class="bi bi-telephone-forward me-3"></i>
                                        011 2334 588</span>
                                    <span class="fs-4 fw-bold text-dark text-center">
                                        <i class="bi bi-telephone-forward me-3"></i>
                                        011 2334 589</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <button class="btn btn-danger shadow-none" onclick="changeView();">Don't Show</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- hotline card -->

                </div>
            </div>

        </div>
    </div>
    <!-- banner -->

    <!-- footer -->
    <?php
    require "footer.php";
    ?>
    <!-- footer -->

    <script src="scripts/script.js"></script>
    <script src="scripts/feedback.js"></script>
    <script src="scripts/bootstrap.bundle.js"></script>
    <script src="scripts/alertify.js"></script>
</body>

</html>