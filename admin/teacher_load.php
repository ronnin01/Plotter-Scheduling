<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS LINK -->
    <link rel="stylesheet" href="../css/style.css?<?php echo time();?>">
    <!-- BOOTSTRAP CSS LINK -->
    <link rel="stylesheet" href="../css/main.min.css">
    <!-- BOOTSTRAP ICON LINK -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/datatables.min.css">
    <title>Document</title>
</head>
<body>

    <!-- MODALS -->
    <?php include_once("../modals/modals.php") ?>

    <div class="my-2 toast-container position-fixed top-0 start-50 translate-middle-x" id="alert-messages"></div>
    <div class="container-fluid p-0 d-flex" style="overflow-x: hidden;">
        <?php include_once("../components/sidebar.php") ?>
        <div class="position-relative" id="plot-content" style=" width: 100%;">

            <?php include_once("../components/navbar.php") ?>

            <div class="row g-2 px-3 my-2">
                <div class="col-lg-4 col-12">
                    <div class="card shadow-sm rounded-0 border-0">
                        <div class="card-header">
                            <strong>Teacher's Load</strong>
                        </div>
                        <div class="card-body">
                            <div class="my-2">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">Select Department</label>
                                        <select name="" id="teacher-load-select-department" class="form-select rounded-0 shadow-none">
                                            <option value="" selected>Select Department</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">Select Semester</label>
                                        <select name="" id="teacher-load-select-semester" class="form-select rounded-0 shadow-none">
                                            <option value="" selected>Select Semester</option>
                                            <option value="1st Semester">1st Semester</option>
                                            <option value="2nd Semester">2nd Semester</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">Select School Year</label>
                                        <select name="" id="teacher-load-select-school-year" class="form-select rounded-0 shadow-none">
                                            <option value="" selected>Select School Year</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">Select Teacher</label>
                                        <select name="" id="teacher-load-select-teacher" class="form-select rounded-0 shadow-none">
                                            <option value="" selected>Select Teacher</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="card shadow-sm rounded-0 border-0">
                        <div class="card-header">
                            <strong>Teacher's Load Data</strong>
                        </div>
                        <div class="card-body">
                            <div class="my-2" id="teacher-load-data"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- BOOTSTRAP JS LINK -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- JQUERY JS LINK -->
    <script src="../js/jquery-3.6.4.min.js"></script>
    <!-- SCRIPT -->
    <script src="../js/datatables.min.js?<?php echo time(); ?>"></script>
    <script src="../js/index.js?<?php echo time(); ?>"></script>
</body>
</html>