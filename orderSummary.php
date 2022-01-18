<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();




if(!empty($_GET["action"])) {
  switch($_GET["action"]) {
    
    
  }
} 
?>
<HTML>
<HEAD>
<TITLE>Order Summary</TITLE>


    <!-- Bootstrap CSS -->
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">



  

	

	<link rel="stylesheet" href="myStyle.css" type="text/css"  />
	
</HEAD>
<BODY>

   <!-- navbar-->
     <!-- Bootstrap navbar-->

   <?php
    include 'nav.php';
    ?>

  
  <!-- END of Nav component -->

   

<!-- main body of the page, divided into two sections -->
<div class="container-fluid">
	<div class = "row">
    <div class="col-lg-3"></div>
		<!-- hold the product catelog to the left -->
		<div class = "col-lg-6" >
    <br><br>
				<div class="txt-heading"><h3>Order Number:</h3></div>

        <br><br>
        <div class="jumbotron">
            <h1 class="display-4"><?php echo htmlspecialchars($_GET["orderID"]) ?></h1>
            
            <hr class="my-4">
            <p class="lead">Thank you for your order. An order summary has been emailed to your account.</p>
            <p>The total cost of your order is: €<?php echo htmlspecialchars($_GET["totalCost"]) ?></p>
            <p class="lead">
              <a class="btn btn-primary btn-lg" href="shop.php" role="button">Continue Shopping</a>
            </p>
            <br>
        </div>
        <div class="col-lg-3"></div>

        




      </div>
    

		</div>
    <div class = "row">
        <div class = "col-lg-12" >
        <hr class="my-4">
   
        <a href="shop.php"><img src="images/rainbowPopIts.jpg" class="img-thumbnail" alt="Rainbow Pop Its"> </a>

        <a href="shop.php"><img src="images/metallicSpinners.jpg" class="img-thumbnail" alt="metallic Spinners"> </a> 

        <a href="shop.php"><img src="images/peaPopIt.jpg" class="img-thumbnail" alt="Pea Pop Its"> </a>

        <a href="shop.php"><img src="images/squishees.jpg" class="img-thumbnail" alt="Squishees"> </a>

        <a href="shop.php"><img src="images/tangle.jpg" class="img-thumbnail" alt="Tangle Twister"> </a>

        <a href="shop.php"><img src="images/keyringPresses.jpg" class="img-thumbnail" alt="Keyring Popit Presser"> </a>

        <a href="shop.php"><img src="images/netBallSelection.jpg" class="img-thumbnail" alt="Netball selection"> </a>

        <a href="shop.php"><img src="images/selection2.jpg" class="img-thumbnail" alt="Fidget Toy selection"> </a>

        <a href="shop.php"><img src="images/pocketCubeFidgetSkull.jpg" class="img-thumbnail" alt="Fidget Skull"> </a>
        </div>
    
	</div>

    <!--page footer -->
  <?php
        include 'footer.php';
    ?>
    <!-- END of page footer -->



<script>



	document.getElementsByTagName("nav")[0].style.backgroundColor = sessionStorage.navColour;

	document.getElementsByTagName("p")[0].innerHTML = "Hello " + sessionStorage.user + "!";

</script>
</BODY>
</HTML>