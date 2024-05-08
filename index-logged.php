<?php
  include('getUser.php');
  include('connect.php');
  include('includes/imports.php');

  $query1 = "SELECT gender, COUNT(gender) as count from tbluserprofile group by gender";
  $resultset1 = mysqli_query($connection, $query1);

  $queryTotalUsers = "SELECT COUNT(*) AS total_users FROM tbluserprofile";
  $resultTotalUsers = mysqli_query($connection, $queryTotalUsers);
  $rowTotalUsers = mysqli_fetch_assoc($resultTotalUsers);
  $totalUsers = $rowTotalUsers['total_users'];

  // Query to get the count of users for each birth month
  $queryBirthMonth = "SELECT MONTH(birthdate) AS birth_month, COUNT(*) AS total_users FROM tbluserprofile GROUP BY MONTH(birthdate)";
  $resultBirthMonth = mysqli_query($connection, $queryBirthMonth);
  
  // Create an array to store birth month data
  $birthMonthData = array_fill(1, 12, 0);

  // Fill birth month data array with counts from result set
  while($row = mysqli_fetch_assoc($resultBirthMonth)) {
      $birthMonthData[$row['birth_month']] = $row['total_users'];
  }

  // Store gender statistics data in arrays
  $genderLabels = [];
  $genderData = [];
  while ($row = mysqli_fetch_assoc($resultset1)) {
    $genderLabels[] = $row['gender'];
    $genderData[] = $row['count'];
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="css/index.css" rel="stylesheet" />
  <link href="css/cssDashboard.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Eventify | Home</title>
</head>

<body>
  <!-- Header -->
  <?php
    if($current_user['usertype']=='ADMIN') {
        include('includes/headerAdmin.php');
    } else {
        include('includes/header.php');
    }
  ?>
  <!-- Main Content -->
  <div class="center-wrapper">
    <section class="PageContent">

      <!-- Total Users -->
      <div class="total-users">
        <h1 class="welcome-message">Eventify has a total of <?php echo $totalUsers ?> users worldwide!</h1>
      </div>

      <!-- Gender Statistics Table -->
      <div class="gender-stats">
        <h2>Gender Statistics</h2>
        <table id="tblGenderStat" cellspacing="5" width="100%"> 
          <thead class="label-form">
            <tr> 
              <th class="colHead">Gender</th> 
              <th class="colHead">Count</th> 
            </tr> 
          </thead>  
          <tbody class="label-form">
            <?php
              foreach ($genderLabels as $index => $label) {
                $category = '';
                if ($label == 'MALE') {
                  $category = 'Males';
                } elseif ($label == 'FEMALE') {
                  $category = 'Females';
                } else {
                  $category = 'Others';
                }
            ?>
            <tr>
              <td class="elemCenter"><?php echo $category ?></td>
              <td class="elemCenter"><?php echo $genderData[$index] ?></td>
            </tr>
            <?php } ?>
          </tbody> 
        </table>
      </div>

      <!-- Pie Chart for Gender Statistics -->
      <div class="gender-pie-chart">
        <h2>Gender Pie Chart</h2>
        <center><canvas id="genderPieChart" width="300" height="300"></canvas></center>
      </div>


      <!-- Birth Month Statistics -->
      <div class="birth-month-stats">
        <h2>Birth Month Statistics</h2>
        <table id="tblBirthMonthStat" cellspacing="5" width="100%"> 
          <thead class="label-form">
            <tr> 
              <th class="colHead">Month</th> 
              <th class="colHead">Total Users</th> 
            </tr> 
          </thead>  
          <tbody class="label-form">
            <?php
              // Loop through all months (1 to 12) and display birth month statistics
              for ($i = 1; $i <= 12; $i++) {
                  $monthName = date('F', mktime(0, 0, 0, $i, 1));
                  $totalUsers = $birthMonthData[$i];
            ?>
            <tr>
              <td class="elemCenter"><?php echo $monthName; ?></td>
              <td class="elemCenter"><?php echo $totalUsers; ?></td>
            </tr>
            <?php } ?>
          </tbody> 
        </table>
      </div>

    </section>
  </div>

</body>

  <footer style="position: relative; min-height: 25vh">
    <?php
        include("includes/footerO.php");
    ?>
  </footer>


  
</html>

<script>
  // JavaScript code to render pie chart
  var ctx = document.getElementById('genderPieChart').getContext('2d');
  var genderPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: <?php echo json_encode($genderLabels); ?>,
      datasets: [{
        data: <?php echo json_encode($genderData); ?>,
        backgroundColor: [
          'rgba(54, 162, 235, 0.7)',
          'rgba(255, 99, 132, 0.7)',
          'rgba(255, 206, 86, 0.7)'
        ],
        borderColor: [
          'rgba(54, 162, 235, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(255, 206, 86, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: true,
        position: 'bottom'
      },
      responsive: true,
      maintainAspectRatio: false,
      aspectRatio: 1
    }
  });

</script>