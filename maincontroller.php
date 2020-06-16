 <?php
 session_start();
 $db=mysqli_connect('localhost','root','','cb');
 if(isset($_POST['sign']))
 {
 	$fname=$_POST['fname'];
 	$lname=$_POST['lname'];
 	$user=$_POST['user'];
 	$pword=$_POST['pword'];
 	$epword=$_POST['epword'];
 	$pno=$_POST['pno'];
 	$photo=$_FILES['photo']['tmp_name'];
 	if(empty($fname) || empty($lname)|| empty($user)||empty($pword)|| empty($epword)||empty($pno))
 	{
 		echo '<script language="javascript">';
 		echo 'alert("Please donot leave any field blank")';
 		echo '</script>';
 	}
 	else if(strlen($pno)!=10)
 	{
 		echo '<script language="javascript">';
 		echo 'alert("Phone length should be of length 10")';
 		echo '</script>';	
 	}
 	else if(strlen($pword)<8)
 	{
 		echo '<script language="javascript">';
 		echo 'alert("password length should be of length greater than 8 character")';
 		echo '</script>';	
 	}
 	else if ($pword!=$epword)	
 	{
 		echo '<script language="javascript">';
 		echo 'alert("password donot match")';
 		echo '</script>';	
 	}
 	elseif(getimagesize($photo)==FALSE)
 	{
 		echo '<script language="javascript">';
 		echo 'alert("Please upload valid image")';
 		echo '</script>';	
 	}
 	else
 	{
 		$query1="SELECT * FROM user WHERE username='$user' ";
 		$res=mysqli_query($db,$query1);
 		if(mysqli_num_rows($res)==0)
 		{
 		$pno=number_format($pno);
 		$encript=md5($pword);
 		$photo=addslashes(file_get_contents($photo));
	 	$query="INSERT INTO user(fname,lname,username,password,phone,type,photo) VALUES('$fname','$lname','$user','$encript','$pno','0','$photo')";
	 	$result=mysqli_query($db,$query);
	 	
	 	}
	 	else
	 	{
	 		echo'<script language="javascript">
	 			alert("username already exist")
	 			</script>';
	 	}
	 }
 
 }

if (isset($_POST['login']))
{
	$user=$_POST['username'];
	$password=$_POST['password'];
	if(empty($user)||empty($password))
	{
		echo'<script language="javascript">
			alert("Field must not be empty")
			</script>';
	}
	else
	{
		$pass=md5($password);
		$query="SELECT * FROM user WHERE username='$user' AND password='$pass'AND type='0'";
		$result=mysqli_query($db,$query);
			
			if(mysqli_num_rows($result)==1)
			{
				$_SESSION['user']=$user;
				header('location:index.php');
			}
			else
			{
				echo'<script language="javascript">
			alert("Username and password donot match")
			</script>';
			}
		
	}

}

if (isset($_POST['loginadmin']))
{
	$user=$_POST['username'];
	$password=$_POST['password'];
	if(empty($user)||empty($password))
	{
		echo'<script language="javascript">
			alert("Field must not be empty")
			</script>';
	}
	else
	{
		$pass=md5($password);

		$query="SELECT * FROM user WHERE username='$user' AND password='$pass'AND type='1'";
		$result=mysqli_query($db,$query);
		$row=$result->fetch_assoc();
		$fname=$row['fname'];	
			if(mysqli_num_rows($result)==1)
			{
				$_SESSION['admin']=$user;
				$_SESSION['name']=$fname;
				header('location:index.php');
			}
			else
			{
				echo'<script language="javascript">
					alert("Username and password donot match")
					</script>';
			}
	}

}

if (isset($_POST['logout']))
{
	session_destroy();
	header('location:login.php');
}
if (isset($_POST['logoutadmin']))
{
	session_destroy();
	header('location:admin.php');
}

if(isset($_POST['upload']))
{
	$id=$_POST['pid'];
	$name=$_POST['pname'];
	$quantity=$_POST['qty'];
	$category=$_POST['category'];
	$price=$_POST['price'];
	$photo=$_FILES['picture']['tmp_name'];
	$description=mysqli_real_escape_string($db,$_POST['desc']);
	if(empty($id)||empty($name)||empty($quantity)||empty($category)||empty($price)||empty($description))
	{
		echo '<script language="javascript"> 
			  alert("Field must not be empty")
			  </script>	';
	}
	else if(getimagesize($photo)==FALSE)
	{
		echo '<script language="javascript"> 
			  alert("Please upload valid image file")
			  </script>	';
	}
	else
	{
		$photo=addslashes(file_get_contents($photo));
		$query="SELECT * FROM product WHERE id='$id'";
		$result=mysqli_query($db,$query);
		if(mysqli_num_rows($result)==0)
		{
			$query1="INSERT INTO product VALUES('$id','$name','$category','$quantity','$photo','$price','$description')";
			$result1=mysqli_query($db,$query1);
			if($result1)
			{
				echo '<script language="javascript"> 
			  		  alert("Product uploaded successfully.")
			  		  </script>	';
			}
		}
		else
		{
			echo '<script language="javascript"> 
			  		  alert("Product Id already exist.")
			  		  </script>	';

		}
	}	
}

