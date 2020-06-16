<?php
 include('maincontroller.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Mitho Pasal
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
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Mitho Pasal
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



 <!--Main layout-->
  <main >
    <div class="container wow fadeIn" style="padding-right: 20%; margin-left: 15%;">

      <!-- Heading -->
      
      <h2 class="my-5 h2 text-center"style="margin-right: 33%;">Checkout form</h2>
      <form method="post">
      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-8 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <form class="card-body">

              

              <!--Username-->
              <div class="md-form input-group pl-0 mb-5">
                
                <input type="text" class="form-control py-0" placeholder="Username" aria-describedby="basic-addon1" name="username">
              </div>
              <!--Password-->
              <div class="md-form input-group pl-0 mb-5">
                
                <input type="password" class="form-control py-0" placeholder="Password" aria-describedby="basic-addon1" name="password">
              </div>

              
              <!--Grid row-->
              <div class="row" style="margin-left: 130px;">

                <!--Grid column-->
                <div class="col-lg-4 col-md-12 mb-4" style="margin-right: 60px;">

                  <label for="country">Country</label>
                  <select class="custom-select d-block w-100" name="country" required>
                    <option value="">Choose...</option>
                    <option value="us">United States</option>
                    <option value="aus">Australia</option>
                    <option value="india">India</option>
                    <option value="nepal">Nepal</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid country.
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4">

                  <!--address-->
              <div class="md-form mb-5">
                <input type="text" name="address" class="form-control" placeholder="Address">
              </div>


                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->
              <hr>

                <center>
                <div class="col-md-6 mb-3">
                  <label for="cc-name">Name on card</label>
                  <input type="text" name="cardname" class="form-control" id="cc-name" placeholder="" required>
                  <span class="text-muted">Full name as displayed on card</span>
                  <div class="invalid-feedback">
                    Name on card is required
                  </div>
                </div>
              </center>
                
  
              
              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" name="checkoutfinal">Continue to Checkout <i class="fab fa-cc-paypal" style="font-size: 45px;"></i></button>

            </form>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-4 mb-4" >

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            
            <span class="text-muted" style="margin-left: 35%;"><b>Your cart</b></span>
          </h4>

          <!-- Cart -->
          
          <ul class="list-group mb-3 z-depth-1">
            <?php 
              if(isset($_SESSION['shopping_cart']))
              {
                $total=0;
                foreach($_SESSION['shopping_cart'] as $keys=> $values)
                {
                    echo '<li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div> 
                        <h6 class="my-0">'.$values['name'].'</h6>
                      </div>
                      <span class="text-muted">'.$values['quantity'].'pc *'.$values['price'].'</span>
                       </li>';
                       $total=$total + $values['price']*$values['quantity'];
                }
                echo '<li class="list-group-item d-flex justify-content-between">
                <span>Total (Rs.)</span>
                <strong>'.$total.'</strong> </li>';
              }
            
            ?>
            
          </ul>
          <!-- Cart -->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <center>
  <footer>
    <hr>


    
  

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>


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