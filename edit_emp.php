<?php
include 'db.php';
session_start();
// dont allow user to view this page without the 'admin' session set
if (!isset($_SESSION['admin'])) {
    echo "You are not authorised to view this page";
    header("Location: dashboard.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // if id is set
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM employee WHERE id=$id";
        $result = mysqli_query($conn, $query);
        $employee_data = mysqli_fetch_assoc($result);
    }
}
// if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $salary = $_POST['salary'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $contact_num = $_POST['contact_num'];
    $vac_count = $_POST['vac_count'];
    $quarantine = 0;
    if (isset($_POST['quarantine'])) {
        $quarantine = 1;
    }
    $query = "UPDATE employee SET name='$name', role='$role', salary='$salary', age='$age', dob='$dob', contact_num='$contact_num', vac_count='$vac_count', quarantine='$quarantine' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Record updated successfully");</script>';
        echo '<script>window.location.href = "emp.php";</script>';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    exit;
}
?>

<html>

<head>
    <title>Edit Employee</title>
</head>

<body>
    <div id='edit-emp-page'>
        <?php include 'navbar.php'; ?>

        <div id='edit-emp-form'>
        <h1>Edit Employee Data</h1>
            <form name="update_employee" method="post" action="edit_emp.php">
                <table>
                    <tr>
                        <td>Name</td>
                        <td><input required type="text" name="name" value="<?php echo $employee_data['name']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td><input required type="text" name="role" value="<?php echo $employee_data['role']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Salary</td>
                        <td><input required type="text" name="salary" value="<?php echo $employee_data['salary']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td><input required type="text" name="age" value="<?php echo $employee_data['age']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td><input required type="date" name="dob" value="<?php echo $employee_data['dob']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td><input required type="text" name="contact_num" value="<?php echo $employee_data['contact_num']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Vaccination Count</td>
                        <td><input required type="text" name="vac_count" value="<?php echo $employee_data['vac_count']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Is on quarantine?</td>
                        <td><input type="checkbox" name="quarantine" <?php if ($employee_data['quarantine']) echo "checked"; ?>></td>
                    </tr>
                    <tr>
                        <td><input required type="hidden" name="id" value="<?php echo $_GET['id']; ?>"></td>
                        <td><input required type="submit" name="update" value="Update"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>