function showdrinks()
{
	$db=mysqli_connect('localhost','root','','cb');
	$query="SELECT * FROM product WHERE category='harddrink'OR category='softdrink' OR category='hotdrink'";
	$result=mysqli_query($db,$query);
	echo '<div class="row wow fadeIn">';
	while($row=$result->fetch_assoc())
	{
		echo
		'
		<div class="col-lg-3 col-md-6 mb-4">
		<br><br>
	        <div class="card">
	        <div class="view overlay">
	        <form method="post">
	        <input type="hidden" name="pid" value="'.$row['id'].'"/>
	        <button name="productd" style="background-color:transparent; border:none; outline:none;">
			<img height="300" width="250" alt="Image not found" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/></button></form>
	    </div>
	    	<hr>
		    <!--Card content-->
		    <div class="card-body">
		    <center>
		      <!--Title-->
		      <h4 class="card-title"><b>'.$row['name'].'</b></h4>
		      <!--Text-->
		      <p class="card-text"><b><h5>Price: <strong class="font-weight-bold blue-text">Rs.'.$row['price']. '</strong></h5></b><br>

		      <label><b>Quantity</b></label>
		      <form method="post">
		      <input type="hidden" name="id" value="'.$row['id'].'">
    			<input type="number" min="0" max="'.$row['quantity'].'" value="1" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Quantity" name="quantity">
					 <input type="hidden" name="price" value="'.$row['price'].'">
					 <input type="hidden" name="name" value="'.$row['name'].'">

		      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->';
		       if($row['quantity']==0)
		      {
		      	echo'<button name="order" disabled class="btn btn-blue btn-md">Out of Stock </button>';
		      }
		      else
		      {
		      	echo'<button name="cart" class="btn btn-blue btn-md">Add to Cart</button>';
		      }
		      echo'
		      </form>
		      </center>
		    </div>
		  </div>
		  </div>
		  <!-- Card -->

		';

	}
	echo'</div>';
}
if (isset($_POST['productd']))
{
	$productid=$_POST['pid'];
	$_SESSION['product']=$productid;
	header('location:productdetail.php');
}

function showcategory($category)
{
	$db=mysqli_connect('localhost','root','','cb');
	$query="SELECT * FROM product WHERE category='$category'";
	$result=mysqli_query($db,$query);
	echo '<div class="row wow fadeIn">';
	while($row=$result->fetch_assoc())
	{
		echo
		'
		<div class="col-lg-3 col-md-6 mb-4">
		<br><br>
	        <div class="card">
	        <div class="view overlay">
	        <form method="post">
	        <input type="hidden" name="pid" value="'.$row['id'].'"/>
	        <button name="productd" style="background-color:transparent; border:none; outline:none;">
			<img height="300" width="260" alt="Image not found" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/></form>
	    </div>


	    	<hr>
		    <!--Card content-->
		    <div class="card-body">
		    <center>
		      <!--Title-->
		      <h4 class="card-title"><b>'.$row['name'].'</b></h4>
		      <!--Text-->
		       <p class="card-text"><b><h5>Price: <strong class="font-weight-bold blue-text">Rs.'.$row['price']. '</strong></h5></b><br>
		      <label><b>Quantity</b></label>
		      <form method="post">
		      <input type="hidden" name="id" value="'.$row['id'].'">
    			<input type="number" min="1" max="'.$row['quantity'].'" value="1" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Quantity" name="quantity">
					 <input type="hidden" name="price" value="'.$row['price'].'">
					 <input type="hidden" name="name" value="'.$row['name'].'">
		      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->';
		       if($row['quantity']==0)
		      {
		      	echo'<button name="order" disabled class="btn btn-blue btn-md">Out of Stock </button>';
		      }
		      else
		      {
		      	echo'<button name="cart" class="btn btn-blue btn-md">Add to Cart</button>';
		      }
		      echo'
		      </form>
		      </center>
		    </div>
		  </div>
		  </div>
		  <!-- Card -->

		';

	}
	echo'</div>';
}


