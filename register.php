<?php
session_start();
if (isset($_GET['message'])) {
    $msg = urldecode($_GET['message']);
    echo "<p class='message'>" . $msg . "</p>";
}
try {
    $con = mysqli_connect('localhost', 'root', 'root', 'customers');
    if ($con) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register-bt'])) {
            if (isset($_POST['uname']) && isset($_POST['uemail']) && isset($_POST['pass'])) {
                $uname = $_POST['uname'];
                $uemail = $_POST['uemail'];
                $pass = hash('md5', $_POST['pass']);
                $result = mysqli_query($con, "SELECT * FROM users WHERE name='$uname' OR email='$uemail'");
                if (mysqli_num_rows($result) == 0) {
                    $sql = "INSERT INTO users(name,email,password) VALUES ('$uname','$uemail','$pass')";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        $msg = "Registration succesful!";
                        header("Location:signin.php?message=" . urldecode($msg));
                    } else {
                        $msg = "Unable to register, Retry!!";
                        header("Location:register.php?message=" . urldecode($msg));
                    }
                } else {
                    $msg = "Username or Email already exists!!!";
                    header("Location:register.php?message=" . urldecode($msg));
                }
            }
        }
    }
    if (!$con) {
        $msg = "Please try again!!!";
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
    <title>register_page</title>
</head>

<body style="background-color: lightslategray;">
    <fieldset>
        <legend>REGISTER</legend>
        <form action="register.php" method="POST" style="background-color:transparent;" onsubmit="return rvalidate()" autocomplete="off">
            <label for="uname">NAME : </label>
            <input type="text" id="uname" name="uname"><br><br>
            <label for="uemail">EMAIL:</label>
            <input type="text" id="uemail" name="uemail"><br><br>
            <label for="pass">PASSWORD:</label>
            <input type="password" name="pass" id="pass"><br><br>
            <label for="cpass">CONFIRM PASSWORD:</label>
            <input type="password" name="cpass" id="cpass"><br><br>
            <input type="submit" id="register-bt" name="register-bt" value="register">
        </form>
    </fieldset>
    <script>
        function rvalidate() {
            var uname = document.getElementById("uname").value;
            var uemail = document.getElementById("uemail").value;
            var pass = document.getElementById("pass").value;
            var cpass = document.getElementById("cpass").value;
            if (cpass != pass) {
                alert("enter same passwords");
                return false;
            }
            if (uname == "" || uemail == "" || pass == "" || cpass == "") {
                alert("enter all details");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>