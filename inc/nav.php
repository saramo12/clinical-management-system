<nav class="side-bar">
			<div class="user-p">
				<!-- <img src="img/user.png"> -->
				<h4>@<?=$_SESSION['username']?></h4>
			</div>
			
			<?php 

               if($_SESSION['role'] == "employee"){
			 ?>
			 <!-- Employee Navigation Bar -->
			<ul id="navList">
				<li>
					<a href="zahra-user.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Dashboard</span>
					</a>
				</li>

<li>
					<a href="device-user.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Devices</span>
					</a>
				</li>
<li>
					<a href="company-user.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Companies</span>
					</a>
				</li>

<li>
					<a href="manufacturer-user.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Manufacturer</span>
					</a>
				</li>


<li>
					<a href="workorder-user.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Work Orders</span>
					</a>
				</li>

<li>
					<a href="purchasing-order-user.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Purchasing Orders</span>
					</a>
				</li>
<li>
					<a href="calibration-user.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Calibration </span>
					</a>
				</li>
<li>
					<a href="invoices-user.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Invoices </span>
					</a>
				</li>

				<li>
					<a href="report-form.php">
						<i class="fa fa-folder" aria-hidden="true"></i>
						<span>reports</span>
					</a>
				</li>
<li>
					<a href="manage-report.php">
						<i class="fa fa-folder" aria-hidden="true"></i>
						<span>reports manage</span>
					</a>
				</li>
				
				<li>
					<a href="logout.php">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
		<?php }else { ?>
			<!-- Admin Navigation Bar -->
            <ul id="navList">
				<li>
					<a href="index.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="user.php">
						<i class="fa fa-users" aria-hidden="true"></i>
						<span>Users</span>
					</a>
				</li>
				<li>
					<a href="device.php">
						<i class="fa fa-users" aria-hidden="true"></i>
						<span>Devices</span>
					</a>
				</li>
				<li>
					<a href="company.php">
						<i class="fa fa-folder" aria-hidden="true"></i>
						<span>Companies</span>
					</a>
				</li>
<li>
					<a href="manufacturer.php">
						<i class="fa fa-folder" aria-hidden="true"></i>
						<span>Manufacturers</span>
					</a>
				</li>

<li>
					<a href="workorder.php">
						<i class="fa fa-folder" aria-hidden="true"></i>
						<span>WorkOrders</span>
					</a>
				</li>
<li>
					<a href="purchasing-order.php">
						<i class="fa fa-folder" aria-hidden="true"></i>
						<span>PurchasingOrders</span>
					</a>
				</li>
<li>
					<a href="calibration.php">
						<i class="fa fa-folder" aria-hidden="true"></i>
						<span>Calibration</span>
					</a>
				</li>
				<li>
					<a href="invoices.php">
						<i class="fa fa-folder" aria-hidden="true"></i>
						<span>Invoices</span>
					</a>
				</li>

				<li>
					<a href="report-form.php">
						<i class="fa fa-folder" aria-hidden="true"></i>
						<span>reports</span>
					</a>
				</li>
<li>
					<a href="manage-report.php">
						<i class="fa fa-folder" aria-hidden="true"></i>
						<span>reports manage</span>
					</a>
				</li>

				
				
				<li>
					<a href="logout.php">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
		<?php } ?>
		</nav>