function showdesserts()
{
	$db=mysqli_connect('localhost','root','','cb');
	$query="SELECT * FROM product WHERE category='pie'OR category='icecream' OR category='cake'";
	$result=mysqli_query($db,$query);
	echo '<div class="row wow fadeIn">';
	while($row=$result->fetch_assoc())
	{
		echo
		'
		<div class="col-lg-3 col-md-6 mb-4">
		<br><br>
	        <div class="card">
	        <div class="view overlay">
	        <form method="post">
	        <input type="hidden" name="pid" value="'.$row['id'].'"/>
	        <button name="productd" style="background-color:transparent; border:none; outline:none;">
			<img height="300" width="250" alt="Image not found" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/></button></form>
			
	    </div>


	    	<hr>
		    <!--Card content-->
		    <div class="card-body">
		    <center>
		      <!--Title-->
		      <h4 class="card-title"><b>'.$row['name'].'</b></h4>
		      <!--Text-->
		       <p class="card-text"><b><h5>Price: <strong class="font-weight-bold blue-text">Rs.'.$row['price']. '</strong></h5></b><br>
		      <label><b>Quantity</b></label>
		      <form method="post">
		      <input type="hidden" name="id" value="'.$row['id'].'">
    			<input type="number" min="1" max="'.$row['quantity'].'" value="1" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Quantity" name="quantity">
					 <input type="hidden" name="price" value="'.$row['price'].'">
					 <input type="hidden" name="name" value="'.$row['name'].'">
		      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->';
		      if($row['quantity']==0)
		      {
		      	echo'<button name="order" disabled class="btn btn-blue btn-md">Out of Stock </button>';
		      }
		      else
		      {
		      	echo'<button name="cart" class="btn btn-blue btn-md">Add to Cart</button>';
		      }
		      echo'
		      </form>
		      </center>
		    </div>
		  </div>
		  </div>
		  <!-- Card -->

		';

	}
	echo'</div>';
}




