<?php
 include('maincontroller.php');
 if(!isset($_SESSION['admin']))
 {
  header('location:admin.php');
 }
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Drinks
	</title>
	<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">


<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/js/mdb.min.js"></script>
</head>
<body>
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <?php
        if(isset($_SESSION['admin']))
        {
          $user=$_SESSION['admin'];
         // $name=$_SESSION['name'];
          $db=mysqli_connect('localhost','root','','cb');
          $query=" SELECT * FROM user WHERE username='$user'";
          $result=mysqli_query($db,$query);
          $row=$result->fetch_assoc();
          echo'
         
              <img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'" class="rounded-circle z-depth-0"
                alt="avatar image" height="35">
         
        ';
       }
    else
        echo'  <i class="fas fa-user"></i>';
        ?>
        </a>



        <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333" style="margin-top: 7px; padding: 3px 3px 3px 3px;">
          <?php
          if(!isset($_SESSION['user'])&&!isset($_SESSION['admin']))
          echo'
          <a class="dropdown-item" href="login.php">Login</a>
          <a class="dropdown-item" href="register.php">Register</a>
          <a class="dropdown-item" href="admin.php">Admin Login</a>';
          ?>
          <?php
            if(isset($_SESSION['user'])||isset($_SESSION['admin']))
            {
              echo '<form method="post"><button class="btn btn-default" name="logout" >Logout</button></form>';
            }
          ?>
        </div>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->




  <br>
    <div class="container">
      <hr>
        <nav class="navbar navbar-dark default-color">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="welcome.php" >WELCOME &nbsp
          <?php
            $name=strtoupper($_SESSION['name']);
            echo $name;
          ?> 
            </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item ">
                <a class="nav-link" href="adminmain.php">Product Entry</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="update.php">Product Update</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="answer.php">Answer Questions</a>
              </li>
            </ul>
          </div>
        </nav>

<?php
    showp();
?>
</div>
 <!-- Footer -->
<footer class="page-footer font-small default-color" style="margin-top: 20px; ">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://mdbootstrap.com/"> Mithopasal.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

</body>


</html>