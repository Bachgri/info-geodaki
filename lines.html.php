<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js" integrity="sha256-+8RZJua0aEWg+QVVKg4LEzEEm/8RFez5Tb4JBNiV5xA=" crossorigin="anonymous"></script>
    <style>
        #myChart {
            width: 100% !important;
            height: 20vh !important;
            /* position: absolute; */
            /* top: calc((85vh - 50vh)/2); */
        }

        #bt {
            width: 80%;
            height: 40vh;
            position: absolute;
            left: calc((100% - 80% - 40px)/2);
            top: calc((80vh - 40vh - 10vh)/2);
            border-radius: 50%;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            font-size: 32px;
            letter-spacing: 3px;
        }
    </style>
</head>

<body>
    <!-- <button id="sl">show swal</button> -->
    <div id="myChart0" style="width:100%; height:78vh;background-color: white;position: absolute;top: 10vh;">
        <button id="mns" style="display: none;">-</button><button id="parsec" style="position: relative;">Vur par Secteur</button>
        <button id="ale">
            15
        </button>
        <button id="bt">48%</button>
        <canvas id="myChart" style="display: none;"></canvas>
        <canvas id="myChart1" style="display: none;"></canvas>
    </div>

    <script>
        document.querySelector('#parsec').addEventListener('click', function() {
            document.querySelector('#myChart').style.display = 'none'
            document.querySelector('#myChart1').style.display = 'block'
            document.querySelector('#myChart').style.display = 'none'
        });
        document.querySelector('#bt').addEventListener('click', function() {
            document.querySelector('#bt').style.display = 'none';
            document.querySelector('#mns').style.display = 'block';
            document.querySelector('#myChart').style.display = 'block';
            hi();
        })
        document.querySelector('#mns').addEventListener('click', function() {
            document.querySelector('#myChart').style.display = 'none';
            document.querySelector('#mns').style.display = 'none';
            document.querySelector('#myChart').innerHTML = '';
            document.querySelector('#bt').style.display = 'block';
        });

        document.querySelector('#ale').addEventListener('click', function() {
            myChart0.data.datasets[0].data[0] = 1000;
            myChart0.update()
        });
        var myChart = null;
        var myChart0 = null;

        function hi() {

            const ctx = document.getElementById('myChart');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['BeniMakada', 'Mghogha'],
                    datasets: [{
                        label: '# of Votes',
                        data: [120.5 / (120.5 + 190.98) * 100, (190.98 / (190.98 + 120.5) * 100).toFixed(2)],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    indexAxis: 'y'
                }
            });
            const ctx1 = document.getElementById('myChart1');

            myChart0 = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: ['0%->30%', '30%->70%', '70%->100%'],
                    datasets: [{
                        label: '%',
                        data: [95, 22, 54],
                        backgroundColor: [
                            'red',
                            'yellow',
                            'green'
                        ],
                        borderColor: [
                            'red',
                            'yellow',
                            'green'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    indexAxis: 'y',
                    plugins: {
                        legend: {
                            display: true
                        },
                        datalabels: {
                            display: true,
                            font: {
                                size: 20
                            }
                        }
                    }
                }
            });
        }
        hi()
    </script>
</body>

</html>