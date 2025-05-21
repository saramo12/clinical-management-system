<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Biomedical Reports Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" crossorigin="anonymous"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right,rgb(226, 226, 224),rgb(233, 232, 231));
      color: #333;
    }

    .main-content {
      margin: auto;
      padding: 40px;
      background-color: #ffffffee;
      min-height: 100vh;
      max-width: 1000px;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    }

    .main-content h1 {
      text-align: center;
      font-size: 34px;
      margin-bottom: 30px;
      color:rgb(30, 1, 158);
    }

    .form-row {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      font-size: 16px;
      color: #444;
    }

    input[type="date"],
    input[type="text"] {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 15px;
      background-color:rgb(255, 255, 255);
    }

    .button-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }

    .button-grid button {
      padding: 15px;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 600;
      transition: all 0.3s ease-in-out;
    }

    .button-grid button:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
    }

    
    .button-grid button:nth-child(1) { background: linear-gradient(to right, #24c6dc, #514a9d); }
        .button-grid button:nth-child(2) { background: linear-gradient(to right, #24c6dc, #514a9d); }
    .button-grid button:nth-child(3) { background: linear-gradient(to right, #24c6dc, #514a9d); }
    .button-grid button:nth-child(4) { background: linear-gradient(to right, #24c6dc, #514a9d); }
    .button-grid button:nth-child(5) { background: linear-gradient(to right, #24c6dc, #514a9d); }
    .button-grid button:nth-child(6) { background: linear-gradient(to right, #24c6dc, #514a9d); }
    .button-grid button:nth-child(7) { background: linear-gradient(to right, #24c6dc, #514a9d); }
    .button-grid button:nth-child(8) { background: linear-gradient(to right, #24c6dc, #514a9d); }
    .button-grid button:nth-child(9) { background: linear-gradient(to right, #24c6dc, #514a9d); }

  </style>
</head>
<body>

<main class="main-content">
  <h1>Biomedical Report Dashboard</h1>
  <form method="POST" action="report-results.php" target="_blank">
    <div class="form-row">
      <label for="received_within">Received within</label>
      <input type="date" name="received_within" id="received_within" required>
    </div>
    <div class="form-row">
      <label for="name">Name</label>
      <input type="text" name="name" id="name">
    </div>
    <div class="button-grid">
      <button type="submit" name="report_type" value="closed_pending">Closed VS Pending</button>
      <button type="submit" name="report_type" value="external_internal">External VS Internal</button>
      <button type="submit" name="report_type" value="downtime">Down Time</button>
      <button type="submit" name="report_type" value="equipment_quantity">Equipment Quantity</button>
      <button type="submit" name="report_type" value="failure_type">Failure Type % / Year</button>
      <button type="submit" name="report_type" value="pm_vs_all">PM VS ALL</button>
      <button type="submit" name="report_type" value="grouped_eq">WOs by Equipment Model</button>
      <button type="submit" name="report_type" value="employee">WOs by Employees</button>
      <button type="submit" name="report_type" value="repair_count">Equipment Repair Count</button>
    </div>
  </form>
</main>

</body>
</html>