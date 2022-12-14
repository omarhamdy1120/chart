<!DOCTYPE html>
<html lang="en">
<head>
<title>DahabMasr LTD - Chart</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.3.0/chartjs-plugin-zoom.min.js"></script>



</head>
    <body>
    <button id="all" class="btn btn-info">All Years</button>

    <div id="canvasWrapper">
    
    <canvas id="canvas" style="max-width:1900px;"></canvas>
    </div>
    </div>
    <div class="input-group">
        <p id="text">Filter From  : </p>
        <input type="month" class="form-control dates" id="startdate">
        <input type="month" class="form-control dates" id="enddate">
        <button id="reset" class="btn btn-danger">Reset Filter</button>
    </div>

<script>
$(document).ready( function() {



$.getJSON("dataChart.json", function(data) {

$.getJSON("dataChartQrt.json", function(data) {

   var labels = data.map(function(e) {

      return e.day;

   });

   var Buy = data.map(function(e) {

      return e.Buy;

   });

   var Sell = data.map(function(e) {

      return e.Sell;

   });

   var WorldPrice = data.map(function(e) {

      return e.WorldPrice;

   });





   var labelsQrt = data.map(function(e) {

      return e.MonthYear;

   });

   var BuyQrt = data.map(function(e) {

      return e.BuyQrt;

   });

   var SellQrt = data.map(function(e) {

      return e.SellQrt;

   });

   var WorldPriceQrt = data.map(function(e) {

      return e.WorldPriceQrt;

   });

   var thisQUARTER= data.map(function(e) {

      return e.thisQUARTER;

   });
   var Date= data.map(function(e) {

    return e.Date;

    });




var Dollar='$';
const footer = (tooltipItems) => {
  var sum = '?? dahabmasr';
  return  sum;
};

var ctx = document.getElementById('canvas').getContext('2d');



   var chart = new Chart(ctx, {

      type: 'line',

      data: {

         labels: Date,

         datasets: [{

            label: 'Buy EGP',

            backgroundColor: 'rgb(35, 153, 59)',

            borderColor: 'rgb(0, 153, 59)',

            data: BuyQrt,

            fill:false,
            yAxisID: 'EGP',
            

         },

         {

            label: 'Sell EGP',

            backgroundColor: 'rgb(200, 35, 35)',

            borderColor: 'rgb(130, 1, 1)',

            data: SellQrt,

            fill:false,
            yAxisID: 'EGP',
            

         },

         {

            label: 'World Price USD',

			   type: 'bar',

            backgroundColor: 'rgb(163, 145, 97)',
            hoverBorderColor: 'rgb(107, 86, 29)',
            hoverBorderWidth: 2,
            borderColor: 'rgb(189, 156, 65)',

            data: WorldPriceQrt,

            fill:false,

            yAxisID: 'USD',
            barPercentage :0.9

         }]
         

      },

      options: {


            responsive: 'true',

            maintainAspectRatio: false,

            interaction: {

                mode: 'index',

                intersect: false,

            },
            stacked: false,
            
            plugins: {
                    zoom: {
                        pan: {
                        enabled: true,
                        mode: 'x',
                    },
                    zoom: {
                        mode: 'x',
                        wheel: {
                        enabled: true
                        
                    },
                },
            },
            title: {
                display: true,
                text: "Gold Spot Chart",
                font: {
                     family: 'Comic Sans MS',
                     size: 22,
                     weight: 'bold',
                     lineHeight: 1.2
                  },
                  padding: {top: 30, left: 0, right: 0, bottom: 0},
            },
            tooltip:{
               callbacks:{
                  footer: footer,
               },
            },
            
            
        },
        
        scales: {

            x: {

                display: true,
                
                ticks: {
                    color: '#876445'
                },
                title: {
                  display: true,
                  text: 'Years - Months',
                  color: 'rgb(163, 145, 97)',
                  font: {
                     family: 'Comic Sans MS',
                     size: 20,
                     weight: 'bold',
                     lineHeight: 1.2,
                  },
                  padding: {top: 20, left: 0, right: 0, bottom: 0}
               },
               min: 50,

            },
            
			EGP: {

				type: 'linear',

				display: false,

				position: 'left',

				max: 1500,

				min: 250,

				ticks: {

					callback: function(value, index, values) {

						value = value.toString();

						value = value.split(/(?=(?:....)*$)/);

						value = value.join('.');

						return value + '??';

					},
                    

				},

				grid: {

					drawOnChartArea: true,

					color:'green', 

				},

			},

			Sell: {

				type: 'linear',

				display: true,

				position: 'left',

				max: 1500,

				min: 300,

				ticks: {

					callback: function(value, index, values) {

						value = value.toString();

						value = value.split(/(?=(?:....)*$)/);

						value = value.join('.');

						return value + '??';

					},
                    color: '#876445',

				},
            title: { 
                  display: true,
                  text: 'Local Price EGP',
                  color: 'red',
                  font: {
                     family: 'Comic Sans MS',
                     size: 22,
                     weight: 'bold',
                     lineHeight: 1.2
                  },
                  padding: {top: 30, left: 0, right: 0, bottom: 0}
               },

				grid: {

					drawOnChartArea: false,

					color:'red', 

				},

			},

			USD: {

				type: 'linear',

				display: true,

				position: 'right',

				max: 2300,

				min: 1100,

				ticks: {

					callback: function(value, index, values) {

						value = value.toString();

						value = value.split(/(?=(?:....)*$)/);

						value = value.join('.');

						return '$' + value;

					},
                    color: '#876445',

				},
            title: { 
                  display: true,
                  text: 'Wolrd Price USD',
                  color: 'blue',
                  font: {
                     family: 'Comic Sans MS',
                     size: 22,
                     weight: 'bold',
                     lineHeight: 1.2
                  },
                  padding: {top: 30, left: 0, right: 0, bottom: 0}
               },

				grid: {

					drawOnChartArea: false,

					color:'blue', 

				},


		},
    },

      }

   }); 
   

   function filterData() {
        const dates2 = [...Date];
        const startdate = document.getElementById('startdate');
        const enddate = document.getElementById('enddate');
        // get the index number in array
        const indexstartdate= dates2.indexOf(startdate.value);
        const indexenddate = dates2.indexOf(enddate.value);
        //console.log(indexstartdate);
        // slice the array (pie) only showing the selected section / slice
        const filterDate = dates2.slice(indexstartdate, indexenddate + 1);
        // replace the labels in the chart
        chart.config.data.labels= filterDate;
        // dataponts Buy
        const datapoints2 = [...BuyQrt];
        const filterDatapoints = datapoints2.slice (indexstartdate,
        indexenddate + 1);
        chart.config.data.datasets[0].data = filterDatapoints;
        // dataponts Sell
        const datapoints3 = [...SellQrt];
        const filterDatapoints3 = datapoints3.slice (indexstartdate,
        indexenddate + 1);
        chart.config.data.datasets[1].data = filterDatapoints3;
        // dataponts WorldPrice
        const datapoints4 = [...WorldPriceQrt];
        const filterDatapoints4 = datapoints4.slice (indexstartdate,
        indexenddate + 1);
        chart.config.data.datasets[2].data = filterDatapoints4;
        
        chart.update();
        }
    


$(".dates").change(filterData);
//}
function reset(){
    //reset Chart
    chart.config.data.labels= Date;
    chart.config.data.datasets[0].data = BuyQrt;
    chart.config.data.datasets[1].data = SellQrt;
    chart.config.data.datasets[2].data = WorldPriceQrt;
    chart.update();
}
$("#reset").click(reset);

function all() {
chart.config.options.scales.x. min = 0;
chart.update();
}
$("#all").click(all);



//    }).resize();

            

//resize



   

}); //getQrt

}); //getregular

}); //ready
</script>
</body>
</head>
</html>