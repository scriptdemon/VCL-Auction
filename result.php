<?php include('connection.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Styles/mystyle.css">
	<link rel="stylesheet" href="FA/css/font-awesome.min.css">
	<script src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/save_details.js"></script>

	<title>AUCTION PAGE</title>
</head>
<body id='welcome_body'>
	<?php
		if(isset($_GET['id']))
		{
			$group = $_GET['id'];
			$select = "SELECT * from players where category=$group AND isShown=0 order by RAND() limit 1";
			$run_sel_query = mysqli_query($con,$select);
			if(mysqli_num_rows($run_sel_query) > 0)
			{
				while($row = mysqli_fetch_array($run_sel_query))
				{
					$player_id = $row['id'];
					$_SESSION['pid'] = $player_id;
					$name = $row['fname']." ".$row['surname'];
					$position = $row['role'];
					$class = $row['class'];
				}
				$update = "UPDATE players set isShown=1 where id=$player_id";
				$run_up_query = mysqli_query($con,$update);

				echo
				"
				<div class='row' style='margin-top:10%;color:white;'>
					<div class='col-lg-6 col-lg-offset-3' style='background-color:rgba(0,0,0,0.5);height:auto;border-radius:10px;padding:10px;'>
						<div class='col-lg-6 col-lg-offset-3' style='background-color:transparent;height:inherit;'>
							<h2>Name:&nbsp;&nbsp;$name</h2>
							<h3>Class:&nbsp;&nbsp;$class</h3>
							<h3>Role:&nbsp;&nbsp;&nbsp;$position</h3>
							<form class='form-inline' method='GET' action='result.php'>
							  <div class='form-group'>
							    <label for='#team_name'><h3>Team:</h3></label>
							    &nbsp;&nbsp;<select name='team' class='form-control'>
												<option>SACHIN TENDULKAR</option>
												<option>VIRENDER SEHWAG</option>
												<option>RICKY PONTING</option>
												<option>M S DHONI</option>
												<option>BRENDON MCCULLUM</option>
												<option>ANDERSON</option>
												<option>DALE STEYN</option>
												<option>SOURAV GANGULY</option>
								</select>
							  </div>

							  <div class='form-group'>
							    <label for='#price_val'><h3>Price:&nbsp;&nbsp;</h3></label>
							    <i class='fa fa-inr fa-2x' aria-hidden='true'></i>&nbsp;&nbsp;<input type='number' class='form-control' name='price' id='price_val' placeholder='Enter price'>
							    &nbsp;&nbsp;<input type='submit' class='btn btn-success' name='sold' id='sold_btn' value='SOLD' style='font-size:20px;'>
							  </div>

							  <br><br><button class='btn btn-danger' style='text-align:center;margin-left:120px;font-size:20px;' onclick='window.close()'>UNSOLD</button>

							</form>
						</div>
					</div>
				</div>
				";
			}
			else
			{
				echo "<h1 class='text-center warning'>All players in this group have been displayed.</h1>";
				echo "<div class='button-wrap'><button class='btn btn-danger' style='margin:auto;font-size:25px;' onclick='window.close()'>Close</button></div>";
			}	
		}
	?>
	<?php

		if(isset($_GET['sold']))
			{
				$player_id = $_SESSION['pid'];
				$team = $_GET['team'];
				$price = $_GET['price'];

				$update2 = "UPDATE players set auction_price=$price,team='$team' where id=$player_id";
				$run_up2_query = mysqli_query($con,$update2);

				echo "<script>window.alert('Player $player_id Sold')</script>";
				echo "<script>window.close()</script>";
				
			}

	?>
</body>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>