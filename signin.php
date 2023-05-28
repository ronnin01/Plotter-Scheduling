<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP CSS LINK -->
    <link rel="stylesheet" href="css/main.min.css">
    <!-- BOOTSTRAP ICON LINK -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body class="bg-dark">
    <div class="my-2 toast-container position-fixed top-0 start-50 translate-middle-x" id="login-message"></div>
    <div class="container-fluid">
        <div class="vh-100 row justify-content-center align-items-center">
            <div class="col-xl-3 col-lg-4">
                <div class="card shadow rounded-0">
                    <div class="card-body">
                        <div class="my-2 text-start">
                            <h2>Login</h2>
                        </div>
                        <div class="my-3">
                            <form id="login-form">
                                <div class="my-2">
                                    <label class="form-label">Username</label>
                                    <input type="text" required class="form-control shadow-none rounded-0" placeholder="Username" name="username">
                                </div>
                                <div class="my-2">
                                    <label class="form-label">Password</label>
                                    <input type="password" required class="form-control shadow-none rounded-0" placeholder="Password" name="password">
                                </div>
                                <div class="my-4 d-grid">
                                    <button type="submit" class="btn btn-primary shadow-none rounded-0" id="form-login-btn">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- BOOTSTRAP JS LINK -->
    <script src="js/bootstrap.min.js"></script>
    <!-- JQUERY JS LINK -->
    <script src="js/jquery-3.6.4.min.js"></script>
    <!-- SCRIPT -->
    <script src="js/index.js?<?php echo time(); ?>"></script>
</body>
</html>