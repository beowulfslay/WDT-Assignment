<?php
include 'db.php';
session_start();
// dont allow user to view this page without the 'admin' session set
if (!isset($_SESSION['admin'])) {
    echo "You are not authorised to view this page";
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>

<head>
    <title>Employees</title>
    <script src="emp.js"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <?php if (isset($_SESSION['admin'])) { ?>
        <h1>Employee Data</h1>
        <table class="table table-bordered table-hover">
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Salary</th>
                <th>Age</th>
                <th>Date of Birth</th>
                <th>Contact</th>
                <th>Vaccination Count</th>
                <th>On Quarantine</th>
                <th>Action</th>
            </tr>
            <tbody id="emp-table" class="table-group-divider">
                <?php
                $sql = "SELECT * FROM employee";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['role'] . "</td>";
                        echo "<td> RM " . $row['salary'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['dob'] . "</td>";
                        echo "<td>" . $row['contact_num'] . "</td>";
                        echo "<td>" . $row['vac_count'] . "</td>";
                        echo "<td>" . ($row['quarantine'] == 1 ? "Yes" : "No") . "</td>";
                ?>
                        <td>
                            <a href='edit_emp.php?id=<?php echo $row['id'] ?>' style="text-decoration:none">
                                <img src="edit.png" alt="Edit" height="15" width="15">
                            </a>
                            <a href='del_emp.php?id=<?php echo $row['id'] ?>' onclick='return confirmDelete()'>
                                <img src="bin.png" alt="Delete" height="15" width="15">
                            </a>
                        </td>
                        </tr>
                <?php }} ?>
            </tbody>
        </table>
    <?php } else { ?>
        <h1>Sorry, you are not authorised to view this page</h1>
    <?php } ?>

</body>

</html>