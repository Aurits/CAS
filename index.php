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
                    <li>
                        <a href="admin/">Admin Login</a>
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

        <!-- Call to Action-->
        <div class="card text-white bg-secondary my-5 py-4 text-center">


            <p tabindex="0">Welcome to the Current Awareness System designed exclusively for visually impaired students at Makerere University. We are committed to providing you with easy access to the latest information and resources in your field of study. Our user-friendly interface and adaptive features ensure that you can navigate, discover, and stay updated effortlessly. Explore the diverse range of materials available and enhance your academic journey with our tailored services. Let's embark on a journey of knowledge together!</p>

            <p tabindex="0">Below is a section with the current information posts that you need to know! </p>

        </div>
        <!-- Content Row-->
        <div class="row gx-4 gx-lg-5">
            <?php
            // Include the database connection file (config.php)
            require_once "config.php";

            // Fetch books from the database
            $query = "SELECT * FROM Book";
            $result = mysqli_query($conn, $query);

            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            // Check if there are books
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Extract book details
                    $bookTitle = $row['title'];
                    $bookAuthor = $row['author'];
                    $bookDescription = $row['description'];
                    $bookId = $row['bookId'];

                    // Generate HTML for each book card
                    echo '<div class="col-md-4 mb-5">';
                    echo '<div class="card h-100">';
                    echo '<div class="card-body">';
                    echo '<h2 class="card-title" tabindex="0">' . $bookTitle . '</h2>';
                    echo '<p class="card-text" tabindex="0">' . $bookDescription . '</p>';

                    echo '</div>';
                    echo '<div class="card-footer"><a class="btn btn-primary btn-sm" href="view-book.php?id=' . $bookId . '">View Details</a></div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // Display a message if no books are found
                echo '<p>No books found.</p>';
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
        <section>
            <h2 tabindex="0">Explore More Books</h2>
            <p tabindex="0">Visit the Makerere University Main Library's catalog to discover a wide range of books.</p>
            <p><a href="http://www.makula.mak.ac.ug:8080/search/query?theme=maklib1" target="_blank">Browse Catalog</a></p>
        </section>
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