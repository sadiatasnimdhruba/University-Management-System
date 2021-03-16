<?php

session_start();
$url="http://localhost/crud/";

if(!isset($_SESSION['login']))
{
 header("Location: http://localhost/crud/login&registration/login.php");
  die();
}
else
{
$conn=mysqli_connect('localhost','root','dhruba0004','blog');
if($conn)
{
  if (isset($_GET['q']))
  {
    $q = $_GET['q'];
    $sql="SELECT * fROM students where name LIKE '%$q%' or id='$q'";
  }
  else
  {
     $sql="SELECT * fROM students";
  }
  $result=mysqli_query($conn,$sql);

}
}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">


    <title>Hello, world!</title>

  </head>
  <body style="background-image: linear-gradient(to right, rgba(255,0,0,0), rgb(2 67 147));">
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #00245a!important">
      <div class="container">
        <div class="col-lg-4">
          <img class="navbar-brand" src="<?php echo $url;?>images/ums.png" width="80" height="50">
    <img class="navbar-brand" src="<?php echo $url;?>images/UE Logo-01_1.png" width="80" height="80">
    <br>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
    <div class="collapse navbar-collapse col-lg-8" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-end">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php"><i class="fa fa-user"></i> Student</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../teacher/teacher.php"> Teacher</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../course/course.php"><i class="fa fa-book-open"></i> Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#"><i class="fa fa-university"></i> Semester</a>
        </li> 

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?php echo $url;?>login&registration/logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
            <li><a class="dropdown-item" href="privacy.php"><i class="fa fa-lock"></i> Privacy & Security</a></li>
            <li><a class="dropdown-item" href="#"><i class="fa fa-question"></i> Help center</a></li>
          </ul>
        </li>
        
      </ul>

    </div>
</div>
</nav>
</hr>
    <br><br><br><br><br><br>
    

    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a class="btn btn-info mb-2" href="insert.php">+ Add new student</a><br><br><br><br><br><br><br><br>
          <img src="<?php echo $url;?>images/index.jpg" style="float: left; width:280px;height:300px">

          
        </div>
        <div class="col-md-9">
          <?php if(isset($_SESSION['success'])){?>
          <div class="alert alert-success">
            <strong>Success!</strong> Added successfully.
          </div>
        <?php }?>
          
          <h2>Student list</h2>
          <hr>
          <a class="btn btn-success mb-2" href="index.php">All students  </a>
           <a class="btn btn-success mb-2" href="department.php?department='CSE'">CSE  </a>
          <a class="btn btn-success mb-2" href="department.php?department='EEE'">EEE </a>
          <a class="btn btn-success mb-2" href="department.php?department='MCE'">MCE </a>
          <a class="btn btn-success mb-2" href="department.php?department='CEE'">CEE  </a>
          <a class="btn btn-success mb-2" href="department.php?department='BTM'">BTM </a>
          <hr>
        <div class="row">
          <div class="col-md-6">
               <form class="my-4">
              <div class="input-group">
                <input required type="text" name="q" class="form-control" placeholder="search....">
                <div class="input-group-append" style="margin-left:12px;">
                  <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>

            



          <table class="table">
            <thead>
              <th>Id</th>
              <th>Name</th>
              <th>Department</th>
              <th>Year</th>
              <th class="text-center">Actions</th>
            </thead>
            <tbody>
              <?php 
                 while($row=mysqli_fetch_assoc($result))
                 {?>
              <tr>
                <td><?php echo $row['ID']?></td>
                <td><?php echo $row['Name']?></td>
                <td ><?php echo $row['Department']?></td>
                <td><?php echo $row['Year']?></td>
                <td class="text-center">
                  <a class="btn btn-info mb-2" href="view.php?id=<?php echo $row['ID'];?>"><i class="fa fa-eye"></i> View  </a>
                  <a class="btn btn-warning mb-2" href="edit.php?id=<?php echo $row['ID'];?>"><i class="fa fa-edit"></i> Edit</a>
                  <a class="btn btn-danger mb-2" onclick="return confirm('Are you sure?')" href="delete.php?id=<?php echo $row['ID'];?>"><i class="fa fa-trash"></i> Delete</a>
                </td>

              </tr>

                <?php  }
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
   

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


  </body>
</html>

<?php unset($_SESSION['success']); ?>