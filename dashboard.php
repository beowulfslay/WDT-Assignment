<?php
include 'db.php';
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Get the username from the database
$userId = $_SESSION['login'];
$sql = "SELECT username FROM user WHERE id = '$userId'";

// Execute the query
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
} else {
    $username = "Unknown";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link href="./styles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <h1>Welcome to the Dashboard, <span id="username"><?php echo $username; ?></span></h1>
    <!-- Your dashboard HTML code here -->
    <?php if (isset($_SESSION['admin'])) { ?>
        <br><br>
        <?php
        $sql = "SELECT SUM(salary) as total_salary FROM employee";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $total_salary = $row['total_salary'];
        }

        $sql = "SELECT name, salary FROM employee";
        $result = mysqli_query($conn, $sql);
        $employee_data = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $employee_data[$row['name']] = $row['salary'];
            }
        }

        $sql = "SELECT id, name FROM employee WHERE quarantine = 1";
        $emp_quarantined_result = mysqli_query($conn, $sql);
        $total_emp_quarantined = mysqli_num_rows($emp_quarantined_result);
        ?>
        <div style="width:97%">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-header">Total Salary Cost</h5>
                            <h2 class="card-text">RM<?php echo $total_salary; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-header">Total number of employees on leave/quarantine</h5>
                            <h2 class="card-text"><?php echo $total_emp_quarantined ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-header">Employees on Leave/Quarantine</h5>
                            <?php
                            if ($total_emp_quarantined > 0) {
                            ?>
                                <table id='emp-on-leave' class='table table-bordered table-hover'>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($emp_quarantined_result)) {
                                            $name = $row['name'];
                                        ?>
                                            <tr>
                                                <td><?php echo $name; ?></td>
                                                <td><a href='view_emp.php?id=<?php echo $row['id']; ?>'>View Details</a></td>
                                            <?php
                                        }
                                        mysqli_close($conn);
                                            ?>
                                    </tbody>
                                </table>
                            <?php
                            } else {
                                echo "<p>No employees on leave/quarantine</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-header">Salary Chart</h5>
                            <canvas id="salaryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('salaryChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode(array_keys($employee_data)); ?>,
                    datasets: [{
                        label: 'Salary (RM)',
                        data: <?php echo json_encode(array_values($employee_data)); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    <?php } ?>

</body>

</html>