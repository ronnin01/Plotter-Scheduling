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
    <title>Document</title>
</head>
<body class="bg-gray" id="print-page">

    <!-- MODALS -->
    <?php include_once("../modals/modals.php") ?>

    <div class="my-2 toast-container position-fixed top-0 start-50 translate-middle-x" id="alert-messages"></div>
    <div class="container-fluid p-0 d-flex" style="overflow-x: hidden;">
        <?php include_once("../components/sidebar.php") ?>
        <div class="position-relative" id="print-content" style="width: 100%;">

            <?php include_once("../components/navbar.php") ?>

            <div class="row g-2 px-3 my-1">
                <div class="col-12 col-lg-4">
                    <div class="card rounded-0 border-0">
                        <div class="card-header">
                            <strong>Filter Print</strong>
                        </div>
                        <div class="card-body">
                            <form id="filter-print-form">
                                <div class="my-2">
                                    <label class="form-label">Select Department</label>
                                    <select name="print_select_department" id="print-select-department" class="form-select rounded-0 shadow-none">
                                        <option value="">Select Department</option>
                                    </select>
                                </div>
                                <div class="my-2">
                                    <label class="form-label">Select Semester</label>
                                    <select name="print_select_semester" id="print-select-semester" class="form-select rounded-0 shadow-none">
                                        <option value="">Select Semester</option>
                                        <option value="1st Semester">1st Semester</option>
                                        <option value="2nd Semester">2nd Semester</option>
                                    </select>
                                </div>
                                <div class="my-2">
                                    <label class="form-label">Select School Year</label>
                                    <select name="print_select_school_year" id="print-select-school-year" class="form-select rounded-0 shadow-none">
                                        <option value="">Select School Year</option>
                                    </select>
                                </div>
                                <div class="my-2">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Upload Header</label>
                                            <input type="file" class="form-control shadow-none rounded-0">
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Upload Footer</label>
                                            <input type="file" class="form-control shadow-none rounded-0">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card rounded-0 border-0">
                        <div class="card-header">
                            <strong>Print</strong>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active rounded-0" id="section-tab" data-bs-toggle="tab" data-bs-target="#section-tab-pane" type="button" role="tab" aria-controls="section-tab-pane" aria-selected="true">Section</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-0" id="teacher-tab" data-bs-toggle="tab" data-bs-target="#teacher-tab-pane" type="button" role="tab" aria-controls="teacher-tab-pane" aria-selected="false">Teacher</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-0" id="room-tab" data-bs-toggle="tab" data-bs-target="#room-tab-pane" type="button" role="tab" aria-controls="room-tab-pane" aria-selected="false">Room</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="section-tab-pane" role="tabpanel" aria-labelledby="section-tab" tabindex="0">
                                    <div class="my-3 row justify-content-between">
                                        <div class="col-4 d-flex">
                                            <select class="form-select shadow-none rounded-0" id="print-select-section">
                                                <option value="">Select Section</option>
                                            </select>
                                            <button class="btn btn-success shadow-none rounded-0 mx-3" id="print-section">
                                                <i class="bi bi-printer"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="my-2" id="print-timetable">
                                        <div class="my-2" id="print-section-timetable"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="teacher-tab-pane" role="tabpanel" aria-labelledby="teacher-tab" tabindex="0">
                                    <div class="my-3 row justify-content-between">
                                        <div class="col-4 d-flex">
                                            <select class="form-select shadow-none rounded-0" id="print-select-teacher">
                                                <option value="">Select Teacher</option>
                                            </select>
                                            <button class="btn btn-success shadow-none rounded-0 mx-3" id="print-teacher">
                                                <i class="bi bi-printer"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="my-2" id="print-timetable">
                                        <div class="my-2" id="print-teacher-timetable"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="room-tab-pane" role="tabpanel" aria-labelledby="room-tab" tabindex="0">
                                    <div class="my-3 row justify-content-between">
                                        <div class="col-4 d-flex">
                                            <select class="form-select shadow-none rounded-0" id="print-select-room">
                                                <option value="">Select Room</option>
                                            </select>
                                            <button class="btn btn-success shadow-none rounded-0 mx-3" id="print-room">
                                                <i class="bi bi-printer"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="my-2" id="print-timetable">
                                        <div class="my-2" id="print-room-timetable"></div>
                                    </div>
                                </div>
                            </div>
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
    <script src="../js/index.js?<?php echo time(); ?>"></script>
</body>
</html>