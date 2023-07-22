<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Library | Current Awareness System</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Library CAS</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="../index.php">Home</a>
                    </li>
                    <li>
                        <a href="./about.php">About</a>
                    </li>
                    <li>
                        <a href="./register.php">Register</a>
                    </li>
                    <li>
                        <a href="./contact.php">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

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

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-color: grey; height:25vh">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div>

                        <h1 class="heading mt-5"><?php echo $book['title']; ?></h1>
                        <span class="meta">Posted by <a href="../">Main Library</a></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">



                    <h1 class="h3 m-5">media</h1>
                    <main class="content">
                        <!-- Display book details -->
                        <?php if (isset($book)) : ?>
                            <div class=" p-0 d-flex align-items-center justify-content-center">
                                <div class="row">
                                    <div class="">

                                        <div class="embed-responsive embed-responsive-16by9">
                                            <?php echo $book['audioBookUrl']; ?>
                                        </div>


                                        <p class="card-text"><?php echo $book['description']; ?></p>
                                        <a href="../index.php">Go back</a>


                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <p>No book found with the given ID.</p>
                        <?php endif; ?>
                    </main>



                </div>
            </div>
        </div>
    </article>

    <hr>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <img src="../img/logo.png" width="120px" height="100px" alt="school logo">
                    </ul>

                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/clean-blog.min.js"></script>

</body>

</html>