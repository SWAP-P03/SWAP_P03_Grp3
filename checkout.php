<html>
<head>
<title>Order List</title>
</head>
<style>
body 
{
    background-image:url("https://amazingpict.com/wp-content/uploads/2015/02/blurred-texture.jpg");
    min-height: 100%;
    background-position: center;
    background-size: cover;
	font-size: 19px;
}
h1 
{
    color: white;
    text-align: center;
    vertical-align: middle;
    line-height: 20px; 
    font-size: 40px;
    font-family: Courier;
}
h2
{
 	color: white;
    text-align: left;
    font-size: 25px;
}
p 
{
    font-family: Courier;
    text-align: center;
    vertical-align: middle;
    line-height: 30px; 
    font-size: 20px;
    color: white;
}
p1
{
    font-family: Courier;
    font-size: 20px;
    color: white;
}
br
{
   display: block;
   margin: 20px 0;
}
table
{
    width: 50%;
    margin: 30px auto;
    border-collapse: collapse;
    text-align: left;
}
tr 
{
    border-bottom: 1px solid #cbcbcb;
}
th, td
{
    border: none;
    height: 30px;
    padding: 2px;
}
tr:hover 
{
    background: #F5F5F5;
}

form 
{
    width: 45%;
    margin: 50px auto;
    text-align: left;
    padding: 20px; 
    border: 1px solid #bbbbbb; 
    border-radius: 5px;
}
.picLeft
{
    float: left;
    margin: 20px 100px 100px 100px;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}
.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
.error
{
    font: Courier;
    font-size: 20px;
    color: #FF0000;
}
.button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
.input-group 
{
    margin: 10px 0px 10px 0px;
}
.input-group label 
{
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input 
{
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}
.btn 
{
    padding: 10px;
    font-size: 15px;
    color: white;
    background: #5F9EA0;
    border: none;
    border-radius: 5px;
}
.edit_btn 
{
    text-decoration: none;
    padding: 2px 5px;
    background: #2E8B57;
    color: white;
    border-radius: 3px;
}

.del_btn 
{
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    border-radius: 3px;
    background: #800000;
}
.msg 
{
    margin: 30px auto; 
    padding: 10px; 
    border-radius: 5px; 
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    width: 50%;
    text-align: center;
}
</style>
</head>
<body>

<div class="topnav">
  <a href="shopmenu.php">Home</a>
  <a href="#news">Search</a>
  <a href="listing.php">Listing</a>
  <a href="#about">Profile</a>
</div>
<br>
<A href="shopmenu.php">
<div style= "text-align: center;"><img src="https://image.ibb.co/fMVFcw/Logomakr_2_ICOKh.png" alt="logo"></div>
</a>

<h1>Order List</h1>

<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>

<?php 
	$db = mysqli_connect('localhost', 'root', '', 'tpshop');
	// initialize variables
	$itemid = "";
	$size = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) 
	{
		$itemid = $_POST['itemid'];
		$size = $_POST['size'];
		mysqli_query($db, "INSERT INTO order1 (itemid, size) VALUES ('$itemid', '$size')"); 
		$_SESSION['message'] = "Size saved"; 
	}
	
	if (isset($_POST['update'])) 
	{
	$id = $_POST['id'];
	$itemid = $_POST['itemid'];
	$size = $_POST['size'];
	mysqli_query($db, "UPDATE order1 SET itemid='$itemid', size='$size' WHERE id=$id");
	$_SESSION['message'] = "List updated!"; 
	}
	
	if (isset($_GET['del'])) 
	{
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM order1 WHERE id=$id");
	$_SESSION['message'] = "List deleted!"; 
	}
?>

<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM order1 WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$itemid = $n['ItemID'];
			$size = $n['Size'];
		}
	}
?>

<?php $results = mysqli_query($db, "SELECT * FROM order1"); ?>

<table>
	<thead>
		<tr>
			<th><p>ItemID</p></th>
			<th><p>Size</p></th>
			<th colspan="2"><p>Action</p></th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['ItemID']; ?></td>
			<td><?php echo $row['Size']; ?></td>
			<td>
				<a href="checkout.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="checkout.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>

<form method="post" action="checkout.php" >
	<h1>Add Order</h1>
	<div class="input-group">
		<label><p>ItemID</p></label>
		<input type="text" name="itemid" value="">
	</div>
	<div class="input-group">
		<label><p>Size</p></label>
		<input type="text" name="size" value="">
	</div>
	<div class="input-group">
		<button class="btn" type="submit" name="save" >Save</button>
	</div>
</form>
	
<form method="post" action="checkout.php" >
	<h1>Edit Order</h1>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="input-group">
		<label><p>ItemID</p></label>
		<input type="text" name="itemid" value="<?php echo $itemid; ?>">
	</div>
	<div class="input-group">
		<label><p>Size</p></label>
		<input type="text" name="size" value="<?php echo $size; ?>">
	</div>
	<div class="input-group">
		<button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
	</div>
</form>


<center><a href="listing.php">
<button class="btn" name="checkmore" style="background: #248CCE;">Check More</button></a></center>
<br>
<center><a href="bill.php">
<button class="btn" name="bill" style="background: #66CE21;">Proceed to Biling Information</button></a></center>

<br><br>
</body>
</html>
