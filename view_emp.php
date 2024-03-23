<?php
include 'db.php';
session_start();
// don't allow user to view this page without the 'admin' session set
if (!isset($_SESSION['admin'])) {
    echo "You are not authorized to view this page";
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
    } else {
        echo "Bad Request";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Employee Details</title>
</head>

<body>
    <div id='emp-details-page'>
        <?php include 'navbar.php'; ?>
        <div id='emp-details'>
            <h1>Employee Details</h1>
            <table id="emp-details-table" style="width:fit-content;" class="table table-bordered table-hover">
                <tr>
                    <td>Name</td>
                    <td><?php echo $employee_data['name']; ?></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td><?php echo $employee_data['role']; ?></td>
                </tr>
                <tr>
                    <td>Salary</td>
                    <td><?php echo "RM" . $employee_data['salary']; ?></td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td><?php echo $employee_data['age']; ?></td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><?php echo $employee_data['dob']; ?></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><?php echo $employee_data['contact_num']; ?></td>
                </tr>
                <tr>
                    <td>Vaccination Count</td>
                    <td><?php echo $employee_data['vac_count']; ?></td>
                </tr>
                <tr>
                    <td>Is on quarantine?</td>
                    <td><?php echo ($employee_data['quarantine'] ? 'Yes' : 'No'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</body>

</html>