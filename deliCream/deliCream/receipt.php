<form action="backend.php" method="POST">
<label>Flavor:

<input type="text" name="flavor" value="Strawberry">

</label><br>

<label>Toppings:<br>

<input type="checkbox" name="toppings[]" value="Sprinkles"> Sprinkles<br>

<input type="checkbox" name="toppings[]" value="Chocolate Syrup"> Chocolate Syrup<br>

<input type="checkbox" name="toppings[]" value="Whipped Cream"> Whipped Cream<br>

</label>

<label>Quantity:

<input type="number" name="quantity" value="2">

</label><br>

<label>Price per item:

<input type="number" name="price" step="0.01" value="59.00">

</label><br>

<button type="submit">Generate Receipt</button>

</form>