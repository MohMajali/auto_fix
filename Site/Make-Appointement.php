<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['U_Log'];
$mechanic_id = $_GET['mechanic_id'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

    $sql2 = mysqli_query($con, "select * from users where id='$mechanic_id'");
    $row2 = mysqli_fetch_array($sql2);

    $mechanic_name = $row2['name'];
    $mechanic_email = $row2['email'];
    $specalization_id = $row2['specalization_id'];

    if (isset($_POST['Submit'])) {

        $mechanic_id = $_POST['mechanic_id'];
        $C_ID = $_POST['C_ID'];
        $specalization_id = $_POST['specalization_id'];
        $start_date = $_POST['start_date'];
        $end_time = $_POST['end_time'];


        $stmt = $con->prepare("INSERT INTO appointmentes (specialization_id, mechanic_id, customer_id, date, time) 
        VALUES (?, ?, ?, ?, ?) ");

        $stmt->bind_param("iiiss", $specalization_id, $mechanic_id, $C_ID, $start_date, $end_time);

        if ($stmt->execute()) {

            echo "<script language='JavaScript'>
            alert ('Appointement Success !');
       </script>";

            echo "<script language='JavaScript'>
      document.location='./Appointements.php';
         </script>";

        }
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

    <section class="site-hero overlay page-inside" style="background-image: url(img/photographer.jpeg)">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center">
            <h1 class="heading" data-aos="fade-up"><?php echo $mechanic_name ?></h1>
            <!-- <p class="sub-heading mb-5" data-aos="fade-up" data-aos-delay="100">Enjoy your stay.</p> -->
          </div>
        </div>
        <!-- <a href="#" class="scroll-down">Scroll Down</a> -->
      </div>
    </section>
    <!-- END section -->




    <main>
      <div class="container">
        <section
          class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
        >
          <div class="container">
            <div class="row justify-content-center">
              <div
                class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center"
              >
                <div class="d-flex justify-content-center py-4">
                  <a
                    href="index.php"
                    class="logo d-flex align-items-center w-auto"
                  >
                    <img src="assets/img/image00001.jpeg" alt="" />

                  </a>
                </div>
                <!-- End Logo -->

                <div class="card mb-3">
                  <div class="card-body">
                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">
                        Make Reservation
                      </h5>

                    </div>

                    <form class="row g-3 needs-validation" method="POST" action="./Make-Appointement.php?mechanic_id=<?php echo $mechanic_id ?>" >


                    <input type="hidden" name="mechanic_id" value="<?php echo $mechanic_id ?>">
                    <input type="hidden" name="C_ID" value="<?php echo $C_ID ?>">
                    <input type="hidden" name="specalization_id" value="<?php echo $specalization_id ?>">


                      <div class="col-12 mb-2">
                        <label for="yourName" class="form-label"
                          >Mechanic Name</label
                        >
                        <input
                          type="text"
                          name="name"
                          class="form-control"
                          id="yourName"
                          value="<?php echo $mechanic_name?>"
                          readonly
                        />

                      </div>

                      <div class="col-12 mb-2">
                        <label for="yourDate" class="form-label"
                          >Start Date</label
                        >
                        <input
                          type="date"
                          name="start_date"
                          class="form-control"
                          id="yourDate"
                          min="<?php echo date('Y-m-d'); ?>"
                          required
                        />

                      </div>


                      <div class="col-12 mb-3">
                        <label for="yourTime" class="form-label"
                          >Time</label
                        >
                        <input
                          type="time"
                          name="end_time"
                          class="form-control"
                          id="yourTime"
                          required
                        />

                      </div>




                      <div class="col-12">
                        <button
                          class="btn btn-primary w-100"
                          type="submit"
                          name="Submit"
                        >
                          Make Appointement
                        </button>
                      </div>

                    </form>
                  </div>
                </div>

                <div class="credits"></div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>




    <?php include './Footer.php';?>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>