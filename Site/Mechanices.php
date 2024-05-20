<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['U_Log'];

$response = array();

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

}

if (isset($_GET['specialization_id'])) {

  $specialization_id = $_GET['specialization_id'];

    $sql1 = mysqli_query($con, "SELECT * from users WHERE type = 'MICHANIC' AND specalization_id = '$specialization_id' ORDER BY id DESC");

    while ($row1 = mysqli_fetch_array($sql1)) {

        $response[] = $row1;
    }
} else if (isset($_POST['filter'])) {

    $rate = $_POST['rate'];
    $location_id = $_POST['location_id'];

    if ($rate) {

        $sql1 = mysqli_query($con, "SELECT * from users WHERE type = 'MICHANIC' AND total_rate >= '$rate' ORDER BY id DESC");

        while ($row1 = mysqli_fetch_array($sql1)) {

            $response[] = $row1;
        }

    } else if ($location_id) {

        $sql1 = mysqli_query($con, "SELECT * from users WHERE type = 'MICHANIC' AND location_id = '$location_id' ORDER BY id DESC");

        while ($row1 = mysqli_fetch_array($sql1)) {

            $response[] = $row1;
        }

    }
} else {

    $sql1 = mysqli_query($con, "SELECT * from users WHERE type = 'MICHANIC' ORDER BY id DESC");

    while ($row1 = mysqli_fetch_array($sql1)) {

        $response[] = $row1;
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <title>AutoFix</title>

        <!-- Favicons -->
        <link href="../assets/img/logo.jpeg" rel="icon" />
    <link href="../assets/img/logo.jpeg" rel="apple-touch-icon" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Mukta+Mahee:200,300,400|Playfair+Display:400,700" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <header class="site-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4 site-logo" data-aos="fade"><a href="index.php"><em>AutoFix</em></a></div>
          <div class="col-8">


            <div class="site-menu-toggle js-site-menu-toggle"  data-aos="fade">
              <span></span>
              <span></span>
              <span></span>
            </div>
            <!-- END menu-toggle -->

            <div class="site-navbar js-site-navbar">
              <nav role="navigation">
                <div class="container">
                  <div class="row full-height align-items-center">
                    <div class="col-md-6">
                    <ul class="list-unstyled menu">
                        <li class=""><a href="index.php">Home</a></li>
                        <li class="active"><a href="Mechanices.php">Mechanices</a></li>
                        <li class=""><a href="about.php">About</a></li>

                        <?php if ($C_ID) {?>
                        <li class=""><a href="Appointements.php">Appointements</a></li>
                        <li class=""><a href="Account.php">Account</a></li>
                        <?php } else {?>
                          <li><a href="../User_Login.php">Login</a></li>

                          <?php }?>
                        <li class=""><a href="contact.php">Contact</a></li>

                        <?php if ($C_ID) {?>
                        <li><a href="./logout.php">Logout</a></li>

                        <?php }?>

                      </ul>
                    </div>
                    <div class="col-md-6 extra-info">
                      <div class="row">
                        <div class="col-md-6 mb-5">
                          <h3>Contact Info</h3>
                          <p>98 West 21th Street, Suite 721 <br> New York NY 10016</p>
                          <p>info@AutoFix.com</p>
                          <p>+962 70000 0000</p>

                        </div>
                        <div class="col-md-6">
                          <h3>Connect With Us</h3>
                          <ul class="list-unstyled">
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Instagram</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- END head -->

    <section class="site-hero overlay" style="background-image: url(img/index_background.jpeg)">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center">
            <h1 class="heading" data-aos="fade-up">Welcome to <em>Frame</em>Me</h1>
            <p class="sub-heading mb-5" data-aos="fade-up" data-aos-delay="100">XXXXXX XXXXXX XXXXXX &amp; XXXXXXX.</p>
            <!-- <p data-aos="fade-up" data-aos-delay="100"><a href="#" class="btn uppercase btn-primary mr-md-2 mr-0 mb-3 d-sm-inline d-block">Explore The Beauty</a> <a href="#" class="btn uppercase btn-outline-light d-sm-inline d-block">Download</a></p> -->
          </div>
        </div>
        <!-- <a href="#" class="scroll-down">Scroll Down</a> -->
      </div>
    </section>
    <!-- END section -->



    <section class="section blog-post-entry bg-pattern">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-8">
            <h2 class="heading" data-aos="fade-up">Our Mechanics</h2>
            <p class="lead" data-aos="fade-up">Our Mechanics are Good</p>


            <div class="">
                        <form action="<?php

if ($specialization_id) {

    echo "./Mechanices.php?specialization_id=" . $specialization_id;

} else {

    echo "./Mechanices.php";

}

?>" method="post" class="row g-3">


                        <div class="col-md-4">
                          <select class="form-select" aria-label="Default select example" name="rate">
                        <option disabled selected>Select Rate</option>

                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                    </select>
                          </div>

                          <div class="col-md-6">
                          <select class="form-select" aria-label="Default select example" name="location_id">
                                    <option disabled selected>Select Location</option>
                                    <?php

$sql1 = mysqli_query($con, "SELECT * from locations ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {
    $location_id_select = $row1['id'];
    $location_name_select = $row1['name'];
    ?>
                                      <option value="<?php echo $location_id_select ?>"><?php echo $location_name_select ?></option>
                                    <?php
}?>
                    </select>
                          </div>


                    <div class="text-center col-md-2">
                      <button type="submit" name="filter" class="btn btn-primary">
                        Filter
                      </button>
                    </div>

                        </form>
                      </div>
          </div>
        </div>
        <div class="row">



<?php

foreach ($response as $row) {?>


<div class="col-lg-4 col-md-6 col-sm-6 col-12 post" data-aos="fade-up" data-aos-delay="100">
            <div class="media media-custom d-block mb-4">
              <a href="./Make-Appointement.php?mechanic_id=<?php echo $row['id'] ?>" class="mb-4 d-block"><img src="./img/mechanices.jpeg" alt="Image placeholder" class="img-fluid"></a>
              <div class="media-body">
                <!-- <span class="meta-post">February 26, 2018</span> -->
                <h2 class="mt-0 mb-3"><a href="./Make-Appointement.php?mechanic_id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></h2>
              </div>
            </div>
          </div>



 <?php }?>
        </div>
      </div>
    </section>
    <!-- END section -->


    <?php include './Footer.php';?>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!-- <script src="js/jquery.waypoints.min.js"></script> -->
    <script src="js/aos.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>