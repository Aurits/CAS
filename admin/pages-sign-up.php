<?php
# Include connection
require_once "./config.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);


# Define variables and initialize with empty values
$username_err = $email_err = $password_err = $lname_err = $contact_err = "";
$username = $email = $password = $lname = $contact = "";

# Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  # Validate username
  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter a username.";
  } else {
    $username = trim($_POST["username"]);
    if (!ctype_alnum(str_replace(array("@", "-", "_"), "", $username))) {
      $username_err = "Username can only contain letters, numbers and symbols like '@', '_', or '-'.";
    } else {
      # Prepare a select statement
      $sql = "SELECT userId FROM User WHERE username = ?";

      if ($stmt = mysqli_prepare($conn, $sql)) {
        # Bind variables to the statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        # Set parameters
        $param_username = $username;

        # Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
          # Store result
          mysqli_stmt_store_result($stmt);

          # Check if username is already registered
          if (mysqli_stmt_num_rows($stmt) == 1) {
            $username_err = "This username is already registered.";
          }
        } else {
          echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
        }

        # Close statement
        mysqli_stmt_close($stmt);
      }
    }
  }

  # Validate email
  if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter an email address";
  } else {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "Please enter a valid email address.";
    } else {
      # Prepare a select statement
      $sql = "SELECT userId FROM User WHERE email = ?";

      if ($stmt = mysqli_prepare($conn, $sql)) {
        # Bind variables to the statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_email);

        # Set parameters
        $param_email = $email;

        # Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
          # Store result
          mysqli_stmt_store_result($stmt);

          # Check if email is already registered
          if (mysqli_stmt_num_rows($stmt) == 1) {
            $email_err = "This email is already registered.";
          }
        } else {
          echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
        }

        # Close statement
        mysqli_stmt_close($stmt);
      }
    }
  }

  # Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } else {
    $password = trim($_POST["password"]);
    if (strlen($password) < 8) {
      $password_err = "Password must contain at least 8 or more characters.";
    }
  }

  # Validate lname
  if (empty(trim($_POST["lname"]))) {
    $lname_err = "Please enter your last name.";
  } else {
    $lname = trim($_POST["lname"]);
  }

  # Validate contact
  if (empty(trim($_POST["contact"]))) {
    $contact_err = "Please enter your contact number.";
  } else {
    $contact = trim($_POST["contact"]);
  }

  # Check input errors before inserting data into the database
  if (empty($username_err) && empty($email_err) && empty($password_err) && empty($lname_err) && empty($contact_err)) {
    # Generate a unique staffId
    $staffId = mt_rand(1000, 9999);

    # Prepare an insert statement for the User table
    $user_insert_sql = "INSERT INTO User (username, email, password, reg_date) VALUES (?, ?, ?, NOW())";
    # Prepare an insert statement for the LibraryStaff table
    $libstaff_insert_sql = "INSERT INTO LibraryStaff (firstName, lastName, emailAddress, contactNumber) VALUES (?, ?, ?, ?)";
    if (($user_stmt = mysqli_prepare($conn, $user_insert_sql)) && ($libstaff_stmt = mysqli_prepare($conn, $libstaff_insert_sql))) {

      # Begin the transaction
      mysqli_begin_transaction($conn);

      # Bind variables to the prepared statement for User table
      mysqli_stmt_bind_param($user_stmt, "sss", $param_username, $param_email, $param_password);

      # Set parameters for User table
      $param_username = $username;
      $param_email = $email;
      $param_password = password_hash($password, PASSWORD_DEFAULT);

      # Execute the prepared statement for User table
      if (mysqli_stmt_execute($user_stmt)) {
        # Get the last inserted userId
        $last_inserted_user_id = mysqli_insert_id($conn);

        # Bind variables to the prepared statement for LibraryStaff table
        mysqli_stmt_bind_param($libstaff_stmt, "ssss", $param_firstName, $param_lastName, $param_emailAddress, $param_contactNumber);

        # Set parameters for LibraryStaff table
        $param_firstName = $username;
        $param_lastName = $lname;
        $param_emailAddress = $email;
        $param_contactNumber = $contact;

        # Execute the prepared statement for LibraryStaff table
        if (mysqli_stmt_execute($libstaff_stmt)) {
          # Commit the transaction
          mysqli_commit($conn);
          echo "<script>alert('Registration completed successfully. Login to continue.');</script>";
          echo "<script>window.location.href='./pages-sign-in.php';</script>";
          exit;
        } else {
          # Rollback the transaction if an error occurred
          mysqli_rollback($conn);
          echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
        }
      } else {
        # Rollback the transaction if an error occurred
        mysqli_rollback($conn);
        echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
      }

      # Close statements
      mysqli_stmt_close($user_stmt);
      mysqli_stmt_close($libstaff_stmt);
    } else {
      echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
    }
  }

  # Close connection
  mysqli_close($conn);
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

  <title>Sign Up | Current Awareness System</title>

  <link href="../css/app.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
  <main class="d-flex w-100">
    <div class="container d-flex flex-column">
      <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
          <div class="d-table-cell align-middle">

            <div class="text-center mt-4">
              <h1 class="h2">Current Awareness System</h1>
              <p class="lead">
                Sign up now
              </p>
            </div>

            <div class="card">
              <div class="card-body">
                <div class="m-sm-3">
                  <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                    <div class="mb-3">
                      <label class="form-label">Username or Firstname</label>
                      <input class="form-control form-control-lg" type="text" name="username" id="username" value="<?= $username; ?>" placeholder="Enter your name" />
                      <small class="text-danger"><?= $username_err; ?></small>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Lastname</label>
                      <input class="form-control form-control-lg" type="text" name="lname" placeholder="Enter your last name" />
                      <small class="text-danger"><?= $lname_err; ?></small>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input class="form-control form-control-lg" type="email" name="email" id="email" value="<?= $email; ?>" placeholder="Enter your email" />
                      <small class="text-danger"><?= $email_err; ?></small>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Contact</label>
                      <input class="form-control form-control-lg" type="text" name="contact" placeholder="Enter your contact number" />
                      <small class="text-danger"><?= $contact_err; ?></small>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Password</label>
                      <input class="form-control form-control-lg" type="password" name="password" id="password" value="<?= $password; ?>" placeholder="Enter password" />
                      <small class="text-danger"><?= $password_err; ?></small>
                    </div>
                    <div class="mb-3">
                      <input type="submit" class="btn btn-primary form-control" name="submit" value="Sign Up">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="text-center mb-3">
              Already have an account? <a href="pages-sign-in.php">Log In</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="../js/app.js"></script>

</body>

</html>