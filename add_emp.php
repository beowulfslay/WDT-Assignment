<?php
include 'db.php';
session_start();
// don't allow user to view this page without the 'admin' session set
if (!isset($_SESSION['admin'])) {
    echo "You are not authorized to view this page";
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $role = $_POST['role'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $vaccination = $_POST['vaccination'];
    $salary = $_POST['salary'];
    if (isset($_POST['admin'])) {
        $admin = $_POST['admin'];
    } else {
        $admin = "";
    }

    if ($admin == "admin") {
        $isAdmin = "admin";
    } else {
        $isAdmin = "user";
    }
    $userSql = "INSERT INTO user (username, password, role)
  VALUES ('$username', '$hashedPassword', '$isAdmin')";
    if (mysqli_query($conn, $userSql) === TRUE) {
        $userId = mysqli_insert_id($conn);
        $employeeSql = "INSERT INTO employee (user_id, name, role, age, dob, contact_num, vac_count, salary)
        VALUES ('$userId', '$name', '$role', '$age', '$dob', '$contact', '$vaccination', '$salary')";
        if (mysqli_query($conn, $employeeSql) === TRUE) {
            echo '<script>alert("Record updated successfully");</script>';
            echo '<script>window.location.href = "emp.php";</script>';
            } else {
            echo "Error: " . $employeeSql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $userSql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
</head>

<body>
    <div id='add-emp-page'>
        <?php include 'navbar.php'; ?>
        <div id='add-emp-form'>
            <form action="add_emp.php" method="post">
                <h1>Register An Employee</h1>
                <h3> For account creation </h3>
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br>
                <h3> Employee Basic Data </h3>
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br>
                <label for="role">Role:</label><br>
                <input type="text" id="role" name="role" required><br>
                <label for="salary">Salary:</label><br>
                <input type="text" id="salary" name="salary" required placeholder="1000.00" pattern="^\d*(\.\d{0,2})?$"><br>
                <label for="age">Age:</label><br>
                <input type="number" id="age" name="age" required><br>
                <label for="dob">Date of birth:</label><br>
                <input type="date" id="dob" name="dob" required><br>
                <label for="contact">Phone number:</label><br>
                <input type="text" id="contact" name="contact" required placeholder="01234567890" maxlength="11" pattern="[0-9]{10}|[0-9]{11}"><br>
                <label for="vaccination">Vaccination count:</label><br>
                <input type="number" id="vaccination" name="vaccination" required><br>
                <label for="admin">is Admin:</label>
                <input type="checkbox" id="admin" name="admin" value="admin"><br>
                <br>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>