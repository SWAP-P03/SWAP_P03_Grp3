<html>
<title>Biling</title>
<head>
<style>
body 
{
    background-image:url("https://amazingpict.com/wp-content/uploads/2015/02/blurred-texture.jpg");
    min-height: 100%;
    background-position: center;
    background-size: cover;
    
}
h1 
{
    color: white;
    text-align: center;
    vertical-align: middle;
    line-height: 90px; 
    font-size: 40px;
    font-family: Courier;
}
h2
{
 	color: white;
    text-align: center;
    font-size: 25px;
	font-family: Courier;
}
p 
{
    font-family: Courier;
    font-size: 20px;
    color: white;
	text-align:center;
}
br
{
   display: block;
   margin: 20px 0;
}
.picLeft
{
    float: left;
    margin: 20px 100px 100px 100px;
}
.topnav 
{
  overflow: hidden;
  background-color: #333;
}
.topnav a 
{
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}
.topnav a.active 
{
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
<body>

<div class="topnav">
  <a class="active" href="shopmenu.php">Home</a>
  <a href="404.php">Search</a>
  <a href="listing.php">Listing</a>
  <a href="404.php">Profile</a>
</div>

<A href="shopmenu.php">
<div style= "text-align: center;"><img src="https://i.pinimg.com/originals/95/98/b4/9598b485d75c30986078655d68259c62.png" alt="logo" ></div>
</a>

<h1>Biling Information</h1>
<br>
<?php 
//define variables and set to empty values
$paymentErr = " ";
$payment = " ";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty($_POST["payment"]))
    {
        $paymentErr = "Please select the method of payment.";
    }
    else
    {
        $payment = test_input($_POST["payment"]);
    }
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<h2>Payment by: </h2>
<p>
<input type="radio" name="payment" <?php if(isset($payment) && $payment=="Cash") echo "checked";?> value="Cash">Cash
<input type="radio" name="payment" <?php if(isset($payment) && $payment=="Debit Card") echo "checked";?> value="Debit Card">Debit Card
<input type="radio" name="payment" <?php if(isset($payment) && $payment=="PayPal") echo "checked";?> value="PayPal">PayPal
<span class="error">*<?php echo $paymentErr;?></span></p>
<br><br><br>

<input type="submit" name="submit" value="Submit">
</form>
<br>

<?php 
echo "<p>Payment Method: </p>";
echo "<p>$payment</p>";
echo "<br>";
?>

<br><br><br>
<A href="404.php">
<img src="http://assets.nydailynews.com/polopoly_fs/1.436353.1314550064!/img/httpImage/image.jpg_gen/derivatives/article_750/alg-tiger-energy-ad-jpg.jpg" alt="Go" width="x" height="250">
</a>
<A href="404.php">
<img src="http://i0.kym-cdn.com/photos/images/facebook/000/004/374/smakesontheplane568cq.jpg" alt="Go" width="x" height="250">
</a>
<A href="404.php">
<img src="http://images.gawker.com/18k2qiytfcch0jpg/c_fit,fl_progressive,q_80,w_470.jpg" alt="Go" width="400" height="250">
</a>
</body>
</html>
