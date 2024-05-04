<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$mechanic_id = $_GET['mechanic_id'];

$stmt = $con->prepare("UPDATE users SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $mechanic_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Mechanic Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Mechanics.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Mechanic Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Mechanics.php';
</script>";
    }

}
