<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {

    if (
        isset($_POST['id']) &&
        isset($_POST['device_serial']) &&
        isset($_POST['requested_by']) &&
        isset($_POST['department']) &&
        isset($_POST['date_received']) &&
        isset($_POST['time_received']) &&
        isset($_POST['issue_description']) &&
        isset($_POST['repair_description']) &&
        isset($_POST['inhouse_fixed_by']) &&
        isset($_POST['contacted_manufacturer']) &&
        isset($_POST['outhouse_fixed_by']) &&
        isset($_POST['repair_cost']) &&
        isset($_POST['repair_type']) &&
        isset($_POST['used_spare_parts']) &&
        isset($_POST['status']) &&
        isset($_POST['start_date']) &&
        isset($_POST['start_time']) &&
        isset($_POST['end_date']) &&
        isset($_POST['end_time']) &&
        isset($_POST['downtime_duration']) &&
                isset($_POST['hospital_code']) 

    ) {
        include "../DB_connection.php";

        function validate_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        // استلام البيانات
        $id = validate_input($_POST['id']);
        $device_serial = validate_input($_POST['device_serial']);
        $requested_by = validate_input($_POST['requested_by']);
        $department = validate_input($_POST['department']);
        $date_received = validate_input($_POST['date_received']);
        $time_received = validate_input($_POST['time_received']);
        $issue_description = validate_input($_POST['issue_description']);
        $repair_description = validate_input($_POST['repair_description']);
        $inhouse_fixed_by = validate_input($_POST['inhouse_fixed_by']);
        $contacted_manufacturer = validate_input($_POST['contacted_manufacturer']);
        $outhouse_fixed_by = validate_input($_POST['outhouse_fixed_by']);
        $repair_cost = validate_input($_POST['repair_cost']);
        $repair_type = validate_input($_POST['repair_type']);
        $used_spare_parts = $_POST['used_spare_parts'];
        $status = $_POST['status'];
        $start_date = $_POST['start_date'];
        $start_time = validate_input($_POST['start_time']);
        $end_date = validate_input($_POST['end_date']);
        $end_time = $_POST['end_time'];
        $downtime_duration = $_POST['downtime_duration'];
                $hospital_code = validate_input($_POST['hospital_code']);


        // إعداد استعلام الإدخال
        $sql = "INSERT INTO workorder (
                    id, device_serial,requested_by,department, date_received, time_received, issue_description, repair_description,
                    inhouse_fixed_by, contacted_manufacturer, outhouse_fixed_by, repair_cost, repair_type, used_spare_parts, status,
                    start_date, start_time, end_date, end_time,
                    downtime_duration,hospital_code
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                )";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssssssssssssss",
            $id, $device_serial,$requested_by,$department, $date_received, $time_received, $issue_description, $repair_description,
                    $inhouse_fixed_by, $contacted_manufacturer,$outhouse_fixed_by, $repair_cost, $repair_type, $used_spare_parts, $status,
                    $start_date, $start_time, $end_date, $end_time,
                    $downtime_duration,$hospital_code
        );

        if ($stmt->execute()) {
            $msg = "Device added successfully";
            header("Location: ../add-workorder.php?success=$msg");
            exit();
        } else {
            $em = "Database error: " . $stmt->error;
            header("Location: ../add-workorder.php?error=$em");
            exit();
        }

    } else {
        $em = "All fields are required";
        header("Location: ../add-workorder.php?error=$em");
        exit();
    }

} else { 
    $em = "Please login first";
    header("Location: ../login.php?error=$em");
    exit();
}
?>
