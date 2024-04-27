<?php
session_start();

include "./Connect.php";

if (isset($_POST['Submit'])) {

    $name = $_POST['name'];
    $password = $_POST['password'];
    $specialization_id = $_POST['specialization_id'];
    $location = $_POST['location'];

    $stmt = $con->prepare("INSERT INTO mechanices (name, password, specialization_id, location) VALUES (?, ?, ?, ?) ");

    $stmt->bind_param("ssis", $name, $password, $specialization_id, $location);

    if ($stmt->execute()) {

        echo "<script language='JavaScript'>
          alert ('Register Successfully, You Can Login Now !');
     </script>";

        echo "<script language='JavaScript'>
    document.location='./Mechanic_Login.php';
       </script>";

    }

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Register Page</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/logo.jpeg" rel="icon" />
    <link href="assets/img/logo.jpeg" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <main>
      <div class="container">
        <section
          class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
        >
          <div class="container">
            <div class="row justify-content-center">
              <div
                class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
              >
                <div class="d-flex justify-content-center py-4">
                  <a
                    href="index.html"
                    class="logo d-flex align-items-center w-auto"
                  >
                    <img src="assets/img/logo.jpeg" alt="" width="50px"/>
                    <span class="d-none d-lg-block text-uppercase"
                      >Auto Fix</span
                    >
                  </a>
                </div>
                <!-- End Logo -->

                <div class="card mb-3">
                  <div class="card-body">
                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">
                        Create New Account
                      </h5>
                      <p class="text-center small">
                        Enter your Information
                      </p>
                    </div>

                    <form class="row g-3 needs-validation" method="POST" action="./Mechanic_Register.php" id="login-form" novalidate>
                      <div class="col-12">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-group has-validation">

                          <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            required
                          />

                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourPassword" class="form-label"
                          >Password</label
                        >
                        <input
                          type="password"
                          name="password"
                          class="form-control"
                          id="yourPassword"
                          required
                        />
                        <div class="invalid-feedback" id="password-Message">
                          Please enter your password!
                        </div>
                      </div>

                      <div class="col-12">
                      <label for="specializationId" class="form-label"
                          >Select Specialization</label
                        >
                        <select name="specialization_id" class="form-select" id="specialization_id" required>
                          <?php
$sql1 = mysqli_query($con, "SELECT * from specializations WHERE active = 1 ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $specialization_id = $row1['id'];
    $specialization = $row1['specialization'];
    ?>
                            <option value="<?php echo $specialization_id ?>"><?php echo $specialization ?></option>

                            <?php
}?>
                        </select>
                      </div>

                      <div class="col-12">
                      <label for="locationId" class="form-label"
                          >Select Location</label
                        >
                        <select name="location" class="form-select" id="locationId" required>
                            <option value="location 1">location 1</option>
                            <option value="location 2">location 2</option>
                            <option value="location 3">location 3</option>
                            <option value="location 3">location 3</option>
                        </select>
                      </div>




                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit" name="Submit">
                          Signup
                        </button>
                      </div>
                      <div class="col-12">
                        <p class="small mb-0">
                          Already Have Account
                          <a href="./Mechanic_Login.php">Create an account</a>
                        </p>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
    <!-- End #main -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <script>
      // let loginForm = $('#login-form')
      // let passwordMessageDiv = $('#password-Message')
      // let passwordInput = document.getElementById('yourPassword')
      // const re = new RegExp("^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$");


      // const onChange = (e) => {
      //   console.log(e.value);

      //   if(!re.test(e.value)){

      //     passwordMessageDiv.html("<p>Password Must be at least One Upper case, One Lower Case, Numbers & Symbols</p>")
      //   }
      // }
    </script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
