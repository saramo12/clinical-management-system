<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {

    if (
        isset($_POST['id']) &&
        isset($_POST['device_serial']) &&
        isset($_POST['device_name']) &&
        isset($_POST['manufacturer_name']) &&
        isset($_POST['qt']) &&
        isset($_POST['department']) &&
         isset($_POST['calibration']) &&
         isset($_POST['duration']) &&
          isset($_POST['em_name']) &&
           isset($_POST['month']) &&
                      isset($_POST['model']) &&

                isset($_POST['hospital_code']) 

    ) {
        include "../DB_connection.php";

        function validate_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        // استلام البيانات
        $id = validate_input($_POST['id']);
        $device_serial = validate_input($_POST['device_serial']);
        $device_name = validate_input($_POST['device_name']);
        $manufacturer_name = validate_input($_POST['manufacturer_name']);
        $qt = validate_input($_POST['qt']);
        $department = validate_input($_POST['department']);
         $calibration = validate_input($_POST['calibration']);
               $duration = validate_input($_POST['duration']);
        $em_name = validate_input($_POST['em_name']);
        $month = validate_input($_POST['month']);
        $model = validate_input($_POST['model']);

                $hospital_code = validate_input($_POST['hospital_code']);


        // إعداد استعلام الإدخال
        $sql = "INSERT INTO calibration (
                    id, device_serial,device_name,manufacturer_name, qt, department,calibration,duration,em_name,month,model,hospital_code
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?
                )";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssssss",
             $id, $device_serial,$device_name,$manufacturer_name, $qt, $department,$calibration,$duration,$em_name,$month,$model,$hospital_code
        );

        if ($stmt->execute()) {
            $msg = "Device added successfully";
            header("Location: ../add-calibration.php?success=$msg");
            exit();
        } else {
            $em = "Database error: " . $stmt->error;
            header("Location: ../add-calibration.php?error=$em");
            exit();
        }

    } else {
        $em = "All fields are required";
        header("Location: ../add-calibration.php?error=$em");
        exit();
    }

} else { 
    $em = "Please login first";
    header("Location: ../login.php?error=$em");
    exit();
}
?>