if(isset($_POST['checkoutfinal']))
	{
		$name=$_POST['cardname'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$address=$_POST['address'];
		$country=$_POST['country'];
		if(empty($name)||empty($username)||empty($password)||empty($address)||empty($country))
		{
			echo '<script language="javascript">
				alert("Please donot leave any field empty")
				</script>
			';
		}
		else
		{	
			$db=mysqli_connect('localhost','root','','cb');
			$encript=md5($password);
			$query="SELECT * FROM user WHERE username='$username' AND password='$encript'";
			$result=mysqli_query($db,$query);
			if (mysqli_num_rows($result)==1)
			{
				$query1="SELECT * FROM product";
				$result1=mysqli_query($db,$query1);
				while($row=$result1->fetch_assoc())
				{
					foreach($_SESSION['shopping_cart'] as $keys=>$values)
					{
						if($values['id']==$row['id'])
						{
							$id=$values['id'];
							$pqty=$row['quantity'];	
							$psoldout=$row['soldout'];
							$quantity=$values['quantity'];			
							$newquantity=number_format($pqty)-number_format($quantity);
							$newsoldout=number_format($psoldout)+number_format($quantity);
							$query3="UPDATE product SET quantity='$newquantity', soldout='$newsoldout' WHERE id='$id'";
							$result3=mysqli_query($db,$query3);
								
							}
						}
				}
				echo'
					<script language="javascript">
					alert("Product bought")
					</script>
				';
				$_SESSION=array();
				session_destroy();
				header('location:index.php');
			}
			else
			{
				echo '<script language="javascript">
				alert("User doesnot exist. Please register to join Mitho Pasal first.")
				</script>
			';

			}
		}
	}

function showall()
{
	$db=mysqli_connect('localhost','root','','cb');
	$query="SELECT * FROM product";
	$result=mysqli_query($db,$query);
	echo '<div class="row wow fadeIn">';
	while($row=$result->fetch_assoc())
	{
		echo
		'
		<div class="col-lg-3 col-md-6 mb-4">
		<br><br>
	        <div class="card">
	        <div class="view overlay">
	        <form method="post">
	        <input type="hidden" name="pid" value="'.$row['id'].'"/>
	        <button name="productd" style="background-color:transparent; border:none; outline:none;">
			<img height="300" width="250" alt="Image not found" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/></button></form>
			
	    </div>


	    	<hr>
		    <!--Card content-->
		    <div class="card-body">
		    <center>
		      <!--Title-->
		      <h4 class="card-title"><b>'.$row['name'].'</b></h4>
		      <!--Text-->
		       <p class="card-text"><b><h5>Price: <strong class="font-weight-bold blue-text">Rs.'.$row['price']. '</strong></h5></b><br>
		      <label><b>Quantity</b></label>
		      <form method="post">
		      <input type="hidden" name="id" value="'.$row['id'].'">
    			<input type="number" min="1" max="'.$row['quantity'].'" value="1" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Quantity" name="quantity">
					 <input type="hidden" name="price" value="'.$row['price'].'">
					 <input type="hidden" name="name" value="'.$row['name'].'">
		      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->';
		      if($row['quantity']==0)
		      {
		      	echo'<button name="order" disabled class="btn btn-blue btn-md">Out of Stock </button>';
		      }
		      else
		      {
		      	echo'<button name="cart" class="btn btn-blue btn-md">Add to Cart</button>';
		      }
		      echo'
		      </form>
		      </center>
		    </div>
		  </div>
		  </div>
		  <!-- Card -->

		';

	}
	echo'</div>';


}

function productdetail($id)
{
	$db=mysqli_connect('localhost','root','','cb');
	$query="SELECT * FROM product WHERE id='$id'";
	$result=mysqli_query($db,$query);
	$row=$result->fetch_assoc();
	$desc=nl2br($row['description']);
	echo '

	<center>
		<div style="display:inline-block; margin-top:7%;">
       <div class="view overlay" style="float:left;" ><br><br><br>
            <img style="margin-right:40px;"margin-top:40%;"  height="400" width="350" alt="Image not found" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>
               </div>

         <div class="card" style="margin-top:-5%; margin-left:70px; padding:0px 50px 20px 50px;">
           <div class="card-body text-center blue-te" ><br>
               <h2>
              		<strong>'.$row['name'].'
                     </strong>
                </h2><hr>
             <h5><b>Type: </b></h5><h5>'.$row['category'].'</h5><br>
             <h5><b>Description:</b></h5><h5>'.$desc. '</h5><br>
            <div style=" padding:0px 50px 0px 50px;">
               <h5><b>Price :</b></h5><h5>
                <strong class="font-weight-bold blue-text">Rs.'.$row['price']. '</strong>
                  </h5>
					 </div><br>
					 <form method="post">
					 <input type="hidden" name="id" value="'.$row['id'].'">
					 <input type="hidden" name="price" value="'.$row['price'].'">
					 <input type="hidden" name="name" value="'.$row['name'].'">
		      <label><b>Quantity</b></label>
    			<input type="number" min="0" max="'.$row['quantity'].'" value="1" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Quantity" name="quantity">';
    		
    			if($row['quantity']==0)
		      {
		      	echo'<button name="order" disabled class="btn btn-blue btn-md">Out of Stock </button>';
		      }
		      else
		      {
		      	echo'<button name="cart" class="btn btn-blue btn-md">Add to Cart</button>';
		      }
		      echo'</form>
                     </div>
                     </center><br><br>
                     ';
}

if (isset($_POST['cart']))
{
	if(isset($_SESSION['shopping_cart']))
	{
		$item_array_id=array_column($_SESSION['shopping_cart'],'id');
		if(!in_array($_POST['id'],$item_array_id))
		{
			$count=count($_SESSION['shopping_cart']);
			$item_array=array(
				'id'=>$_POST['id'],
				'name'=>$_POST['name'],
				'price'=>$_POST['price'],
				'quantity'=>$_POST['quantity']
			);
			$_SESSION['shopping_cart'][$count]=$item_array;
			echo '<script language="javascript">';
                echo 'alert("Item Added To Cart")';
                echo '</script>';
		}
	
	else if(in_array($_POST['id'],$item_array_id))
	{
		foreach($_SESSION['shopping_cart'] as $keys=>$values)
		{
			if($_POST['id']==$values['id'])
			{
				if($_POST['quantity']!=$values['quantity'])
				{
					$_SESSION['shopping_cart'][$keys]['quantity']=$_POST['quantity'];
					echo '<script language="javascript">';
                            echo 'alert("Item added to cart with new quantity")';
                            echo '</script>';         
				}
				else
				{
					echo '<script language="javascript">';
                            echo 'alert("Item already added to cart")';
                            echo '</script>';
				}
			}

		}
	}


}
	else
	{
		$item_array = array(
			'id' =>$_POST['id'] ,
			'name'=>$_POST['name'],
			'price'=>$_POST['price'],
			'quantity'=>$_POST['quantity']
			 );
		$_SESSION['shopping_cart'][0]=$item_array;
		echo '<script language="javascript">
         alert("Item Added To Cart")
            </script>';
	
	}
}

if (isset($_POST['clear']))
{
	echo'success';
	$_SESSION=array();
	session_destroy();
	header('location:cart.php');
}
if(isset($_POST['remove']))
{
	foreach($_SESSION['shopping_cart'] as $keys=>$values)
	{
		if($values['id']==$_POST['id'])
		{
			unset ($_SESSION['shopping_cart'][$keys]);
			header('location:cart.php');		
		}
	}
}

function showqa($id)
{

	echo'
	<hr><br>
	<!-- Table with panel -->
<div class="card card-cascade narrower" style="margin-left:15%; margin-right:15%;">

  <!--Card image-->
  
  <div
    class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 ">
	<center>
    <h2 class="white-text mx-3" style="margin-left:50%">Post your questions here</h2>
	</div>

  <!--/Card image-->

  <div class="px-4">

    <div class="table-wrapper">
      <!--Table-->
      <table class="table table-hover mb-0">

        <!--Table head-->
        <thead>
          <tr>
            <th class="th-lg" >
              <h5>Questions
                <i class="fas fa-sort ml-1"></i>
              </h5>
            </th>
            <th class="th-lg">
              <h5>Answers
                <i class="fas fa-sort ml-1"></i>
              </h5>
          </tr>
        </thead>
        <!--Table head-->

        <!--Table body-->
        <tbody>
        ';
        $db=mysqli_connect('localhost','root','','cb');
        $query="SELECT * FROM blog WHERE pid='$id'";
        $result=mysqli_query($db,$query);
        if($result)
     {
     	while($row=$result->fetch_assoc())
     	{
     		echo '
     		<tr>
     		<td>
     			'.$row['question'].'
     			<br><br>
     			'.$row['dt'].'
     			</td>';
     		if(empty($row['answer']))
     		echo'<td>NO ANSWER YET.</td>';
     	else
     		echo '
     		<td>
     			'.$row['answer'].'</td>
     		</tr>
     		';
     		}	
     	}
	        echo '
	          <tr>
	          <td >
	          <form method="post">
	          <input type="hidden" name="id" value="'.$id.'">
	          <textarea name="question" rows="4" cols="40"></textarea><br>
	          <button name="btn" class="btn btn-blue" style="margin-bottom:50px; ">Post Question</button></form>
	          </td>
	          </tr>
	            
	        </tbody>
	        <!--Table body-->
	      </table>
	      <!--Table-->
	    </div>

	  </div>

	</div>
	<!-- Table with panel -->
	';
}
if(isset($_POST['btn']))
{
	$id=$_POST['id'];
	$question=mysqli_real_escape_string($db,$_POST['question']);
	if(empty($question))
	{
		echo'<script language="javascript">
			alert("Please enter a question.")
			</script>';
	}
	else
{
	$query="INSERT INTO blog(pid,question,type,dt) VALUES('$id','$question','question',SYSDATE())";
	$result=mysqli_query($db,$query);
	if($result)
	{
		echo'<script language="javascript">
			alert("We will get back to you soon.")
			</script>';
	}
}
}


function showa()
{
	echo 
	'
			<hr><br>
		  <!-- Table with panel -->
		<div class="card card-cascade narrower" >

		  <!--Card image-->
		  
		  <div
		    class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 ">
		  <center>
		    <h2 class="white-text mx-3" style="margin-left:50%">Answer questions here</h2>
		  </div>

		 <table class="table table-bordered">
		  <thead>
		    <tr>
		      <th scope="col"><center><h5><b>Product Id</b></h5></center></th>
		      <th scope="col"><center><h5><b>Questions</b></h5></center></th>
		      <th scope="col"><center><h5><b>Answers</b></h5></center></th>
		      <th scope="col"><center><h5><b>Date And Time</b></h5></center></th>
		    </tr>
		  </thead>
		  <tbody>
		  	';
		  	$db=mysqli_connect('localhost','root','','cb');
		  	$query="SELECT * FROM blog";
		  	$result=mysqli_query($db,$query);
		  	if ($result)
		  	{
		  		while($row=$result->fetch_assoc())
		  		{
		  			$pid=$row['pid'];
		  			$query1="SELECT * FROM product WHERE id='$pid'";
		  			$result1=mysqli_query($db,$query1);
		  			$row1=$result1->fetch_assoc();
		  			$qid=$row['qid'];
		  			echo '		  			
		  			  <tr>
		  			  	<td><center><h6><b>
		  			  	'.$row['pid'].'</h6></center>

		  			  	</b><center>
		  			  	<img  height="120" width="90" alt="Image not found" src="data:image/jpeg;base64,'.base64_encode( $row1['photo'] ).'"/></center>
		  			  	<hr><center>
		  			  	<h5><b>
		  			  	'.$row1['name'].'
		  			  	</b></h5></center>
		  			  	</td>
		  			  	<td><h6><b>
		  			  	'.$row['question'].'</b></h6>
		  			  	</td>';
		  			if(empty($row['answer']))
		  			{
		  				echo'
		  				<td>
		  				<b>
					        <form method="post">
					         <input type="hidden" name="id" value="'.$qid.'">
					         <textarea name="answer1" rows="4" cols="30" style="margin-right: -180px;"></textarea><br>
					         <button name="answer" class="btn btn-blue" style="margin-bottom:50px; ">Post Answer</button></form>
					         </b>
					      </td>
		  				'; 
		  			}
		  			else
		  			{
		  				echo '
		  				<td><h6><b>
		  					'.$row['answer'].'</b></h6></td>
		  				';
		  			}
			  			echo'
			  			<td><h6><b>
			  				'.$row['dt'].'</b></h6>
			  			</td>
			  		</tr>

		  			';
		  	
		  		}
		  	}
		  	echo 
		  	'
		  </tbody>
		</table>
		</center>
		</div>
		</div>
		</div>
		';
}

if (isset($_POST['answer']))
{
	$id=$_POST['id'];
	$answer=mysqli_real_escape_string($db,$_POST['answer1']);
	if(empty($answer))
	{
		echo'
			<script language= "javascript">
			alert("Please enter an answer")
			</script>
		';
	}
	else
	{
		$query="UPDATE blog SET answer='$answer' WHERE qid='$id'";
		$result=mysqli_query($db,$query);
		if ($result)
		{
			echo'<script language="javascript">
				alert("Answer Posted")
				</script>
			';
		}
	}
}
	
function showp()
{
	echo'
		<br><hr>
		    <div class="card card-cascade narrower" >
		 <table class="table table-bordered">
		    <thead>
		      <tr>
		        <th scope="col"><h5><b>Product Id</b></h5></th>
		        <th scope="col"><h5><b>Product Name</b></h5></th>
		        <th scope="col"><h5><b>Category</b></h5></th>
		        <th scope="col"><h5><b>Quantity</b></h5></th>
		        <th scope="col"><h5><b>Sold Out</b></h5></th>
		        <th scope="col"><h5><b>Photo</b></h5></th>
		        <th scope="col"><h5><b>Price</b></h5></th>
		        <th scope="col"><h5><b>Description</b></h5></th>
		      </tr>
		    </thead>
		    <tbody>
		    ';
		    $db=mysqli_connect('localhost','root','','cb');
		    $query="SELECT * FROM product ";
		    $result=mysqli_query($db,$query);
		    if($result)
		    {
		    	while($row=$result->fetch_assoc())
		    	{
		    		$desc=nl2br($row['description']);
				    echo'
				      <tr>   
				        <td><center><h6><b><strong >'.$row['id']. '</strong></h5></b></b></h6></center></td>
				        <td><center><h6><b><strong >'.$row['name']. '</strong></h5></b></b></h6></center></td>
				        <td><center><h6><b><strong >'.$row['category']. '</strong></h5></b></b></h6></center></td>
				        <td><center><h6><b><strong >'.$row['quantity']. '</strong></h5></b></b></h6></center></td>
				        <td><center><h6><b><strong >'.$row['soldout']. '</strong></h5></b></b></h6></center></td>
				        <td><center>
				        <img  height="120" width="90" alt="Image not found" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/></center>
				        </td>
				        <td><center><h6><b><strong class="font-weight-bold blue-text">Rs.'.$row['price']. '</strong></h5></b></b></h6></center></td>
				   		<td><center><h6><b><strong class="font-weight-bold blue-text">'.$desc. '</strong></h5></b></b></h6></center></td>
				      </tr>';
				  }
				 }
		 echo'
		  </tbody>
		  </table>
		  </div>
		  ';
}


function showu()
{
	echo'
		<br><hr>
		    <div class="card card-cascade narrower" >
		 <table class="table table-bordered">
		    <thead>
		      <tr>
		        <th scope="col"><h5><b>Id</b></h5></th>
		        <th scope="col"><h5><b>Product Name</b></h5></th>
		        <th scope="col"><h5><b>Category</b></h5></th>
		        <th scope="col"><h5><b>Quantity</b></h5></th>
		        <th scope="col"><h5><b>Photo</b></h5></th>
		        <th scope="col"><h5><b>Price</b></h5></th>
		        <th scope="col"><h5><b>Description</b></h5></th>
		      </tr>
		    </thead>
		    <tbody>
		    ';
		    $db=mysqli_connect('localhost','root','','cb');
		    $query="SELECT * FROM product ";
		    $result=mysqli_query($db,$query);
		    if($result)
		    {
		    	while($row=$result->fetch_assoc())
		    	{
		    		$desc=nl2br($row['description']);
		    		$pid=$row['id'];
				    echo'
				      <tr> 
				        <form method="post">  
				        <td><center><h6><b><strong>'.$row['id'].'</strong></h5></b></b></h6></center></td>

				        <td><center><h6><b><strong >'.$row['name'].'</strong></h5></b></b></h6></center><br>
		
				        <input type="hidden" name="id" value="'.$pid.'">
				        <input type="text" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Name "name="uname">
				         <button name="updatename" class="btn btn-blue" style="margin-bottom:50px; ">Update Name</button>
				        </td>

				        <td><center><h6><b><strong>'.$row['category'].'</strong></h5></b></b></h6></center><br>
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
						    <button name="updatec" class="btn btn-blue" style="margin-bottom:50px; ">Update Category</button>
				        </td>

				        <td><center><h6><b><strong >'.$row['quantity'].'</strong></h5></b></b></h6></center><br>
    						<input type="number"  max="30" value="1" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Quantity" name="uqty">
					         <button name="updateq" class="btn btn-blue" style="margin-bottom:50px;margin-right:-0px;">Update Quantity</button>
				        </td>
				        <td><center>
				        <img  height="120" width="90" alt="Image not found" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/></center><br>
				        </td>

				        <td><center><h6><b><strong class="font-weight-bold blue-text">Rs.'.$row['price'].'</strong></h5></b></b></h6></center><br>
				        <input type="text" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Update " name="uprice" >
				         <button name="updateprice" class="btn btn-blue" style="margin-bottom:50px; ">Update Price</button>
				        </td>
				   		<td><center><h6><b><strong >'.$desc.'</strong></h5></b></b></h6>
				   		<textarea name="desc" rows="4" cols="30"></textarea>
				   		</center>
				   		<button name="updatedesc" class="btn btn-blue" style="margin-bottom:50px; ">Update Description</button>
				   		</td>
				   		</form>
				      </tr>';
				  }
				 }
		 echo'
		  </tbody>
		  </table>
		  </div>
		  ';
}

if(isset($_POST['updatename']))
{
	$id=$_POST['id'];
	$uname=$_POST['uname'];
	if(empty($uname))
	{
		echo'<script language="javascript">
			alert("Please enter a name to update")
			</script>
		';
	}
	else
	{
	$query1="UPDATE product SET name='$uname' WHERE id='$id' ";
	$res=mysqli_query($db,$query1);
	if($res)
	{
	echo'<script language="javascript">
			alert("Name updated successfully")
			</script>
		';
	}
	}
	
}

if(isset($_POST['updatec']))
{
	$id=$_POST['id'];
	$category1=$_POST['category'];
	if(empty($category1))
	{
		echo'<script language="javascript">
			alert("Please enter category to update")
			</script>
		';
	}
	else
	{
		$query="UPDATE product SET category='$category1' WHERE id='$id'";
		$result=mysqli_query($db,$query);
		if ($result)
		{
		echo'<script language="javascript">
			alert("Category updated successfully")
			</script>
		';
		}
	}
	
}

if(isset($_POST['updateq']))
{
	$id=$_POST['id'];
	$quantity=$_POST['uqty'];
		$query="UPDATE product SET quantity='$quantity' WHERE id='$id'";
		$result=mysqli_query($db,$query);
		if ($result)
		{
		echo'<script language="javascript">
			alert("Quantity updated successfully")
			</script>
		';
		}

	
}
if(isset($_POST['updateprice']))
{
	$id=$_POST['id'];
	$uprice=$_POST['uprice'];
	if(empty($uprice))
	{
		echo'<script language="javascript">
			alert("Please enter price to update")
			</script>
		';
	}
	else
	{
		$query="UPDATE product SET price='$uprice' WHERE id='$id'";
		$result=mysqli_query($db,$query);
		if ($result)
		{
		echo'<script language="javascript">
			alert("Price updated successfully")
			</script>
		';
		}

	}	
}

if(isset($_POST['updatedesc']))
{
	$id=$_POST['id'];
	$desc=mysqli_real_escape_string($db,$_POST['desc']);
	if(empty($desc))
	{
		echo'<script language="javascript">
			alert("Please enter description to update")
			</script>
		';
	}
	else
	{
		$query="UPDATE product SET description='$desc' WHERE id='$id'";
		$result=mysqli_query($db,$query);
		if ($result)
		{
		echo'<script language="javascript">
			alert("Description updated successfully")
			</script>
		';
		}

	}	
}

function givereview($username)
{
	$db=mysqli_connect('localhost','root','','cb');
	$query="SELECT * FROM user WHERE username='$username'";
	$result=mysqli_query($db,$query);
	$row=$result->fetch_assoc();
	  echo'
   		 <!--Modal: Login with Avatar Form-->
        <div class="modal fade" id="modalLoginAvatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
            <!--Content-->
            	 <div style="margin-left:-15%; margin-right:-15%;">
            <div class="modal-content">

              <!--Header-->
              <div class="modal-header">

              <img class="rounded-circle img-responsive"   alt="Image not found" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'">
              </div>
              <!--Body-->
              <div class="modal-body text-center mb-1">

                <h5 class="mt-1 mb-2"><b>'.strtoupper($row['fname'])." ".strtoupper($row['lname']).'</b></h5>
                <form method="post" >
                <div class="md-form ml-0 mr-0">
                <textarea type="text" id="form8" class="md-textarea form-control" rows="6" name="message"></textarea>
                Your message
                </div>
                 <center style="color:black;"><b> Rate us from 1-5<b></center>
                <div class="d-flex justify-content-center my-4 pt-3">
      <span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-thumbs-down" aria-hidden="true"></i></span>
    
        <input class="custom-range" type="range" min="0" max="5" name="rating"/>

      <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span>

    </div>
      <h6 style="margin-left:5px;"><strong><b>0 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp1 &nbsp  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp 2 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp  3  &nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp  4 &nbsp&nbsp&nbsp&nbsp&nbsp &nbsp &nbsp &nbsp  5  </b> </strong> </h6>
                <div class="text-center mt-4">
                  <button class="btn btn-default" name="review"> Send <i class="fas fa-sign-in ml-1"></i></button>
                </div>
                </form>
              </div>

            </div>
            </div>
            <!--/.Content-->
          </div>
        </div>
        <!--Modal: Login with Avatar Form-->

        <div class="text-center">
          <a href="" class="btn btn-default btn-rounded" data-toggle="modal" data-target="#modalLoginAvatar">Give a Review</a>
        </div>
  ';

 if(isset($_POST['review']))
 {
 	$message=$_POST['message'];
 	$rating=$_POST['rating'];
 	if(empty($message))
 	{
 		echo'
 		<script language="javascript">
 		alert("Please enter your review.")
 		</script>
 		';
 	}
 	else
 	{
 		$query1=" INSERT INTO blog (question,type,username,rating) VALUES('$message','review','$username','$rating') ";
 		$result1=mysqli_query($db,$query1);
 		if($result1)
 		{
 			echo
 			'
		 		<script language="javascript">
		 		alert("Thank you for your review.")
		 		</script>
 			';
 			//header("Refresh:0");
 		}
 		else
 		{
 			echo mysqli_error($db);

 		}
 	}
 }
}

function showreview()
{
	$db=mysqli_connect('localhost','root','','cb');
	$query="SELECT * FROM blog WHERE rating >'1' AND type='review'";
	$result=mysqli_query($db,$query);
	if($result)
		if(mysqli_num_rows($result) > 0 )
		{
			while($row=$result->fetch_assoc())
			{
			$user=$row['username'];
			$query1="SELECT * FROM user WHERE username='$user'";
			$result1=mysqli_query($db,$query1);
			$row1=$result1->fetch_assoc();
			echo'
			<ul class="list-unstyled" style="margin-left: 5%;margin-right: 20%">
		  <li class="media">
		    <img class="d-flex mr-3" src="data:image/jpeg;base64,'.base64_encode( $row1['photo'] ).'" alt="Generic placeholder image" height="80" width="80">
		    <div class="media-body">
		      <h5 class="mt-0 mb-2 font-weight-bold">'.strtoupper($row1['fname'])." ".strtoupper($row1['lname']).'</h5>
		      <!--Review-->';
		      $star=$row['rating'];
		      for($i='1';$i<=($star);$i++)
		      {
		      echo'
		      <i class="fas fa-star blue-text"> </i>';
			  }
			  for($j=($star);$j<'5';$j++)
			  {
			  	echo'
			  	 <i class="fas fa-star"> </i>';
			  }
			 /* for($i=1;$i<=5;$i++)
			  {
			  	if($i<=$star)
			  	{
			  		echo'
		      	<i class="fas fa-star blue-text"> </i>';
			  	}
			  	else
			  	{
			  		echo'
			  	 <i class="fas fa-star"> </i>';
			  	}
			  }*/
				  echo'
			      <p>'.nl2br($row['question']).'</p>
			    </div>
			  </li>
			</ul>
				';
			}
		}
		else{
			echo '<h1 style="color:red;"><center> No Review </center></h1>';
		}
	else{
			echo '<h1 style="color:red;"><center> No Review </center></h1>';
		}
}