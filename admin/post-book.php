<?php
# Initialize the session
session_start();

# If user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
	echo "<script>" . "window.location.href='./pages-sign-in.php';" . "</script>";
	exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="">



	<title>Current Awareness System</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
					<span class="align-middle">Admin</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Quick Pages
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="index.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-in.php">
							<i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-up.php">
							<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="logout.php">
							<i class="align-middle" data-feather="book"></i> <span class="align-middle">Logout</span>
						</a>
					</li>

					<li class="sidebar-header">
						Tools & Pages
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="post-book.php">
							<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Make Post</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="manage-book.php">
							<i class="align-middle" data-feather="square"></i> <span class="align-middle">Manage Posts</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="messages.php">
							<i class="align-middle" data-feather="grid"></i> <span class="align-middle">All Messages</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="students.php">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Students</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="staff.php">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Staff</span>
						</a>
					</li>


				</ul>


			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="../img/user.png" class="avatar img-fluid rounded me-1" alt="USER" /> <span class="text-dark">USER</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">

								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="index.php"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>




			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Admin</strong> Dashboard</h1>




					<?php
					// Check if the form is submitted
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						// Get form data
						$title = $_POST["title"];
						$author = $_POST["author"];
						$description = $_POST["description"];
						$audioBookUrl = $_POST["audioBookUrl"];
						$staffId = $_POST["staffId"];

						// Include connection
						require_once "./config.php";

						ini_set('display_errors', 1);
						error_reporting(E_ALL);

						// Prepare and execute the SQL query to insert data into the Book table
						$stmt = $conn->prepare("INSERT INTO Book (title, author, description, audioBookUrl, staffId) VALUES (?, ?, ?, ?, ?)");
						$stmt->bind_param("ssssi", $title, $author, $description, $audioBookUrl, $staffId);

						if ($stmt->execute()) {
							echo '<div style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; margin-top: 10px;">Post details saved successfully!</div>';
						} else {
							echo "Error: " . $stmt->error;
						}

						// Close the prepared statement and connection
						$stmt->close();
					}
					?>






					<div class="container-fluid">

						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<h4 class="header-title">Details</h4>


										<div class="row align-items-center justify-content-center d-flex">
											<div class="col-lg-8">
												<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>

													<div class="mb-3">
														<label for="title" class="form-label">Title</label>
														<input type="text" id="title" name="title" class="form-control" required>
													</div>

													<div class="mb-3">
														<label for="author" class="form-label">Author</label>
														<input type="text" id="author" name="author" class="form-control" required>
													</div>

													<div class="mb-3">
														<label for="description" class="form-label">Description</label>
														<textarea class="form-control" id="description" name="description" rows="5" required></textarea>
													</div>

													<div class="mb-3">
														<label for="audioBookUrl" class="form-label">Audio URL</label>
														<input type="text" id="audioBookUrl" name="audioBookUrl" class="form-control">
													</div>

													<div class="mb-3">
														<label for="staffId" class="form-label">Staff ID</label>
														<input type="number" id="staffId" name="staffId" class="form-control" required>
													</div>

													<button type="submit" class="btn btn-primary">Save Post</button>
												</form>
											</div>
										</div>
										<!-- end row -->

									</div> <!-- end card-body -->
								</div> <!-- end card -->
							</div><!-- end col -->
						</div>
						<!-- end row -->

					</div>




					<div class="row">
						<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<h5 class="card-title mb-0">Latest Posts</h5>
								</div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>Title</th>
											<th class="">Author</th>
											<th class="d-none d-xl-table-cell">Description</th>
											<!-- <th class="d-none d-md-table-cell">URL</th> -->
											<th class="">StaffID</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										// Assuming you have a database connection established
										// Include connection
										require_once "./config.php";

										// Prepare and execute the SQL query to select data from the Book table
										$sql = "SELECT * FROM Book";
										$result = $conn->query($sql);

										// Check if the query was successful
										if ($result) {
											// Loop through the data and display each row in the table
											while ($row = $result->fetch_assoc()) {
												echo '<tr>';
												echo '<td>' . $row['title'] . '</td>';
												echo '<td class="">' . $row['author'] . '</td>';
												echo '<td class="d-none d-xl-table-cell">' . (strlen($row['description']) > 100 ? substr($row['description'], 0, 100) . '...' : $row['description']) . '</td>';

												// echo '<td class="d-none d-md-table-cell">' . $row['audioBookUrl'] . '</td>';
												echo '<td class="">' . $row['staffId'] . '</td>';
												echo '<td><a href="view-book.php?id=' . $row['bookId'] . '" class="badge bg-danger">Manage</a></td>';
												echo '</tr>';
											}

											// Free the result set
											$result->free();
										} else {
											echo '<tr><td colspan="6">Error: ' . $conn->error . '</td></tr>';
										}

										// Close the database connection
										$conn->close();
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>


				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="#" target="_blank"><strong>Admin</strong></a> - <a class="text-muted" href="" target="_blank"><strong>Current Awareness System</strong></a> &copy;
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="../js/app.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales ($)",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Chrome", "Firefox", "IE"],
					datasets: [{
						data: [4306, 3801, 1689],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "This year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var markers = [{
					coords: [31.230391, 121.473701],
					name: "Shanghai"
				},
				{
					coords: [28.704060, 77.102493],
					name: "Delhi"
				},
				{
					coords: [6.524379, 3.379206],
					name: "Lagos"
				},
				{
					coords: [35.689487, 139.691711],
					name: "Tokyo"
				},
				{
					coords: [23.129110, 113.264381],
					name: "Guangzhou"
				},
				{
					coords: [40.7127837, -74.0059413],
					name: "New York"
				},
				{
					coords: [34.052235, -118.243683],
					name: "Los Angeles"
				},
				{
					coords: [41.878113, -87.629799],
					name: "Chicago"
				},
				{
					coords: [51.507351, -0.127758],
					name: "London"
				},
				{
					coords: [40.416775, -3.703790],
					name: "Madrid "
				}
			];
			var map = new jsVectorMap({
				map: "world",
				selector: "#world_map",
				zoomButtons: true,
				markers: markers,
				markerStyle: {
					initial: {
						r: 9,
						strokeWidth: 7,
						stokeOpacity: .4,
						fill: window.theme.primary
					},
					hover: {
						fill: window.theme.primary,
						stroke: window.theme.primary
					}
				},
				zoomOnScroll: false
			});
			window.addEventListener("resize", () => {
				map.updateSize();
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		});
	</script>

</body>

</html>