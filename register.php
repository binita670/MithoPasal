<?php
 include('maincontroller.php');
  if(isset($_SESSION['user']))
 {
  header('location:index.php');
 }
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Register
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
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="index.php">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact Us</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Foods
        </a>
        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
         <a class="dropdown-item" href="drinks.php">Drinks</a>
          <a class="dropdown-item" href="fastfood.php">Fast food</a>
          <a class="dropdown-item" href="cultural.php">Cultural food</a>
          <a class="dropdown-item" href="dessert.php">Dessert</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
        </a>
         <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333" style="margin-top: 7px; padding: 3px 3px 3px 3px;">
          <?php
          if(!isset($_SESSION['user'])&&!isset($_SESSION['admin']))
          echo'
          <a class="dropdown-item" href="login.php">Login</a>
          <a class="dropdown-item active" href="register.php">Register</a>
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





<div style="margin-left:30%;margin-right: 30%; margin-top: 5%">

	<!-- Default form register -->
<form class="text-center border border-light p-5" method="post" enctype="multipart/form-data">

    <p class="h4 mb-4">Sign up</p>

    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="First name" name="fname">
        </div>
        <div class="col">
            <!-- Last name -->
            <input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Last name" name="lname">
        </div>
    </div>

    <!-- E-mail -->
    <input type="username" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Username" name="user">

    <!-- Password -->
    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name="pword">
    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
        <b>At least 8 characters and 1 digit</b>
    </small>
    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Re-enter Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name="epword">
    <br>

     <input type="file" name="photo" accept="image/*" style="margin-left: 50px;"><br>
    <br>

    <!-- Phone number -->
    <input type="text" id="defaultRegisterPhonePassword" class="form-control" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock" name="pno">
    <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
       <b>Optional - for two step authentication</b>
    </small>

    <!-- Newsletter -->
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="defaultRegisterFormNewsletter">
        <label class="custom-control-label" for="defaultRegisterFormNewsletter"><b><b>Subscribe to our newsletter</b></b></label>
    </div>

    <!-- Sign up button -->
    <button class="btn btn-info my-4 btn-block"  name="sign"><b>Sign up</b></button>

    <!-- Social register -->
    <p><b>or sign up with:</b></p>

    <a type="button" class="light-blue-text mx-2" href="https://www.facebook.com/" >
        <i class="fab fa-facebook-f" style="margin-left:5px;margin-right:5px;"></i>
    </a>
    <a type="button" class="light-blue-text mx-2" href="https://twitter.com/">
        <i class="fab fa-twitter" style="margin-left:5px;margin-right:5px;"></i>
    </a>
    <a type="button" class="light-blue-text mx-2" href="https://www.linkedin.com/">
        <i class="fab fa-linkedin-in" style="margin-left:5px;margin-right:5px;"></i>
    </a>
    <a type="button" class="light-blue-text mx-2" href="https://github.com/">
        <i class="fab fa-github" style="margin-left:5px;margin-right:5px;"></i>
    </a>

    <hr>

    <!-- Terms of service -->
    <p><b>By clicking
        <em>Sign up</em> you agree to our</b>
        <a href="" target="_blank"><b>terms of service</b></a>

</form>
<!-- Default form register -->
</p>
</form>
</div>


 <!-- Footer -->
<footer class="page-footer font-small default-color" style="margin-top: 20px;">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://mdbootstrap.com/"> Mithopasal.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
	
</body>
</html>