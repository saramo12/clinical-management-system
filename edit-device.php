<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "DB_connection.php";
    include "app/Model/User.php";
    
    // التحقق من وجود id في الرابط
    if (!isset($_GET['id'])) {
        header("Location: device.php");
        exit();
    }
    
    $id = $_GET['id'];
    $user = get_user_by_id($conn, $id);

    // التحقق من صحة البيانات المرسلة
    if ($user == 0) {
        header("Location: device.php");
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
            <h4 class="title">Edit Devices <a href="device.php">Devices</a></h4>
            
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
                    <label for="serial_number">Serial Number</label>
                    <input type="text" name="serial_number" id="serial_number" class="input-1" placeholder="Serialnumber" value="<?= htmlspecialchars($user['serialnumber']); ?>" required />
                </div>
                <div class="input-holder">
                    <label for="floor">Floor</label>
                    <input type="text" name="floor" id="floor" class="input-1" placeholder="Floor" value="<?= htmlspecialchars($user['floor']); ?>"  />
                </div>
                
                <div class="input-holder">
                    <label for="department">Department</label>
                    <input type="text" name="department" id="department" class="input-1" placeholder="Department" value="<?= htmlspecialchars($user['department']); ?>"  />
                </div>
                <div class="input-holder">
                    <label for="department_now">Department Now</label>
                    <input type="text" name="department_now" id="department_now" class="input-1" placeholder="Departmentnow" value="<?= htmlspecialchars($user['departmentnow']); ?>"  />
                </div>
                <div class="input-holder">
                    <label for="room">Room</label>
                    <input type="text" name="room" id="room" class="input-1" placeholder="Room" value="<?= htmlspecialchars($user['room']); ?>"  />
                </div>
                
                <div class="input-holder">
                    <label for="device_name">device Name</label>
                    <input type="text" name="device_name" id="device_name" class="input-1" placeholder="Devicename" value="<?= htmlspecialchars($user['devicename']); ?>" required />
                </div>
                 




















<div class="input-holder">
                    <label for="accessories">Accessories</label>
                    <input type="text" name="accessories" id="accessories" class="input-1" placeholder="Accessories" value="<?= htmlspecialchars($user['accessories']); ?>"  />
                </div>
                <div class="input-holder">
                    <label for="manufacturer">Manufacturer</label>
                    <input type="text" name="manufacturer" id="manufacturer" class="input-1" placeholder="Manufacturer" value="<?= htmlspecialchars($user['manufacturer']); ?>"  />
                </div>
                
                <div class="input-holder">
                    <label for="origin">Origin</label>
                    <input type="text" name="origin" id="origin" class="input-1" placeholder="Origin" value="<?= htmlspecialchars($user['origin']); ?>"  />
                </div>
                <div class="input-holder">
                    <label for="compamy">Company</label>
                    <input type="text" name="compamy" id="compamy" class="input-1" placeholder="Company" value="<?= htmlspecialchars($user['company']); ?>"  />
                </div>
                <div class="input-holder">
                    <label for="model">Model</label>
                    <input type="text" name="model" id="model" class="input-1" placeholder="Model" value="<?= htmlspecialchars($user['model']); ?>"  />
                </div>
                
                <div class="input-holder">
                    <label for="qt">QT</label>
                    <input type="text" name="qt" id="qt" class="input-1" placeholder="QT" value="<?= htmlspecialchars($user['qt']); ?>"  />
                </div>



<div class="input-holder">
                    <label for="bmd_code">BMD Code</label>
                    <input type="text" name="bmd_code" id="bmd_code" class="input-1" placeholder="BMDcode" value="<?= htmlspecialchars($user['bmdcode']); ?>" required />
                </div>
                <div class="input-holder">
                 
                
               
<div class="input-holder">
                    <label for="arraival_date">Arraival Date</label>
                    <input type="text" name="arraival_date" id="arraival_date" class="input-1" placeholder="Arraivaldate" value="<?= htmlspecialchars($user['arraivaldate']); ?>"  />
                </div>

<div class="input-holder">
                    <label for="installation_date">Installation Date</label>
                    <input type="text" name="installation_date" id="installation_date" class="input-1" placeholder="Installationdate" value="<?= htmlspecialchars($user['installationdate']); ?>"  />
                </div>


<div class="input-holder">
                    <label for="purchasing_order">Purchasing Order</label>
                    <input type="text" name="purchasing_order" id="purchasing_order" class="input-1" placeholder="Purchasingorder" value="<?= htmlspecialchars($user['purchasingorder']); ?>"  />
                </div>

<div class="input-holder">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" class="input-1" placeholder="Price" value="<?= htmlspecialchars($user['price']); ?>"  />
                </div>
<div class="input-holder">
                    <label for="warranty_period">Warranty Period Start</label>
                    <input type="text" name="warranty_period" id="warranty_period" class="input-1" placeholder="Warrantyperiod" value="<?= htmlspecialchars($user['warrantyperiod']); ?>" required />
                </div>

<div class="input-holder">
                    <label for="warranty_period-start">Warranty Period Start</label>
                    <input type="text" name="warranty_period-start" id="warranty_period-start" class="input-1" placeholder="Warrantyperiodstart" value="<?= htmlspecialchars($user['warrantyperiodstart']); ?>" required />
                </div>




<div class="input-holder">
                    <label for="warranty_period-end">Warranty Period End</label>
                    <input type="text" name="warranty_period-end" id="warranty_period-end" class="input-1" placeholder="Warrantyperiodend" value="<?= htmlspecialchars($user['warrantyperiodend']); ?>" required />
                </div>


<div class="input-holder">
                    <label for="company-contact">   Company Contact</label>
                    <input type="text" name="company-contact" id="company-contact" class="input-1" placeholder="Companycontact" value="<?= htmlspecialchars($user['companycontact']); ?>"  />
                </div><div class="input-holder">
                    <label for="company-telephone">Company Telephone</label>
                    <input type="text" name="company-telephone" id="company-telephone" class="input-1" placeholder="companytelephone" value="<?= htmlspecialchars($user['companytelephone']); ?>"  />
                </div>



<div class="input-holder">
    <label for="device_safety_test">Device Safety Test</label>
    <select name="device_safety_test" id="device_safety_test" class="input-1" required>
        <option value="">-- Select --</option>
        <option value="Passed" <?= $user['devicesafetytest'] == 'Passed' ? 'selected' : '' ?>>Passed</option>
        <option value="Not Passed" <?= $user['devicesafetytest'] == 'Not Passed' ? 'selected' : '' ?>>Not Passed</option>
    </select>
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
