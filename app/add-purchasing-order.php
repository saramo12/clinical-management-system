<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {

    if (
        isset($_POST['id']) &&
        isset($_POST['device_name']) &&
        isset($_POST['company_name']) &&
        isset($_POST['purchasing_order_date']) &&
        isset($_POST['qt']) &&
        isset($_POST['price']) &&
        
                isset($_POST['hospital_code']) 

    ) {
        include "../DB_connection.php";

        function validate_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        // استلام البيانات
        $id = validate_input($_POST['id']);
        $device_name = validate_input($_POST['device_name']);
        $company_name = validate_input($_POST['company_name']);
        $purchasing_order_date = validate_input($_POST['purchasing_order_date']);
        $qt = validate_input($_POST['qt']);
        $price = validate_input($_POST['price']);
        
                $hospital_code = validate_input($_POST['hospital_code']);


        // إعداد استعلام الإدخال
        $sql = "INSERT INTO purchasingorder (
                    id, device_name,company_name,purchasing_order_date, qt, price,hospital_code
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?,
                )";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssss",
            $id, $device_name,$company_name, $purchasing_order_date, $qt, $price,$hospital_code
        );

        if ($stmt->execute()) {
            $msg = "Device added successfully";
            header("Location: ../add-purchasing-order.php?success=$msg");
            exit();
        } else {
            $em = "Database error: " . $stmt->error;
            header("Location: ../add-purchasing-order.php?error=$em");
            exit();
        }

    } else {
        $em = "All fields are required";
        header("Location: ../add-purchasing-order.php?error=$em");
        exit();
    }

} else { 
    $em = "Please login first";
    header("Location: ../login.php?error=$em");
    exit();
}
?>
