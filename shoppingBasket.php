<!-- Displays the cart stored in session variable -->
<table class="tbl-cart" cellpadding="10" cellspacing="1"  width=100%">
	<tbody>
		<tr>
			<th></th>
			<th style="text-align:center;"width="50%">Name</th>
			<th style="text-align:right;" width="5%">Quantity</th>
			<th style="text-align:right;" width="20%">Unit Price €</th>
			<th style="text-align:right;" width="20%">Price €</th>
			<th style="text-align:center;" width="5%">Remove</th>
			</tr>

<?php		
				//loop through each item in $_SESSION["cart_item"]
				foreach ($_SESSION["cart_item"] as $item){
					$item_price = $item["quantity"]*$item["price"];
                    
					?>		
							<!-- display the items in a table-->
							<tr>
							<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image"  /></td>
							<td style="text-align:center;"><?php echo $item["name"]; ?></td>
							<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
							<td  style="text-align:right;"><?php echo $item["price"]; ?></td>
							<td  style="text-align:right;"><?php echo number_format($item_price,2); ?></td>
							<td style="text-align:center;"><a href="shop.php?action=remove&product_ID=<?php echo $item["product_ID"]; ?>" class="btnRemoveAction"><img src="images/icon-delete.png" alt="Remove Item" /></a></td>
							</tr>
							<?php
							//calculate the total quanity and price
							$total_quantity += $item["quantity"];
							$total_price += ($item["price"]*$item["quantity"]);
					} 
					?>
		<!-- in the last row of the table show the totals -->
		<tr style="border-top: 1px solid #e0e0e0;">
			<td></td>
			<td align="right">Total:</td>
			<td align="right"><?php echo $total_quantity; ?></td>
			<td align="right" colspan="2"><strong><?php echo "€".number_format($total_price, 2); ?></strong></td>
			<td></td>
		</tr>
	</tbody>
</table>
		
			