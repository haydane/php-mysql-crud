<?php
  $con = mysqli_connect("127.0.0.1","root","password","web");

  session_start();

  if($con->connect_error){
    print("connect failed: " .$con->connect_error);
  }
  if(isset($_POST['insert']))
  {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    mysqli_query($con,"insert into users(name,email,phone) values('$name','$email','$phone')") or die($con->mysqli->connect_error);

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";

    header("location: ../index.php");
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
    $id = $_GET['edit'];
    $res = mysqli_query($con,"SELECT * FROM users WHERE id=$id") or die($con->mysqli_error);
    if(count($res)==1){
      $row = $res->fetch_assoc();
      $name = $row['name'];
      $email = $row['email'];
      $phone = $row['phone'];
    }
  }

?>