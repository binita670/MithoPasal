<?php
include('maincontroller.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>
    Contact
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
  <body style="overflow-x:hidden;">

<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Mitho Pasal
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item active">
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
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light" href="cart.php">
          <i class="fas fa-shopping-cart">
          </i>
          <?php
          if(isset($_SESSION['shopping_cart']))
          {
          $count=count($_SESSION['shopping_cart']);
          echo'['.$count.']
          ';
        }
          ?>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
          <i class="fab fa-twitter"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
          <i class="fab fa-google-plus-g"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <?php
        if(isset($_SESSION['user']))
        {
          $user=$_SESSION['user'];
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










    <!-- Section: Contact v.1 -->
<section class="my-5">

  <!-- Section heading -->
  <h1 class="h1-responsive font-weight-bold text-center my-5">Contact us</h1>
  <!-- Section description -->
  <h3 class="text-center w-responsive mx-auto pb-5">We would like to hear from you</h3>

  <!-- Grid row -->
  <div class="row" style="padding-left: 50px; padding-right: 50px;">

    <!-- Grid column -->
    <div class="col-lg-5 mb-lg-0 mb-4">

      <!-- Form with header -->
      <div class="card">
        <div class="card-body">
          <!-- Header -->
          <div class="form-header  accent-1">
            <h3 class="mt-2"><i class="fas fa-envelope"></i> Write to us:</h3>
          </div>
          <p class="dark-grey-text">We'll write rarely, but only the best content.</p>
          <!-- Body -->
          <div class="md-form">
            <i class="fas fa-user prefix grey-text"></i>
            <input type="text" id="form-name" class="form-control">
            <label for="form-name">Your name</label>
          </div>
          <div class="md-form">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="text" id="form-email" class="form-control">
            <label for="form-email">Your email</label>
          </div>
          <div class="md-form">
            <i class="fas fa-tag prefix grey-text"></i>
            <input type="text" id="form-Subject" class="form-control">
            <label for="form-Subject">Subject</label>
          </div>
          <div class="md-form">
            <i class="fas fa-pencil-alt prefix grey-text"></i>
            <textarea id="form-text" class="form-control md-textarea" rows="3"></textarea>
            <label for="form-text">Send message</label>
          </div>
          <div class="text-center">
            <button class="btn btn-light-blue">Submit</button>
          </div>
        </div>
      </div>
      <!-- Form with header -->

    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-lg-7"style="">

      <!--Google map-->
      <div id="map-container-section" class="z-depth-1-half map-container-section mb-4" >
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56542.96945525381!2d85.28813241834621!3d27.65746439988184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19d3cf18ca51%3A0xd10ec3d53656e18f!2sLalitpur!5e0!3m2!1sen!2snp!4v1592294035850!5m2!1sen!2snp" width="805" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" ></iframe>
      <!-- Buttons-->
      <div class="row text-center">
        <div class="col-md-4">
          <a class="btn-floating  accent-1">
            <i class="fas fa-map-marker-alt"></i>
          </a>
          <br><br>
          <p><b>Lalitpur, 4021</b></p>
          <p class="mb-md-0"><b>Nepal</b></p>
        </div>
        <div class="col-md-4">
          <a class="btn-floating  accent-1">
            <i class="fas fa-phone"></i>
          </a>
          <br><br>
          <p><b>+ 01 5552277</b></p>
          <p class="mb-md-0"><b>Sun - Sat, 8:00-22:00</b></p>
        </div>
        <div class="col-md-4">
          <a class="btn-floating accent-1">
            <i class="fas fa-envelope"></i>
          </a>
          <br><br>
          <p><b>info@mithopasal.com</b></p>
          <p class="mb-0"><b>mithosales@gmail.com</b></p>
        </div>
      </div>

    </div>
    <!-- Grid column -->

  </div>
  <!-- Grid row -->

</section>
<!-- Section: Contact v.1 -->

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
