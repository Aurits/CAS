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
            <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="img/about-bg.jpg" alt="Main library Makerere University" /></div>
            <div class="col-lg-5">
                <h3 class="font-weight-light" tabindex="0">Welcome to the Main Library</h3>
                <p tabindex="0">Explore a world of knowledge and discovery at the Main Library of Makerere University. With a rich collection of resources and a vibrant learning environment, we are here to support your academic journey.</p>
                <a class="btn btn-primary" href="#!">Learn More</a>
            </div>
        </div>
        <!-- Content Row-->
        <h2 tabindex="0">Features of Our Awareness System:</h2>
        <ul class="list-unstyled text-left" tabindex="0">
            <li tabindex="0">
                <strong>Text-to-Speech Technology:</strong><br> All textual content on our platform can be converted to speech, allowing visually impaired students to listen to the information in an accessible format.<br><br>
            </li>
            <li tabindex="0">
                <strong>Screen Reader Compatibility:</strong><br> Our platform is fully compatible with popular screen readers, ensuring that visually impaired students can navigate through the content effortlessly.<br><br>
            </li>
            <li tabindex="0">
                <strong>Accessible User Interface:</strong><br> We have implemented an accessible and user-friendly interface with clear headings and keyboard navigability for an optimal user experience.<br><br>
            </li>
            <li tabindex="0">
                <strong>High Contrast and Font Size Options:</strong><br> Students can customize the contrast and font size to suit their visual preferences, ensuring comfortable reading.<br><br>
            </li>
            <li tabindex="0">
                <strong>Audio Descriptions for Media:</strong><br> Videos and images on our platform come with audio descriptions to provide context and details to visually impaired users.<br><br>
            </li>
        </ul>

        <p tabindex="0">At our organization, we are dedicated to making education accessible to all students. Our awareness system for visually impaired students is a step towards fostering an inclusive learning environment, empowering every student to achieve their academic goals.</p>

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