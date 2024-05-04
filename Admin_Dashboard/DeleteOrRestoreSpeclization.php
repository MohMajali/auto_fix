<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$speclization_id = $_GET['speclization_id'];

$stmt = $con->prepare("UPDATE specliazations SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $speclization_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Specliaztion Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Speclizations.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Specliaztion Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Speclizations.php';
</script>";
    }

}
