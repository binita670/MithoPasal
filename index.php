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

<br>
<center>

<!--Zoom effect-->
<div class="view overlay zoom">
  <img src="img/food.jpg" height=800 width=900 class="img-fluid " alt="zoom">
  <div class="mask flex-center waves-effect waves-light">
  </div>
</div>
</center>
<br>
<hr>

<center>
  <h1 class="font-weight-bold deep-orange-lighter-hover mb-3"><b>OUR SPECIALS</b></h1>
</center>
<br>


<!-- Card deck -->
<div class="card-deck" style="margin-left: 2%;margin-right: 2%">

  <!-- Card -->
  <div class="card mb-4">

    <!--Card image-->
    <div class="view overlay">
      <img class="card-img-top" src="img/newari.jpg" alt="Card image cap" height="280px">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <!--Card content-->
    <div class="card-body">

      <!--Title-->
      <h4 class="card-title">NEWARI KHAJA SET</h4>
      <!--Text-->
      <p class="card-text">Newars prefer to eat snacks in the afternoon. It generally consists of flattened rice (baji), eaten with such items as roasted and curried soya beans (musya), fermented mustard leaves (gundro), or curried potato (alu tarakari). They also have some meat (la) and home- made liquor (thon) with it. Baji is called chiura in Nepali.</p>
 

    </div>

  </div>
  <!-- Card -->

  <!-- Card -->
  <div class="card mb-4">

    <!--Card image-->
    <div class="view overlay">
      <img class="card-img-top" src="img/tea.jpg" alt="Card image cap">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <!--Card content-->
    <div class="card-body">

      <!--Title-->
      <h4 class="card-title">MASALA CHIYA</h4>
      <!--Text-->
      <p class="card-text">Masala chaiis a flavoured tea beverage made by brewing black tea with a mixture of aromatic spices and herbs.Although traditionally prepared as a decoction of green cardamom pods, cinnamon sticks, ground cloves, ground ginger, and black peppercorn together with black tea leaves, retail versions include tea bags for infusion, instant powdered mixtures, and concentrates.</p>
   

    </div>

  </div>
  <!-- Card -->

  <!-- Card -->
  <div class="card mb-4">

    <!--Card image-->
    <div class="view overlay">
      <img class="card-img-top" src="img/momo.jpg" alt="Card image cap">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>

    <!--Card content-->
    <div class="card-body">

      <!--Title-->
      <h4 class="card-title">MOMO</h4>
      <!--Text-->
      <p class="card-text">There are typically two types of momo, steamed and fried. Momo is usually served with a dipping sauce, normally made with tomato as the base ingredient. Soup momo is a dish with steamed momo immersed in a meat broth. Pan-fried momo is also known as kothey momo. Steamed momo served in hot sauce is called C-momo.</p>
    

    </div>

  </div>
  <!-- Card -->

</div>
<!-- Card deck -->

<hr>


<h3 class="mt-0 mb-2 font-weight-bold" style="margin-left: 5%;margin-right: 20%">Reviews</h3>
<br>


<?php
showreview();
  if(!isset($_SESSION['user']))
    {
      echo'

      <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold">Write to us</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body mx-3">
              <div class="md-form mb-5">
                <i class="fas fa-user prefix grey-text"></i>
                <input type="text" id="form34" class="form-control validate" disabled>
                <label data-error="wrong" data-success="right" for="form34">Your name</label>
              </div>

              <div class="md-form">
                <i class="fas fa-pencil prefix grey-text"></i>
                <textarea type="text" id="form8" class="md-textarea form-control" rows="4" disabled></textarea>
                <label data-error="wrong" data-success="right" for="form8">Your message</label>
              </div>

            </div>
            <div class="modal-footer d-flex justify-content-center" >

              <button class="btn btn-default" disabled>Send <i class="fas fa-paper-plane-o ml-1"></i></button>
               <center>
            <h5>
            <strong>
              Please &nbsp<a href="login.php"> Login  </a>&nbsp first to give a review</strong></h5>
              </center>
            </div>
           
          </div>
        </div>
      </div>
      <div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalContactForm">Give a Review</a>
</div>
      ';
}

else
givereview($_SESSION['user']);

?>

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