<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $emailAddress = $_POST["emailAddress"];
    $contactNumber = $_POST["contactNumber"];

    // Include connection
    require_once "./config.php";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    // Prepare and execute the SQL query to insert data into the VisuallyImpairedStudent table
    $stmt = $conn->prepare("INSERT INTO VisuallyImpairedStudent (firstName, lastName, emailAddress, contactNumber) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstName, $lastName, $emailAddress, $contactNumber);

    if ($stmt->execute()) {
        echo "Student registered successfully!";
        // Play success audio
        echo '<audio autoplay><source src="success_audio.mp3" type="audio/mpeg"></audio>';
    } else {
        echo "Error: " . $stmt->error;
        // Play error audio
        echo '<audio autoplay><source src="error_audio.mp3" type="audio/mpeg"></audio>';
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Library | Current Awareness System</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="./browser/bootstrap.min.css">

</head>

<body>
    <?php
    include('loading.php');
    ?>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">Mak CAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="register.php">Register</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content-->
    <div class="container px-4 px-lg-5">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5">
            <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="img/home-bg.jpg" alt="Main library Makerere University" /></div>
            <div class="col-lg-5">
                <h3 class="font-weight-light" tabindex="0">Welcome to the Main Library</h3>
                <p tabindex="0">Explore a world of knowledge and discovery at the Main Library of Makerere University. With a rich collection of resources and a vibrant learning environment, we are here to support your academic journey.</p>
                <a class="btn btn-primary" href="about.php">Learn More</a>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 tabindex="0">Register Visually Impaired Students</h3>

                    <!-- Registration Form -->
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label for="firstName">First Name:</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label for="emailAddress">Email Address:</label>
                            <input type="email" class="form-control" id="emailAddress" name="emailAddress" required>
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Contact Number:</label>
                            <input type="tel" class="form-control" id="contactNumber" name="contactNumber" required>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" aria-label="Submit Form">

                    </form>
                </div>
            </div>


        </div>



        <hr>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-4 px-lg-5">
            <p class="m-0 text-center text-white">Copyright &copy; Makerere University</p>
        </div>
    </footer>

    <script>
        // Get the audio element and the button
        var newPageSound = document.getElementById('newPageSound');
        var playSoundButton = document.getElementById('playSoundButton');

        // Add a click event listener to the button
        playSoundButton.addEventListener('click', function() {
            // Play the sound
            newPageSound.play();
        });

        // Automatically play the sound when the page has loaded (optional)
        window.onload = function() {
            newPageSound.play();
        };
    </script>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="./browser/system.js"></script>
    <script src="./bundle.js"></script>
    <script>
        System.load("Main");
    </script>
</body>

</html>