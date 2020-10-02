<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['', 'PMJN'],
                [3, 4],
                [2, 6],
                [3, 10],
            ]);

            var options = {
                legend: '',
                pointSize: 20,
                series: {
                    0: {
                        pointShape: 'circle'
                    },
                    1: {
                        pointShape: 'circle'
                    },
                    2: {
                        pointShape: 'circle'
                    },
                    3: {
                        pointShape: 'circle'
                    },
                    4: {
                        pointShape: 'circle'
                    },
                    5: {
                        pointShape: 'circle'
                    },
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <div class="col-sm-8">
        <form action="/action.php" method="post">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Origem</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Destino</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <input class="btn btn-primary" type="submit" value="Amplitude" name="amplitude">
            <input class="btn btn-primary" type="submit" value="Profundidade" name="depth">
            <input class="btn btn-primary" type="submit" value="Profundidade Limitada" name="depth_limit">
            <input class="btn btn-primary" type="submit" value="Aprofundamento Interativo" name="iterative_deepening">
            <input class="btn btn-primary" type="submit" value="Bidirecional" name="bidirectional">
        </form>
        <div id="chart_div" style="width: 900px; height: 500px;"></div>
    </div>

</body>

</html>