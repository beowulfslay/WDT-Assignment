<?php
include 'db.php';
session_start();

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            $role = $row['role'];
            if ($role == 'admin') {
                $_SESSION['admin'] = TRUE;
            }
            $_SESSION['login'] = $row['id'];
            header("Location: dashboard.php");
        } else {
            $error = "Invalid password";
            echo $error;
        }
    } else {
        $error = "Invalid username";
        echo $error;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <div id='login-page'>
        <?php include 'navbar.php'; ?>
        <div id='login-form'>
            <h1>Login</h1>
            <form method="POST" action="login.php">
                <table>
                    <tr>
                        <td><label for="username">Username:</label></td>
                        <td><input type="text" id="username" name="username" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" id="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Login"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>