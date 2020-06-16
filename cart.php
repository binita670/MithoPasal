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
          <hr>
          <a class="dropdown-item" href="allfoods.php">All Foods</a>
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
<?php
if(isset($_SESSION['shopping_cart']))
{
		echo'
		<!-- Editable table -->
<div class="card" style="margin-right: 20%; margin-left: 20%; margin-top: 5%;">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Items in your Cart</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a href="allfoods.php" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center"><h5>Product Name</h5></th>
            <th class="text-center"><h5>Quantity</h5></th>
            <th class="text-center"><h5>Price</h5></th>
            <th class="text-center"><h5>Total</h5></th>
            <th class="text-center"><h5>Remove</h5></th>
          </tr>
        </thead>
        <tbody>
         ';

        $total=0;
        foreach($_SESSION['shopping_cart'] as $keys=>$values)
		{
			$total=$total+$values['price']*$values['quantity'];
			echo'
			

          <tr>
            <td class="pt-3-half" contenteditable="true"><h6>'.$values['name'].'</h6></td>
            <td class="pt-3-half" contenteditable="true"><h6>'.$values['quantity'].'</h6></td>
            <td class="pt-3-half" contenteditable="true"><h6>Rs.'.$values['price'].'</h6></td>
            <td class="pt-3-half" contenteditable="true"><h6>Rs.'.$values['price']*$values['quantity'].'</h6></td>
            <td>
            <form method="post">
            <input type="hidden" name="id" value="'.$values['id'].'">
              <span class="table-remove"><button
                  class="btn btn-danger btn-rounded btn-sm my-0" name="remove"><b>Remove</b></button></span>
                  </form>
            </td>
          </tr>
          <!-- This is our clonable table line -->';
      }
      echo'
      <tr>
      <td colspan="3"><h6 style="margin-left:70%;">Total:</h6></td>
      <td><h6>Rs.'.$total.'</h6></td>
     
      <td><form method="post"><button class="btn btn-danger btn-rounded btn-sm my-0" name="clear"><span class="table-remove" ><b>Empty your cart</b></span></button></form></td>
      </tr>
        </tbody>
      </table>
      <center>
      		<a href="checkout.php"><button class="btn btn-default btn-rounded btn-sm my-0"><span class="table-remove" ><h6><b>Checkout</b></h6></span></button></a>
      		</center>
    </div>
  </div>
</div>
<!-- Editable table -->
';

	}

else
{
	echo '
	 <center style="margin-top:3%;"> 
   <img src="img/opps.jpg" height="450" width="450" style="border-style:solid;">
   <br>
   <br>
   <h2><b>Your Cart is Empty</b></h2>
   <a href="allfoods.php">
   <button class="btn btn-default btn-rounded btn-sm my-0" name="shop"><span class="table-remove" ><h6 style="color:white;"><b>Shop Now</b></h6></span></button></a>
   </center>
	';
}

?>
<!-- Footer -->
<footer class="page-footer font-small default-color" style="margin-top: 25px;">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://mdbootstrap.com/"> Mithopasal.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
</body>
</html>