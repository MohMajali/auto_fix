<?php
session_start();

include "../Connect.php";

$M_ID = $_SESSION['M_Log'];

if (!$M_ID) {

    echo '<script language="JavaScript">
     document.location="../Mechanic_Login.php";
    </script>';

} else {

    $sql1 = mysqli_query($con, "select * from users where id='$M_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];

    if (isset($_POST['Submit'])) {

        $app_id = $_POST['appointment_id'];
        $price = $_POST['price'];

        $stmt = $con->prepare("UPDATE appointmentes SET price = ? WHERE id = ?");

        $stmt->bind_param("di", $price, $app_id);

        if ($stmt->execute()) {

            echo "<script language='JavaScript'>
              alert ('Price Updated Successfully !');
         </script>";

            echo "<script language='JavaScript'>
        document.location='./Appointmentes.php';
           </script>";

        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Appointmentes - Auto Fix</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="../assets/img/logo.jpeg" rel="icon" />
    <link href="../assets/img/logo.jpeg" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="../assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="../assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <img src="../assets/img/logo.jpeg" alt="" />

        </a>
      </div>
      <!-- End Logo -->
      <!-- End Search Bar -->

      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item dropdown pe-3">
            <a
              class="nav-link nav-profile d-flex align-items-center pe-0"
              href="#"
              data-bs-toggle="dropdown"
            >
              <img
                src="https://www.computerhope.com/jargon/g/guest-user.png"
                alt="Profile"
                class="rounded-circle"
              />
              <span class="d-none d-md-block ps-2"><?php echo $name ?></span> </a
            ><!-- End Profile Iamge Icon -->
          </li>
          <!-- End Profile Nav -->
        </ul>
      </nav>
      <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php require './Aside-Nav/Aside.php'?>
    <!-- End Sidebar-->

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Appointmentes</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item">Appointmentes</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      <section class="section">







      <div class="modal fade" id="verticalycentered" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Price</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">

                <form method="POST" action="./Appointmentes.php" enctype="multipart/form-data">

                <input type="hidden" name="appointment_id" id="appointment_id">

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Price</label
                    >
                    <div class="col-sm-8">
                      <input type="number" name="price" class="form-control" />
                    </div>
                  </div>



                  <div class="row mb-3">
                    <div class="text-end">
                      <button type="submit" name="Submit" class="btn btn-primary">
                        Submit
                      </button>
                    </div>
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>





        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">User Name</th>
                      <th scope="col">Date</th>
                      <th scope="col">Time</th>
                      <th scope="col">Price</th>
                      <th scope="col">Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$sql1 = mysqli_query($con, "SELECT * from appointmentes WHERE mechanic_id = '$M_ID' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $appointment_id = $row1['id'];
    $customer_id = $row1['customer_id'];
    $date = $row1['date'];
    $time = $row1['time'];
    $status = $row1['status'];
    $price = $row1['price'];

    $sql2 = mysqli_query($con, "SELECT * from users WHERE id = '$customer_id'");
    $row2 = mysqli_fetch_array($sql2);

    $user_name = $row2['name'];

    ?>
                    <tr>
                      <th scope="row"><?php echo $appointment_id ?></th>
                      <td><?php echo $user_name ?></td>
                      <td><?php echo $date ?></td>
                      <td><?php echo $time ?></td>
                      <td><?php

    if ($price) {
        echo $price . 'JDs';
    }

    ?> </td>
                      <td><?php echo $status ?></td>

                      <td>

                      <?php
if ($status == 'PENDING') {?>

                      <a href="./AcceptOrRejectAppointement.php?appointment_id=<?php echo $appointment_id ?>&&status=Accepted" class="btn btn-primary">Accept</a>

                      <a href="./AcceptOrRejectAppointement.php?appointment_id=<?php echo $appointment_id ?>&&status=Rejected" class="btn btn-danger">Reject</a>
                      <?php } else if ($status == 'Accepted') {?>

                        <!-- <a href="./AcceptOrRejectAppointement.php?appointment_id=<?php echo $appointment_id ?>&&status=Rejected" class="btn btn-primary">Add Price</a> -->
                        <button

                        type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#verticalycentered"
            id="btn-<?php echo $appointment_id ?>"
            onclick="onClick(event)"

                        >Add Price</button>

                        <?php }?>
                      </td>


                    </tr>
<?php
}?>
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="copyright">
        &copy; Copyright <strong><span>Auto Fix</span></strong
        >. All Rights Reserved
      </div>
    </footer>
    <!-- End Footer -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <script>
    window.addEventListener('DOMContentLoaded', (event) => {
     document.querySelector('#sidebar-nav .nav-item:nth-child(3) .nav-link').classList.remove('collapsed')
   });
</script>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>


    <script>

      const onClick = (e) => {
        document.getElementById('appointment_id').value = e.target.id.split('-')[1]
      }
    </script>

  </body>
</html>
