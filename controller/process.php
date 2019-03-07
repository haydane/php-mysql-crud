<?php
  $con = mysqli_connect("127.0.0.1","root","password","web");
  $update = false;
  $name = '';
  $email = '';
  $phone = '';
  $id = 0;
  $exist = false;

  session_start();

  if($con->connect_error){
    print("connect failed: " .$con->connect_error);
  }
  if(isset($_POST['insert']))
  {
    $name = $_POST['name'].trim();
    $email = $_POST['email'].trim();
    $phone = $_POST['phone'].trim();
    $res = mysqli_query($con,"SELECT name FROM users WHERE name='$name'") or die(`error: ${$con->mysqli_error}`);
    $row = $res->fetch_array();
    echo count($row['name']);
    if(count($row['name'])==1)
    {
      $exist = true;
      $_SESSION['message'] = "Your name is existed!";
      $_SESSION['msg_type'] = "info";
      header("location: ../index.php");
    }
    else{
      mysqli_query($con,"insert into users(name,email,phone) values('$name','$email','$phone')") or die($con->mysqli->connect_error);
      $_SESSION['message'] = "Record has been saved";
      $_SESSION['msg_type'] = "success";
      header("location: ../index.php");
    }
  }

  if(isset($_GET['delete']))
  {
    $id = $_GET['delete'];
    mysqli_query($con,"DELETE from users where id=$id") or die($con->mysqli_error);
    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = "danger";

    header("location: ../index.php");
  }

  if(isset($_GET['edit']))
  {
    $update = true;
    $id = $_GET['edit'];
    $res = mysqli_query($con,"SELECT * FROM users WHERE id=$id") or die($con->mysqli_error);
    if(count($res)==1){
      $row = $res->fetch_assoc();
      $name = $row['name'];
      $email = $row['email'];
      $phone = $row['phone'];
    }
  }

  if(isset($_POST['update']))
  {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    mysqli_query($con,"UPDATE users SET name='$name',email='$email',phone='$phone' WHERE id=$id") or die($con->mysqli_error);
    header("location: ../index.php");
    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = "warning";

  }

?>