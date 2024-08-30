
<?php 
  include_once "../connection.php";
 ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Getting Started with Chart JS with www.chartjs3.com</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
      }
      .chartMenu {
        width: 100vw;
        height: 40px;
        background: #1A1A1A;
        color: rgba(54, 162, 235, 1);
      }
      .chartMenu p {
        padding: 10px;
        font-size: 20px;
      }
      .chartCard {
        width: 100vw;
        height: calc(100vh - 40px);
        background: rgba(54, 162, 235, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .chartBox {
        width: 700px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(54, 162, 235, 1);
        background: white;
      }
    </style>
  </head>
  <body>
   <!-- SELECT YEAR(valid_upto) as year,MONTH(valid_upto) AS month,COUNT(DISTINCT id) FROM tblbloodbag GROUP BY year,month;
SELECT year(receive_date),month(receive_date),count(id) FROM `tblbloodbag` WHERE status=0 GROUP BY year(receive_date),month(receive_date);
    -->
    <div class="chartCard">
      <div class="chartBox">
        <?php 
          $str=$conn->prepare("SELECT year(receive_date),month(receive_date),count(id) FROM `tblbloodbag` WHERE status=0 GROUP BY year(receive_date),month(receive_date)");
          $str->execute();
          $count=array();
          // $data=$str->fetchAll();
          while($row=$str->fetch()){
            $count[]=$row['count(id)'];

          }
           $str=$conn->prepare("SELECT year(receive_date),month(receive_date),count(id) FROM `tblbloodbag` WHERE status=2 GROUP BY year(receive_date),month(receive_date)");
          $str->execute();
          $receive=array();
          // $data=$str->fetchAll();
          while($row=$str->fetch()){
            $receive[]=$row['count(id)'];

          }

          // echo "<pre>";
          // echo print_r($count);
         ?>


        <canvas id="myChart"></canvas>
      </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script>

      // console.log(<?php echo json_encode($count); ?>);
      const donate=<?php echo json_encode($count); ?>;
      const receive=<?php echo json_encode($receive); ?>;
    // setup 
    const data = {
      labels: ['February','March','April','May','Jun','July'],
      datasets: [{
        label: 'Blood Donate',
        data: donate,
        backgroundColor: 'rgba(255, 26, 104, 0.2)',
        borderColor: 'rgba(255, 26, 104, 1)',
        borderWidth: 1
      },
      {
        label: 'Blood Receive',
        data: receive,
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );

    // Instantly assign Chart.js version
    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;
    </script>

  </body>
</html>






<!-- <?php
 
$dataPoints1 = array(
  array("label"=> "2010", "y"=> 36.12),
  array("label"=> "2011", "y"=> 34.87),
  array("label"=> "2012", "y"=> 40.30),
  array("label"=> "2013", "y"=> 35.30),
  array("label"=> "2014", "y"=> 39.50),
  array("label"=> "2015", "y"=> 50.82),
  array("label"=> "2016", "y"=> 74.70)
);
$dataPoints2 = array(
  array("label"=> "2010", "y"=> 64.61),
  array("label"=> "2011", "y"=> 70.55),
  array("label"=> "2012", "y"=> 72.50),
  array("label"=> "2013", "y"=> 81.30),
  array("label"=> "2014", "y"=> 63.60),
  array("label"=> "2015", "y"=> 69.38),
  array("label"=> "2016", "y"=> 98.70)
);
  
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Average Amount Spent on Real and Artificial X-Mas Trees in U.S."
  },
  axisY:{
    includeZero: true
  },
  legend:{
    cursor: "pointer",
    verticalAlign: "center",
    horizontalAlign: "right",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "column",
    name: "Real Trees",
    indexLabel: "{y}",
    yValueFormatString: "$#0.##",
    showInLegend: true,
    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
  },{
    type: "column",
    name: "Artificial Trees",
    indexLabel: "{y}",
    yValueFormatString: "$#0.##",
    showInLegend: true,
    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
function toggleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else{
    e.dataSeries.visible = true;
  }
  chart.render();
}
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>   -->