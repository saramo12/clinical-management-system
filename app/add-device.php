<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {

    if (
        isset($_POST['floor']) &&
        isset($_POST['department']) &&
        isset($_POST['department_now']) &&
        isset($_POST['room']) &&
        isset($_POST['device_name']) &&
        isset($_POST['accessories']) &&
        isset($_POST['manufacturer']) &&
        isset($_POST['origin']) &&
        isset($_POST['company']) &&
        isset($_POST['model']) &&
        isset($_POST['serial_number']) &&
        isset($_POST['qt']) &&
        isset($_POST['bmd_code']) &&
        isset($_POST['arrival_date']) &&
        isset($_POST['installation_date']) &&
        isset($_POST['purchasing_order_date']) &&
        isset($_POST['price']) &&
        isset($_POST['warranty_period']) &&
        isset($_POST['warranty_start']) &&
        isset($_POST['warranty_end']) &&
        isset($_POST['company_contact']) &&
        isset($_POST['company_telephone']) &&
                isset($_POST['hospital_code']) &&

        isset($_POST['safety_test'])
    ) {
        include "../DB_connection.php";

        function validate_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        // استلام البيانات
        $floor = validate_input($_POST['floor']);
        $department = validate_input($_POST['department']);
        $department_now = validate_input($_POST['department_now']);
        $room = validate_input($_POST['room']);
        $device_name = validate_input($_POST['device_name']);
        $accessories = validate_input($_POST['accessories']);
        $manufacturer = validate_input($_POST['manufacturer']);
        $origin = validate_input($_POST['origin']);
        $company = validate_input($_POST['company']);
        $model = validate_input($_POST['model']);
        $serial_number = validate_input($_POST['serial_number']);
        $qt = validate_input($_POST['qt']);
        $bmd_code = validate_input($_POST['bmd_code']);
        $arrival_date = $_POST['arrival_date'];
        $installation_date = $_POST['installation_date'];
        $purchasing_order_date = $_POST['purchasing_order_date'];
        $price = validate_input($_POST['price']);
        $warranty_period = validate_input($_POST['warranty_period']);
        $warranty_start = $_POST['warranty_start'];
        $warranty_end = $_POST['warranty_end'];
        $company_contact = validate_input($_POST['company_contact']);
        $company_telephone = validate_input($_POST['company_telephone']);
                $hospital_code = validate_input($_POST['hospital_code']);

        $safety_test = validate_input($_POST['safety_test']);

        // إعداد استعلام الإدخال
        $sql = "INSERT INTO devices (
                    floor, department, department_now, room, device_name, accessories,
                    manufacturer, origin, company, model, serial_number, qt, bmd_code,
                    arrival_date, installation_date, purchasing_order_date, price,
                    warranty_period, warranty_start, warranty_end, company_contact,
                    company_telephone,hospital_code, safety_test
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?
                )";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssssssssssssssss",
            $floor, $department, $department_now, $room, $device_name, $accessories,
            $manufacturer, $origin, $company, $model, $serial_number, $qt, $bmd_code,
            $arrival_date, $installation_date, $purchasing_order_date, $price,
            $warranty_period, $warranty_start, $warranty_end, $company_contact,
            $company_telephone,$hospital_code, $safety_test
        );

        if ($stmt->execute()) {
            $msg = "Device added successfully";
            header("Location: ../add-device.php?success=$msg");
            exit();
        } else {
            $em = "Database error: " . $stmt->error;
            header("Location: ../add-device.php?error=$em");
            exit();
        }

    } else {
        $em = "All fields are required";
        header("Location: ../add-device.php?error=$em");
        exit();
    }

} else { 
    $em = "Please login first";
    header("Location: ../login.php?error=$em");
    exit();
}
?>
