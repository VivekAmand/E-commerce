<?php
session_start();
if (isset($_GET['message'])) {
    $msg = urldecode($_GET['message']);
    echo "<p class='message'>" . $msg . "</p>";
}
try {
    $con = mysqli_connect('localhost', 'root', 'root', 'customers');
    if ($con) {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login-bt'])) {
            if (isset($_POST['uname']) && isset($_POST['pass'])) {
                $uname = $_POST['uname'];
                $pass = $_POST['pass'];
                $result = mysqli_query($con, "SELECT * FROM users WHERE name='$uname'");
                $row = mysqli_fetch_assoc($result);
                if (mysqli_num_rows($result) > 0) {
                    if (hash('md5', $pass) == $row['password']) {
                        $_SESSION['uname'] = $uname;
                        header("Location:index.php");
                    } else {
                        $msg = "Enter valid credentials!!";
                        header("Location:signin.php?message=" . urldecode($msg));
                    }
                } else {
                    $msg = "Account Dosent Exists!!!,please register";
                    header("Location:signin.php?message=" . urldecode($msg));
                }
            }
        }
    }
    if (!$con) {
        $msg = "Please reload sql server and try again!!!";
        echo "<p class='message'>" . $msg . "</p>";
    }
} catch (mysqli_sql_exception) {
    $msg = "Please reload sql server and try again!!!";
    echo "<p class='message'>" . $msg . "</p>";
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Sign IN</title>
    <link rel="icon" href="./images/icon.png" type="image/x-icon">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }


        .card {
            display: flex;
            align-items: center;
            border: 1px solid black;
            justify-content: center;
            height: auto;
            width: auto;
        }

        .top-center {
            color: black;
            font-size: 35px;
            text-align: center;
            font-weight: bold;
            margin-top: 0px;
        }

        .top-center:hover {
            text-decoration: none;
            color: black;
        }

        .signin-label {
            font-size: 30px;
            font-style: 10px;
        }

        #login-bt,
        #pass,
        #uname {
            width: 250px;
        }

        #login-bt {
            background-color: #C9AE5D;
            border: 1px solid;
        }

        #login-bt:hover {
            border: 1px solid;
            background-color: #B8860B;
        }

        .text {
            font-size: small;
            font-weight: bold;
        }
    </style>
</head>

<body style="background-color:white;">
    <a href="./index.php" class="top-center">laika.in</a><br>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <label class="signin-label">Sign in</label>
            <form action="./signin.php" method="POST" style="background-color:transparent;" onsubmit="return lvalid()">
                <label for="uname" class="text">Enter name or email</label><br>
                <input type="text" id="uname" name="uname"><br>
                <label for="pass" class="text">Password</label><br>
                <input type="password" name="pass" id="pass"><br><br>
                <input type="submit" id="login-bt" name="login-bt" value="login"><br><br>
            </form>
        </div>
    </div><br>
    <hr style="border-top: 1px solid black;margin:20px 0;">
    <span>New to laika?</span>
    <hr>
    <a href="./register.php">
        <input type="button" name="register-bt" value="Create account">
    </a>
    <p id="res" style="color: red;"></p>

    <script>
        function lvalid() {
            var uname = document.getElementById("uname").value;
            var pass = document.getElementById("pass").value;
            if (uname == "" || pass == "") {
                alert("enter all details");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>