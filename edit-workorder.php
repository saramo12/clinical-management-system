<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "DB_connection.php";
    include "app/Model/User.php";
    
    // التحقق من وجود id في الرابط
    if (!isset($_GET['id'])) {
        header("Location: workorder.php");
        exit();
    }
    
    $id = $_GET['id'];
    $user = get_user_by_id($conn, $id);

    // التحقق من صحة البيانات المرسلة
    if ($user == 0) {
        header("Location: workorder.php");
        exit();
    }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f7f9ff;
            color: #333;
        }
        .section-1 {
            background: #fff;
            padding: 30px 40px;
            margin: 40px auto;
            max-width: 600px;
            border-radius: 14px;
            box-shadow: 0 12px 28px rgba(102, 126, 234, 0.15);
        }
        .title {
            font-size: 24px;
            margin-bottom: 30px;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .title a {
            background: #667eea;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 3px 8px rgba(102,126,234,0.5);
            transition: background-color 0.3s ease;
        }
        .title a:hover {
            background: #5a6ccf;
        }

        .form-1 {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .input-holder {
            display: flex;
            flex-direction: column;
        }
        .input-holder label {
            font-weight: 600;
            margin-bottom: 6px;
            color: #4a4a4a;
        }
        .input-1 {
            padding: 12px 18px;
            border-radius: 10px;
            border: 1.5px solid #cbd5e1;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        .input-1:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 8px rgba(102, 126, 234, 0.4);
        }

        .edit-btn {
            background: linear-gradient(45deg, #38b2ac, #319795);
            border: none;
            color: #fff;
            font-weight: 700;
            padding: 14px 0;
            border-radius: 28px;
            font-size: 18px;
            box-shadow: 0 5px 18px rgba(49, 151, 149, 0.6);
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            user-select: none;
        }
        .edit-btn:hover {
            background: linear-gradient(45deg, #2c7a7b, #285e61);
            box-shadow: 0 8px 24px rgba(40, 94, 97, 0.8);
            color: #e0f7f7;
        }

        .success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 12px 20px;
            border-radius: 8px;
            color: #155724;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 12px 20px;
            border-radius: 8px;
            color: #721c24;
            margin-bottom: 20px;
            font-weight: 600;
        }
        small {
            color: #666;
            font-size: 13px;
            margin-top: -12px;
            margin-bottom: 12px;
            user-select: none;
        }
    </style>
</head>
<body>
    <input type="checkbox" id="checkbox" />
    <?php include "inc/header.php"; ?>
    
    <div class="body">
        <?php include "inc/nav.php"; ?>
        
        <section class="section-1">
            <h4 class="title">Edit Workorder <a href="workorder.php">Workorder</a></h4>
            
            <!-- عرض رسائل الخطأ أو النجاح -->
            <?php if (isset($_GET['error'])) { ?>
                <div class="danger" role="alert">
                    <?= htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <div class="success" role="alert">
                    <?= htmlspecialchars($_GET['success']); ?>
                </div>
            <?php } ?>
            
            <!-- نموذج تعديل المستخدم -->
            <form class="form-1" method="POST" action="app/update-user.php">
                <div class="input-holder">
                    <label for="id">Id</label>
                    <input type="text" name="id" id="id" class="input-1" placeholder="Id" value="<?= htmlspecialchars($user['id']); ?>" required />
                </div>
                <div class="input-holder">
                    <label for="device_serial">Device Serial</label>
                    <input type="text" name="device_serial" id="device_serial" class="input-1" placeholder="Deviceserial" value="<?= htmlspecialchars($user['deviceserial']); ?>"  />
                </div>
                
                <div class="input-holder">
                    <label for="requested_by">Requested By</label>
                    <input type="text" name="requested_by" id="requested_by" class="input-1" placeholder="Requestedby" value="<?= htmlspecialchars($user['requestedby']); ?>"  />
                </div>
                <div class="input-holder">
                    <label for="department">Department </label>
                    <input type="text" name="department" id="department" class="input-1" placeholder="Department" value="<?= htmlspecialchars($user['department']); ?>"  />
                </div>
                <div class="input-holder">
                    <label for="date_received">Date Received</label>
                    <input type="text" name="date_received" id="date_received" class="input-1" placeholder="Datereceived" value="<?= htmlspecialchars($user['datereceived']); ?>"  />
                </div>
                
                <div class="input-holder">
                    <label for="time_received">Time Received</label>
                    <input type="text" name="time_received" id="time_received" class="input-1" placeholder="Timereceived" value="<?= htmlspecialchars($user['timereceived']); ?>"  />
                </div>
                 




















<div class="input-holder">
                    <label for="issue_description">Issue Description</label>
                    <input type="text" name="issue_description" id="issue_description" class="input-1" placeholder="Issuedescription" value="<?= htmlspecialchars($user['issuedescription']); ?>"  />
                </div>
                <div class="input-holder">
                    <label for="repair_description">Repair Description</label>
                    <input type="text" name="repair_description" id="repair_description" class="input-1" placeholder="Repairdescription" value="<?= htmlspecialchars($user['repairdescription']); ?>"  />
                </div>
                
                <div class="input-holder">
                    <label for="inhouse_fixed_by">Inhouse Fixed By</label>
                    <input type="text" name="inhouse_fixed_by" id="inhouse_fixed_by" class="input-1" placeholder="Inhousefixedby" value="<?= htmlspecialchars($user['inhousefixedby']); ?>"  />
                </div>
                <div class="input-holder">
                    <label for="contacted_manufacturer">Contacted Manufacturer</label>
                    <input type="text" name="contacted_manufacturer" id="contacted_manufacturer" class="input-1" placeholder="Contactedmanufacturer" value="<?= htmlspecialchars($user['contactedmanufacturer']); ?>"  />
                </div>
                <div class="input-holder">
                    <label for="outhouse_fixed_by">Outhouse Fixed By</label>
                    <input type="text" name="outhouse_fixed_by" id="outhouse_fixed_by" class="input-1" placeholder="Outhousefixedby" value="<?= htmlspecialchars($user['outhousefixedby']); ?>"  />
                </div>
                
                <div class="input-holder">
                    <label for="repair_cost">Repair Cost</label>
                    <input type="text" name="repair_cost" id="repair_cost" class="input-1" placeholder="Repaircost" value="<?= htmlspecialchars($user['repaircost']); ?>"  />
                </div>



<div class="input-holder">
                    <label for="repair_type">Repair Type</label>
                    <input type="text" name="repair_type" id="repair_type" class="input-1" placeholder="Repairtype" value="<?= htmlspecialchars($user['repairtype']); ?>" required />
                </div>
                <div class="input-holder">
                 
                
               
<div class="input-holder">
                    <label for="used_spare_parts">Used Spare Parts</label>
                    <input type="text" name="used_spare_parts" id="used_spare_parts" class="input-1" placeholder="Usedspareparts" value="<?= htmlspecialchars($user['usedspareparts']); ?>"  />
                </div>

<div class="input-holder">
                    <label for="status">Status</label>
                    <input type="text" name="status" id="status" class="input-1" placeholder="Status" value="<?= htmlspecialchars($user['status']); ?>"  />
                </div>


<div class="input-holder">
                    <label for="start_date">Start Date</label>
                    <input type="text" name="start_date" id="start_date" class="input-1" placeholder="Startdate" value="<?= htmlspecialchars($user['startdate']); ?>"  />
                </div>

<div class="input-holder">
                    <label for="start_time">Start Time</label>
                    <input type="text" name="start_time" id="start_time" class="input-1" placeholder="Starttime" value="<?= htmlspecialchars($user['starttime']); ?>"  />
                </div>
<div class="input-holder">
                    <label for="end_date">End Date</label>
                    <input type="text" name="end_date" id="end_date" class="input-1" placeholder="Enddate" value="<?= htmlspecialchars($user['enddate']); ?>" required />
                </div>

<div class="input-holder">
                    <label for="end_time">End Time</label>
                    <input type="text" name="end_time" id="end_time" class="input-1" placeholder="Endtime" value="<?= htmlspecialchars($user['endtime']); ?>" required />
                </div>




<div class="input-holder">
                    <label for="downtime_duration">Downtime Duration</label>
                    <input type="text" name="downtime_duration" id="downtime_duration" class="input-1" placeholder="Downtimeduration" value="<?= htmlspecialchars($user['downtimeduration']); ?>" required />
                </div>



<div class="input-holder">
                    <label for="hospital_code">Hospital Code</label>
                    <input type="text" name="hospital_code" id="hospital_code" class="input-1" placeholder="Hospitalcode" value="<?= htmlspecialchars($user['hospitalcode']); ?>" required />
                </div>















































               

                <button class="edit-btn" type="submit">Update</button>
            </form>
        </section>
    </div>

    <script type="text/javascript">
        var active = document.querySelector("#navList li:nth-child(2)");
        if (active) active.classList.add("active");
    </script>
</body>
</html>
<?php 
} else { 
    $em = "First login";
    header("Location: login.php?error=$em");
    exit();
}
?>
