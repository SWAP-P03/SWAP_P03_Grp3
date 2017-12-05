<html>
<head>
<title>Order List</title>
</head>
<style>
body 
{
    font-size: 19px;
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
<body>
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>

<?php 
	//session start
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
	if (isset($_GET['edit'])) 
	{
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM order1 WHERE id=$id");
		
		if (count($record) == 1 ) 
		{
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
			<th>ItemID</th>
			<th>Size</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['ItemID']; ?></td>
			<td><?php echo $row['Size']; ?></td>
			<td>
				<a href="order.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="order.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>

<form method="post" action="order.php" >
	<div class="input-group">
		<label>ItemID</label>
		<input type="text" name="itemid" value="">
	</div>
		<div class="input-group">
		<label>Size</label>
		<input type="text" name="size" value="">
	</div>
	<div class="input-group">
		<button class="btn" type="submit" name="save" >Save</button>
	</div>
</form>
	
<form method="post" action="order.php" >
	<h>Edit</h>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="input-group">
		<label>ItemID</label>
		<input type="text" name="itemid" value="<?php echo $itemid; ?>">
	</div>
	<div class="input-group">
		<label>Size</label>
		<input type="text" name="size" value="<?php echo $size; ?>">
	</div>
	<div class="input-group">
		<button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
	</div>
</form>
</body>
</html>
