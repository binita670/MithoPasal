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
    
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <?php
        if(isset($_SESSION['admin']))
        {
          $user=$_SESSION['admin'];
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




<div style="margin-left:30%;margin-right: 30%; margin-top: 5%">
<!-- Default form register -->
<form class="text-center border border-light p-5" method="post" enctype="multipart/form-data">
    <p class="h4 mb-4">Form</p>

    <input type="text" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="ID" name="pid">

    <input type="text" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Name" name="pname">

    <select name="category" class="form-control mb-4">
    <option value=""disabled selected>Category</option>
    <optgroup label="Drinks">
      <option value="harddrink">Hard Drink</option>
      <option value="softdrink">Soft Drink</option>
      <option value="hotdrink">Hot Drink</option>
    </optgroup>
    <option value="fastfood"> Fastfood </option>
    <option  value="culturalf">Cultural Food</option>
    <optgroup label="Desserts">
      <option value="icecream">Icecream</option>
      <option value="pie">Pie</option>
      <option value="cake">Cakes</option>
    </optgroup>
    </select>

    <label><b>Quantity</b></label>
    <input type="number" min="0" max="30" value="1" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Quantity" name="qty">

    <label style="font-size:20px;">Description</label>
      <div class="md-form" style="margin-top: 0px;">
        <textarea id="materialRegisterFormPassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" name="desc" rows="5" cols="20">
      </textarea>
      </div>

    <input type="file" name="picture" accept="image/*" style="margin-left: 50px;"><br>
    <br>

    <input type="text" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Price" name="price">

    <!-- Sign up button -->
    <button class="btn btn-info my-4 btn-block"  name="upload">Upload</button>

  

    

</form>
<!-- Default form register -->
</div>
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