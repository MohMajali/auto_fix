<?php

include "../Connect.php";

$status = $_GET['status'];
$appointment_id = $_GET['appointment_id'];

$stmt = $con->prepare("UPDATE appointmentes SET status = ? WHERE id = ? ");

$stmt->bind_param("si", $status, $appointment_id);

if ($stmt->execute()) {

    if ($status == 'Accepted') {

        echo "<script language='JavaScript'>
        alert ('Appointement Has Been Accepted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Appointmentes.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Place Has Been Rejected Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Appointmentes.php';
</script>";
    }

}
