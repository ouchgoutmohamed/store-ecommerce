
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
       
        color: rgba(54, 162, 235, 1);
      }
      .chartMenu p {
        padding: 10px;
        font-size: 20px;
      }
      .chartCard {
        width: 100vw;
        height: calc(100vh - 40px);
        
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
    <?php include 'admin.html' ?>
<section class="home-section">
    <div class="chartMenu">
      <p style="display:none"><span id="chartVersion"></span></p>
    </div>
    <div class="chartCard">
      <div class="chartBox">
        <canvas id="myChart"></canvas>
      </div>
    </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script>
    // setup 
    async function fetchChartData() {
  const response = await fetch('fetch_data.php');
  const rawData = await response.json();
  
  const data = {
    labels: [],
    productNames: [],
    quantities: []
  };

  rawData.forEach(item => {
    data.labels.push(item.day);
    data.productNames.push(item.product_name);
    data.quantities.push(item.total_quantity);
  });

  return data;
}
async function renderChart() {
  const { labels, productNames, quantities } = await fetchChartData();

  const config = {
  type: 'bar',
  data: {
    labels: productNames,
    datasets: [{
      label: 'Most Sold Product in week',
      data: quantities,
      backgroundColor:[
  'rgba(255, 26, 104, 0.2)',
  'rgba(54, 162, 235, 0.2)',
  'rgba(255, 206, 86, 0.2)',
  'rgba(75, 192, 192, 0.2)',
  'rgba(153, 102, 255, 0.2)',
  'rgba(255, 159, 64, 0.2)',
  'rgba(0, 0, 0, 0.2)'
],
borderColor: [
  'rgba(255, 26, 104, 1)',
  'rgba(54, 162, 235, 1)',
  'rgba(255, 206, 86, 1)',
  'rgba(75, 192, 192, 1)',
  'rgba(153, 102, 255, 1)',
  'rgba(255, 159, 64, 1)',
  'rgba(0, 0, 0, 1)'
],
borderWidth: 1
}]
},
options: {
    indexAxis: 'x',
    plugins: {
      tooltip: {
        callbacks: {
          title: (context) => {
            const index = context[0].dataIndex;
            return `${labels[index]} - ${productNames[index]}`;
          }
        }
      }
    },
    scales: {
      x: {
        beginAtZero: true
      },
      y: {
        beginAtZero: true,
        ticks: {
          stepSize: 1
        }
      }
    }
  }
};

  const ctx = document.getElementById('myChart').getContext('2d');
  const myChart = new Chart(ctx, config);
}

  const chartVersion = document.getElementById('chartVersion');
  chartVersion.innerText = Chart.version;


renderChart();
    </script>

  </body>
</html>