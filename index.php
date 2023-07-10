<?php
session_start();
$uname = "Sign In";
if (session_status() === PHP_SESSION_ACTIVE) {
    if (isset($_SESSION['uname'])) {
        $uname = $_SESSION['uname'];
    }
}
if (isset($_POST['logout-bt'])) {
    session_destroy();
    header('location:index.php');
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>laika</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .navbar-nav li a,
        .navbar-nav li form input,
        .navbar-brand {
            font-size: 19px;

        }

        .navbar-nav li a:hover {
            border: 1.5px solid white;
            transition: border 0.2s ease;
        }

        .navbar-nav li,
        .navbar-nav li form input {
            margin-right: 10px;
        }

        .navbar-nav li form input {
            margin-left: 10px
        }

        .nav-item .d-flex:hover,
        #deliver:hover,
        #signin:hover,
        #logout:hover {
            border: 1.5px solid white;
            transition: border 0.2s ease;
        }

        .nav-item .d-flex {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 2px;
        }

        #deliver,
        #signin,
        #cart {
            border-radius: 11px;
            padding: 11px;
        }



        #logout {
            font-size: small;
            color: lightgray;
            border-radius: 5px;
            background-color: rgb(40, 50, 50);
            padding: 3px;
        }

        .nav-item .d-flex input[type="search"] {
            flex: 1;
            border: none;
            outline: none;
        }

        .nav-item .d-flex button[type="submit"] {
            background-color: transparent;
            background-image: url('./images/search__.jpeg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 50px 50px;
            border: none;
            outline: none;
            padding: 24px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar bg-dark fixed-top navbar-expand-sm d-flex justify-content-between w-100" data-bs-theme="dark">
            <div class="container-fluid align-items-center">
                <li class="nav-item" id="laika">
                    <a class="navbar-brand" href="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Laika</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </li>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">

                        <li class="nav-item text-align-center">
                            <a class="nav-link" id="deliver" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg> Deliver to</a>
                        </li>

                        <li class="nav-item ">
                            <form class="d-flex" id="search_" role=" search">
                                <input class="form-control form-control-lg me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-secondary" type="submit"></button>
                            </form>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="signin" href="<?php if ((session_status() === PHP_SESSION_ACTIVE) && isset($_SESSION['uname'])) echo 'javascript:void(0)';
                                                                    else echo './signin.php'; ?>"><?php echo "Hello, " . $uname ?></a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link" id="cart" href="./cart.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>

                            </a>
                        </li>

                    </ul>
                    <?php
                    if ((session_status() === PHP_SESSION_ACTIVE) && (isset($_SESSION['uname']))) {

                        echo '<ul class="navbar-nav">';
                        echo '  <li class="nav-item text-white">';
                        echo '       <form action="index.php" method="POST">';
                        echo '     <input type="submit" id="logout" name="logout-bt" class="lbtn" value="Logout">';
                        echo '     </form>';
                        echo '  </li></ul>';
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>
    <br><br><br>
    <?php include './website.php'; ?>
    <?php include './footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>