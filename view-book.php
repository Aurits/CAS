    <?php
    // Include connection
    require_once "./config.php";

    // Check if the bookId is provided in the query parameter
    if (isset($_GET['id'])) {
        $bookId = $_GET['id'];

        // Check if the delete button is clicked
        if (isset($_POST['delete'])) {
            // Prepare and execute the SQL query to delete the book from the Book table
            $stmt = $conn->prepare("DELETE FROM Book WHERE bookId = ?");
            $stmt->bind_param("i", $bookId);

            if ($stmt->execute()) {
                // Book deleted successfully, redirect to the homepage or any other page
                echo "<script>" . "window.location.href='./'" . "</script>";
                exit();
            } else {
                // Handle the error (you can redirect to an error page or display an error message)
                echo "Error: Unable to delete book.";
            }

            // Close the prepared statement
            $stmt->close();
        }

        // Fetch book details from the database based on the provided bookId
        $stmt = $conn->prepare("SELECT * FROM Book WHERE bookId = ?");
        $stmt->bind_param("i", $bookId);
        $stmt->execute();
        $result = $stmt->get_result();
        $book = $result->fetch_assoc();
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="contact.php">Contact</a></li>
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
                <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="img/logo.png" width="200" alt="Main library makerere university" /></div>
                <div class="col-lg-5">
                    <h3 class="font-weight-light" tabindex="0">Welcome to the Main Library</h3>
                    <h2 class="heading mt-5" tabindex="0"><?php echo $book['title']; ?></h2>
                    <span class="meta" tabindex="0">Posted by <a href="/">Main Library</a></span>
                </div>
            </div>

            <!-- Book Details -->
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <?php if (isset($book)) : ?>
                        <div class="embed-responsive embed-responsive-16by9 mb-4">
                            <?php echo $book['audioBookUrl']; ?>
                        </div>
                        <br><br>
                        <p class="card-text" tabindex="0"><?php echo $book['description']; ?></p>
                        <a href="index.php" class="btn btn-primary" tabindex="0">Go back</a>
                    <?php else : ?>
                        <p>No book found with the given ID.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <br><br><br>
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