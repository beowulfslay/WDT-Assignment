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
  // Delete employee
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // delete user account
    $sql = "SELECT user_id FROM employee WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $user_id = $row['user_id'];
      $sql = "DELETE FROM user WHERE id = $user_id";
      mysqli_query($conn, $sql);
    }

    //delete employee entry
    $sql = "DELETE FROM employee WHERE id = $id";
    mysqli_query($conn, $sql);

    header("Location: emp.php");
    exit();
  }
}
