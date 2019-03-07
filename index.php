<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./public/ css/styles.css">
  <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
  <script src="./node_modules/jquery/dist/jquery.js"></script>
  <script src="./node_modules/jquery/dist/jquery.min.js"></script>
  <title>Document</title>
</head>

<body>
  <div id="wrapper">
    <div class="container">
      <?php include_once './controller/process.php'; ?>
      <?php if(isset($_SESSION['message'])):  ?>
      <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
        <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']); 
          ?>
      </div>
      <?php endif ?>
      <?php if($exist==true): ?>
      <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
        <?php 
              echo $_SESSION['message']; 
              unset($_SESSION['message']); 
            ?>
      </div>
      <?php endif; ?>

      <?php 
        $res = mysqli_query($con,"SELECT * FROM users order by id desc");
        if($res->num_rows>0):
      ?>


      <div class="table-wrapper-scroll-y" style="height: 300px; overflow-y: scroll;">
        <table class="table table-bordered table-striped mb-0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
                while($row= $res->fetch_assoc()): ?>
            <tr>
              <td><?php echo $row['name'];  ?></td>
              <td><?php echo $row['email'];  ?></td>
              <td><?php echo $row['phone'];  ?></td>
              <td>
                <a class="btn btn-info" name="edit" href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
                <a class="btn btn-danger" name="delete"
                  href="./controller/process.php?delete=<?php echo $row['id']; ?>">Delete</a>
              </td>
            </tr>
            <?php endwhile; ?>

          </tbody>
        </table>
      </div>

        <?php endif; ?>
      <br>

      <form action="./controller/process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
          <label>Name</label>
          <input type="text" id="name" required name="name" value="<?php echo $name; ?>" class="form-control"
            placeholder="name">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" id="email" name="email" value="<?php echo $email; ?>" class="form-control"
            placeholder="email">
        </div>
        <div class="form-group">
          <label>Phone</label>
          <input type="number" id="phone" name="phone" value="<?php echo $phone; ?>" class="form-control"
            placeholder="phone">
        </div>

        <div class="form-group">
          <?php 
          if($update == true): 
        ?>
          <input type="submit" name="update" value="Update" class="btn btn-info">
          <?php 
          else: 
        ?>
          <input type="submit" name="insert" value="Add New User" class="btn btn-primary">
          <?php 
          endif; 
        ?>
        </div>
      </form>
    </div>
  </div>
</body>

</html>