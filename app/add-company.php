<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {

    if (
        isset($_POST['name']) &&
        isset($_POST['phone']) &&
        isset($_POST['address']) &&
        isset($_POST['email']) &&
        isset($_POST['contact_name1']) &&
        isset($_POST['contact_title1']) &&
        isset($_POST['contact_mobile1']) &&
       isset($_POST['contact_name2']) &&
        isset($_POST['contact_title2']) &&
        isset($_POST['contact_mobile2']) &&
        isset($_POST['contact_name3']) &&
        isset($_POST['contact_title3']) &&
        isset($_POST['contact_mobile3']) &&
                isset($_POST['hospital_code']) 

    ) {
        include "../DB_connection.php";

        function validate_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        // استلام البيانات
        $name           = validate_input($_POST['name']);
        $phone         = validate_input($_POST['phone']);
        $address            = validate_input($_POST['address']);
        $email        = validate_input($_POST['email']);
        $contact_name1 = validate_input($_POST['contact_name1']);
        $contact_title1 = validate_input($_POST['contact_title1']);
        $contact_phone1 = validate_input($_POST['contact_phone1']);
        $contact_name2 = validate_input($_POST['contact_name2']);
        $contact_title2 = validate_input($_POST['contact_title2']);
        $contact_phone2 = validate_input($_POST['contact_phone2']);
        $contact_name3 = validate_input($_POST['contact_name3']);
        $contact_title3 = validate_input($_POST['contact_title3']);
        $contact_phone3 = validate_input($_POST['contact_phone3']);
        
                $hospital_code = validate_input($_POST['hospital_code']);


        // إعداد استعلام الإدخال
        $sql = "INSERT INTO companies (
                    name, phone, address, email, contact_name1, contact_title1,contact_phone1,
contact_name2, contact_title2,contact_phone2,contact_name3, contact_title3,contact_phone3,hospital_code
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                )";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssssssss",
            $name         ,
        $phone        ,
        $address        ,
        $email       ,
        $contact_name1 ,
        $contact_title1 ,
        $contact_phone1 ,
        $contact_name2 ,
        $contact_title2 ,
        $contact_phone2 ,
        $contact_name3 ,
        $contact_title3,
        $contact_phone3,
        
                $hospital_code ,

        );

        if ($stmt->execute()) {
            $msg = "Device added successfully";
            header("Location: ../add-company.php?success=$msg");
            exit();
        } else {
            $em = "Database error: " . $stmt->error;
            header("Location: ../add-company.php?error=$em");
            exit();
        }

    } else {
        $em = "All fields are required";
        header("Location: ../add-company.php?error=$em");
        exit();
    }

} else { 
    $em = "Please login first";
    header("Location: ../login.php?error=$em");
    exit();
}
?>
