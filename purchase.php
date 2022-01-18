
<script>
	//check if the user is logged in, otherwise redirect to the index page
	//prevent user circumventing the log in
	if (sessionStorage.getItem("user") === null) {
		location.replace("index.html");
}
</script>

<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();


if(!empty($_GET["action"])) {
  switch($_GET["action"]) {
    
    case "remove":
      if(!empty($_SESSION["cart_item"])) {
        //go through each item in the cart
        foreach($_SESSION["cart_item"] as $k => $v) {
            //if the item is found in the cart, then remove it from the session array
            if($_GET["product_ID"] === $_SESSION["cart_item"][$k]['product_ID'])
              unset($_SESSION["cart_item"][$k]);	
            //the the cart is empty then clear the session variable			
            if(empty($_SESSION["cart_item"]))
              unset($_SESSION["cart_item"]);
        }
      }
    break;
    case "purchase":
      //check if something in the cart
      if(!empty($_SESSION["cart_item"])) {
        
        //empty the cart
        unset($_SESSION["cart_item"]);


        //generate a random order number picking a number between 100000 and 1000000
        $orderId = "A2021". rand(100000,1000000);
        //redirect to the order summary page passing the order number and the total cost
        header('Location: orderSummary.php?orderID='.$orderId . '&totalCost='.$_GET["totalCost"]);
      }
    break;
    case "empty":
      unset($_SESSION["cart_item"]); //empty the cart
    break;	
  }
} 
?>
<HTML>
<HEAD>
<TITLE>Purchase Toys</TITLE>


    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
      crossorigin="anonymous"
    />

  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


	<link rel="stylesheet" href="myStyle.css" type="text/css"  />


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  
  <style>
     .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</HEAD>
<BODY>




   <!-- Bootstrap navbar-->

   <?php
    include 'nav.php';
    ?>

  
  <!-- END of Nav component -->


<!-- main body of the page, divided into two sections -->
 <div class="container-fluid">
	 <div class = "row">
	
     <div class="col-md-5 col-lg-7">

        <div id="product-grid" >
          <div class="txt-heading"><h5>Fidget Toy Purchase</h5></div>


        <!--Purchase form adapted from https://getbootstrap.com/docs/4.0/examples/checkout/ -->
        <h4 class="mb-3">Address</h4>

        <?php 
          $totalCost = $_GET["totalCost"];

           echo '<form class="needs-validation" novalidate method="POST" action="purchase.php?action=purchase&totalCost=' .$totalCost.'">';?>
          <div class="row g-3">
            <div class="col-sm-12">
              <label for="firstName" class="form-label "><i class="fa fa-user"></i> Full name</label>
              <input type="text" class="form-control form-control-sm" id="firstName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid name is required.
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label"><i class="fa fa-envelope"></i> Email </label>
              <input type="email" class="form-control form-control-sm" id="email" required>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label"><i class="fa fa-address-card-o"></i> Address</label>
              <input type="text" class="form-control form-control-sm" id="address"  required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label"><i class="fa fa-institution"></i> City</label>
              <input type="text" class="form-control form-control-sm" id="country" required>
              <div class="invalid-feedback">
                Please enter a city.
              </div>
              
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
              <input type="text" class="form-control form-control-sm" id="state" required>
         
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" class="form-control form-control-sm" id="zip" placeholder="" required>
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>

          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>


          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Name on card</label>
              <input type="text" class="form-control form-control-sm" id="cc-name" placeholder="" required>
              <small class="text-muted">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Credit card number</label>
              <input type="text" class="form-control form-control-sm" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiration Month</label>
             <!-- <input type="text" class="form-control form-control-sm" id="cc-expiration" placeholder="" required> -->
              <select required class="form-select form-control-sm" id="cc-expiration" placeholder="">
                    <option value=""></option>
                    <option value="01">January</option>
                    <option value="02">February </option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
              <div class="invalid-feedback">
                Expiration month required
              </div>
            </div>    

           <div class="col-md-3">    
              <label for="cc-cvv" class="form-label">Expiration Year</label>
              <!-- <input type="text" class="form-control form-control-sm" id="cc-cvv" placeholder="" required> -->
              <select class="form-select form-control-sm" id="cc-cvv" placeholder="" required>
                    <option value=""> </option>
                    <option value="16"> 2021</option>
                    <option value="17"> 2022</option>
                    <option value="18"> 2023</option>
                    <option value="19"> 2024</option>
                </select>
              <div class="invalid-feedback">
                Expiration year required
              </div>
            </div>
        

            <div class="col-md-2">
                <label for="cc-cvv" class="form-label">CVV</label>
                <input type="text" class="form-control form-control-sm" id="cc-cvv" maxlength="3" required> 
                <div class="invalid-feedback">
                  Security code required
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
      </div>
      
          </div>
          </div>
          <hr class="my-4">
          <div class="row g-3" >
          <div class="col-md-5">
         
          <a role="button" class = "btn btn-secondary" href="shop.php">Cancel</a>
             <button class=" btn btn-primary " id="payBtn" type="submit" value=" Pay " >&nbsp; Pay &nbsp;</button>
          </div>
        </form>

    </div>
    </div>
  
     
    	<!-- hold shopping basket to the right -->
		<div class= "col-lg-5"  >  
			
			<div id="shopping-cart" style = "border: 3px solid #e0e0e0;" style="float:right" >
				<div class="txt-heading"><h5>Shopping Cart</h5></div>


        <a role = "button" class="btn btn-secondary" id="btnEmpty" href="shop.php?action=empty">Empty Cart</a>
				<?php
				if(isset($_SESSION["cart_item"])){
				
					$total_quantity = 0;
					$total_price = 0;
					include 'shoppingBasket.php';
         
					?>
				  <script>
            // show the total amt due in the Pay button      
            buttonTxt = document.getElementsByTagName("button")[2].value;
            var totalCost = '<?php echo "€".number_format($total_price, 2); ?>';
            buttonTxt = buttonTxt + " "+ totalCost;
            document.getElementsByTagName("button")[2].innerHTML = buttonTxt;
          </script>
			<?php
			} else {
			?>
				<div class="no-records">Your Cart is Empty</div>
			<?php 
			}
			?>

				</div>
			</div>
		</div>
     
 
</div>

<!-- page footer -->
<?php
    include 'footer.php';
?>
<!-- END of footer component -->

<script>
  //set nav bar colour to the user choice
	document.getElementsByTagName("nav")[0].style.backgroundColor = sessionStorage.navColour;
  //set the greeting
	document.getElementsByTagName("p")[0].innerHTML = "Hello " + sessionStorage.user + "!";

  //when the user logs out; unset the user session variable and redirect to the index page
	function logOut(){
		sessionStorage.removeItem("user");
		location.replace("index.html");

	}


</script>
<script src="form-validation.js"></script>
</BODY>
</HTML>