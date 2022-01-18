

<script>
	//check if the user is logged in, otherwise redirect to the index page
	//prevent user circumventing the log in
	if (sessionStorage.getItem("user") === null) {
		location.replace("index.html");
}
</script>
<?php

session_start(); //start a session 
//include database connection 
require_once("dbcontroller.php");
//connect to my database G00375722
$db_handle = new DBController();

/* php basket code taken from https://phppot.com/php/simple-php-shopping-cart. It has been adapted and commented and some bug 
fixes added by me- such as preventing items being added again when the page is refreshed; the code adding duplicate
entries to the basket and fixed a bug in the item removal code.
*/
if(!empty($_GET["action"])) {  //grab the action from the url (add or remove)
switch($_GET["action"]) {
	// 'add' adds the product to the basket
	case "add":
		if(!empty($_POST["quantity"])) { //if the qanity is not empty
			//$productResult holds the result from db query where product matches the product name grabbed from url
			$productResult = $db_handle->runQuery("SELECT * FROM products WHERE name ='" . $_GET["name"] . "'");
			//$itemArray is an associative array. Keys are assigned to the values from the runQuery result
			$itemArray = array($productResult[0]["name"]=>array('name'=>$productResult[0]["name"], 'product_ID'=>$productResult[0]["product_ID"], 'quantity'=>$_POST["quantity"], 'price'=>$productResult[0]["price"], 'image'=>$productResult[0]["image"]));
				//checks if there is something in the cart (session data)
				if(!empty($_SESSION["cart_item"])) {
					//Check if the product is in the cart
					if(in_array($productResult[0]["name"],array_keys($_SESSION["cart_item"]))) {
						//go through each cart item
						foreach($_SESSION["cart_item"] as $k => $v) {
							//check if the product name matches a productname in the cart
							if($productResult[0]["name"] === $_SESSION["cart_item"][$k]['name']) {
								//if user tries to add an item but the quanity is empty
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								//if there is a matching item in the cart then update the quanity
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				//add another item to the cart (session array)
				} elseif(!in_array($productResult[0]["name"],array_keys($_SESSION["cart_item"]))) {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					
				}
			} 
			else {
				$_SESSION["cart_item"] = $itemArray; //add 1st item to the cart 
			}
		}
	
	break;
	// delete item from the cart
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
	//empty the cart
	case "empty":
		unset($_SESSION["cart_item"]);//resets the variable
	break;	
}
//clear the url of parameters. in the case the browser is refreshed . it will prevent an item being updated in the basket
 header('Location: shop.php'); 
} 
?>
<HTML>
<HEAD>
<TITLE>Fidget Toy Shop</TITLE>


    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
      crossorigin="anonymous"
    />

  
   <!-- Bootstrap Javascript plugins -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<!-- myStyle.css contains the customised styling for this site-->
	<link rel="stylesheet" href="myStyle.css" type="text/css"  />
</HEAD>
<BODY>

   <!-- Bootstrap navbar. It is set with a sticky top. Javascript is used to set the nav colour using DOM-->

   <!-- Bootstrap navbar-->

   <?php
    include 'nav.php';
    ?>
   
  <!-- END of Nav component -->
   

<!-- main body of the page, divided into two sections -->
<div class="container-fluid">
	<div class = "row">
		<!-- hold the product catalog to the left -->
		<div class = "col-lg-7" >
			<div id="product-grid" >
				<div class="txt-heading"><h5>Product Catalog</h5></div>
				<!-- displays the products-->
				<?php
					//select all products from the products table in G00375722 db
					$product_array = $db_handle->runQuery("SELECT * FROM products order by name asc");
					/*if there are results then for each item in the product_array display 
					an image, name, price
					*/
					if (!empty($product_array)) { 
						foreach($product_array as $key=>$value){
				?>
				<div class="product-item"  >
					<!-- form posts to the page itself sending the action 'add' and the name of the product -->
					<form method="post" action="shop.php?action=add&name=<?php echo $product_array[$key]["name"]; ?>">
					<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>" style="height: 100px; width: 100px";></div>
					<div class="product-tile-footer">
					<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
					<div class="product-price"><?php echo "€".$product_array[$key]["price"]; ?></div>
					<!-- quanity is required and cannot be less than 1-->
					<div class="cart-action"><input type="number" class="product-quantity form-control-sm" name="quantity" min="1" value="1" size="2" style="width:40%; height:15%;" required/><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
				</div>
				</form>
			</div>
				<?php
					}
				}
				?>
		</div>

		</div>
		
		
		
		<!-- hold shopping basket to the right -->
		<div class= "col-lg-5" >  
			
			<div id="shopping-cart" style = "border: 3px solid #e0e0e0;" >
				<div class="txt-heading"><h5>Shopping Cart</h5></div>
				<!-- if the empty button is clicked the shop.php page calls itself with the action 'empty' -->
				<a role = "button" class="btn btn-secondary" id="btnEmpty" href="shop.php?action=empty">Empty Cart</a>
				<?php
				//if there are items in the shopping cart
				if(isset($_SESSION["cart_item"])){
					//set totals to zero
					$total_quantity = 0;
					$total_price = 0;
					//shopping basket functionality is included as it is used also in the purchase page
					include 'shoppingBasket.php';
					//the checkout button in the shopping basket call the purchase page with the total price.
					echo '<a role="button" class = "btn btn-primary" href="purchase.php?totalCost='. $total_price.'" >Check out</a>';
					?>
			<?php
			} else {
			?>
				<!-- if the basket is empty show message-->
				<div class="no-records">Your Cart is Empty</div>
			<?php 
			}
			?>
			</div>

		</div>
	</div>
</div>

<!--page footer -->
<?php
      
    include 'footer.php';
?>

<!-- END of page footer -->


<script>
	//set the nav colour to the colour selected by the user
	document.getElementsByTagName("nav")[0].style.backgroundColor = sessionStorage.navColour;
	//add a greeting to the nav bar
	document.getElementsByTagName("p")[0].innerHTML = "Hello " + sessionStorage.user + "!";

	//when the user logs out; unset the user session variable and redirect to the index page
	function logOut(){
		sessionStorage.removeItem("user");
		location.replace("index.html");

	}
</script>
</BODY>
</HTML>