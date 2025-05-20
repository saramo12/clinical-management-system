<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {

    if (
        isset($_POST['name']) &&
        
        isset($_POST['contact_name']) &&
        isset($_POST['contact_title']) &&
        isset($_POST['phone']) &&
        isset($_POST['contact_mobile']) &&
                isset($_POST['contact_email']) &&

        isset($_POST['note']) &&

                isset($_POST['hospital_code']) 

    ) {
        include "../DB_connection.php";

        function validate_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        // استلام البيانات
        $name           = validate_input($_POST['name']);
         $contact_name = validate_input($_POST['contact_name']);
        $contact_title = validate_input($_POST['contact_title']);
        $phone         = validate_input($_POST['phone']);
                $contact_mobile       = validate_input($_POST['contact_mobile']);

        $contact_email        = validate_input($_POST['contact_email']);
       
                $note         = validate_input($_POST['note']);

        
                $hospital_code = validate_input($_POST['hospital_code']);


        // إعداد استعلام الإدخال
        $sql = "INSERT INTO manufacturer (
                    name,  contact_name, contact_title,phone,contact_mobile, contact_email,note,
,hospital_code
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?
                )";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssss",
            $name         ,
            $contact_name ,
        $contact_title ,
        
        $phone ,
        $contact_mobile ,
        $contact_email       ,
        $contact_phone2 ,
        $note ,
        $hospital_code ,

        );

        if ($stmt->execute()) {
            $msg = "Device added successfully";
            header("Location: ../add-manufacturer.php?success=$msg");
            exit();
        } else {
            $em = "Database error: " . $stmt->error;
            header("Location: ../add-manufacturer.php?error=$em");
            exit();
        }

    } else {
        $em = "All fields are required";
        header("Location: ../add-manufacturer.php?error=$em");
        exit();
    }

} else { 
    $em = "Please login first";
    header("Location: ../login.php?error=$em");
    exit();
}
?>
