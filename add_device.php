<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Add Device</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/style.css" />
	<style>
		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background: #f7f9ff;
			color: #333;
		}
		.section-1 {
			background: #fff;
			padding: 30px 40px;
			margin: 40px auto;
			max-width: 800px;
			border-radius: 14px;
			box-shadow: 0 12px 28px rgba(102, 126, 234, 0.15);
		}
		.title {
			font-size: 24px;
			margin-bottom: 30px;
			color: #333;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		.form-1 {
			display: flex;
			flex-direction: column;
			gap: 20px;
		}
		.input-holder {
			display: flex;
			flex-direction: column;
		}
		.input-holder label {
			font-weight: 600;
			margin-bottom: 6px;
			color: #4a4a4a;
		}
		.input-1 {
			padding: 10px 15px;
			border-radius: 8px;
			border: 1.5px solid #cbd5e1;
			font-size: 16px;
		}
		select.input-1 {
			background-color: white;
		}
		.edit-btn {
			background: linear-gradient(45deg, #38b2ac, #319795);
			border: none;
			color: #fff;
			font-weight: 700;
			padding: 14px 0;
			border-radius: 28px;
			font-size: 18px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<input type="checkbox" id="checkbox" />
	<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
			<h4 class="title">Add Device <a href="device.php">Devices</a></h4>

			<form class="form-1" method="POST" action="add_device.php">
				<div class="input-holder"><label>Floor</label><input type="text" name="floor" class="input-1" required></div>
				<div class="input-holder"><label>Department</label><input type="text" name="department" class="input-1" required></div>
				<div class="input-holder"><label>Department Now</label><input type="text" name="department_now" class="input-1" required></div>
				<div class="input-holder"><label>Room</label><input type="text" name="room" class="input-1" required></div>
				<div class="input-holder"><label>Device Name</label><input type="text" name="device_name" class="input-1" required></div>
				<div class="input-holder"><label>Accessories</label><input type="text" name="accessories" class="input-1" required></div>
				<div class="input-holder"><label>Manufacturer</label><input type="text" name="manufacturer" class="input-1" required></div>
				<div class="input-holder"><label>Origin</label><input type="text" name="origin" class="input-1" required></div>
				<div class="input-holder"><label>Company</label><input type="text" name="company" class="input-1" required></div>
				<div class="input-holder"><label>Model</label><input type="text" name="model" class="input-1" required></div>
				<div class="input-holder"><label>Serial Number</label><input type="text" name="serial_number" class="input-1" required></div>
				<div class="input-holder"><label>QT</label><input type="text" name="qt" class="input-1" required></div>
				<div class="input-holder"><label>BMD-Code</label><input type="text" name="bmd_code" class="input-1" required></div>
				<div class="input-holder"><label>Arrival Date</label><input type="date" name="arrival_date" class="input-1" required></div>
				<div class="input-holder"><label>Installation Date</label><input type="date" name="installation_date" class="input-1" required></div>
				<div class="input-holder"><label>Purchasing Order Date</label><input type="date" name="purchasing_order_date" class="input-1" required></div>
				<div class="input-holder"><label>Price</label><input type="number" name="price" class="input-1" required></div>
				<div class="input-holder"><label>Warranty Period</label><input type="text" name="warranty_period" class="input-1" required></div>
				<div class="input-holder"><label>Warranty Period Start</label><input type="date" name="warranty_start" class="input-1" required></div>
				<div class="input-holder"><label>Warranty Period End</label><input type="date" name="warranty_end" class="input-1" required></div>
				<div class="input-holder"><label>Company Contact</label><input type="text" name="company_contact" class="input-1" required></div>
				<div class="input-holder"><label>Company Telephone</label><input type="text" name="company_telephone" class="input-1" required></div>
				<div class="input-holder">
					<label>Device Safety Test</label>
					<select name="safety_test" class="input-1" required>
						<option value="">Select</option>
						<option value="passed">Passed</option>
						<option value="not passed">Not Passed</option>
					</select>
				</div>
				<button class="edit-btn" type="submit">Add Device</button>
			</form>
		</section>
	</div>
</body>
</html>
<?php 
} else { 
	header("Location: login.php?error=Please login first");
	exit();
}
?>
