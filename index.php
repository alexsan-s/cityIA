<?php session_start();
$jsonString = file_get_contents('data.json');
$data = json_decode($jsonString, true); ?>


<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="./build/sigma.min.js"></script>
    <script src="./build/plugins/sigma.parsers.json.min.js"></script>

    <script>
        sigma.parsers.json('data.json', {
            container: 'sigma_div',
            settings: {
                // mouseEnabled: false,
                defaultEdgeColor: '#333',
                defaultNodeColor: '#333',
                edgeColor: 'default'
            }
        });
    </script>
</head>

<body>
    <?php
    if (isset($_SESSION['erro'])) {
        echo "<script> alert('{$_SESSION['erro']}')</script>";
        unset($_SESSION['erro']);
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">Sobre</a>
                </li>

            </ul>
        </div>
    </nav>
    <div class="col-sm-11 mx-auto">
        <form action="/action.php" method="post">
            <div class="form-group row">
                <label class="d-flex align-items-center">Origem</label>
                <div class="col-sm-3">
                    <select class="form-control" id="" name="source">
                        <?php
                        foreach ($data as $key => $entry) {
                            if ($key == "nodes") {
                                for ($i = 0; $i < sizeof($entry); $i++) {
                        ?>
                                    <option value=" <?php echo $data[$key][$i]['id']; ?> " <?php
                                                                                            if (isset($_SESSION['source'])) {
                                                                                                if (trim($_SESSION['source']) == $data[$key][$i]['id']) {
                                                                                                    echo 'selected';
                                                                                                } else {
                                                                                                    echo '';
                                                                                                }
                                                                                            } ?>> <?php echo $data[$key][$i]['label']; ?> </option>
                        <?php
                                }
                            }
                        }
                        ?>

                    </select>
                </div>
                <label class="d-flex align-items-center">Destino</label>
                <div class="col-sm-3">
                    <select class="form-control" id="" name="destiny">
                        <?php
                        foreach ($data as $key => $entry) {
                            if ($key == "nodes") {
                                for ($i = 0; $i < sizeof($entry); $i++) {
                        ?>
                                    <option value=" <?php echo $data[$key][$i]['id']; ?> " <?php
                                                                                            if (isset($_SESSION['destiny'])) {
                                                                                                if (trim($_SESSION['destiny']) == $data[$key][$i]['id']) {
                                                                                                    echo 'selected';
                                                                                                } else {
                                                                                                    echo '';
                                                                                                }
                                                                                            } ?>> <?php echo $data[$key][$i]['label']; ?> </option>
                        <?php
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <label class="d-flex align-items-center">Limite</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="limit" <?php if (isset($_SESSION['limit'])) { echo "value='{$_SESSION['limit']}'"; } ?> >
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Amplitude" name="amplitude">
            <input class="btn btn-primary" type="submit" value="Profundidade" name="depth">
            <input class="btn btn-primary" type="submit" value="Profundidade Limitada" name="depth_limit">
            <input class="btn btn-primary" type="submit" value="Aprofundamento Interativo" name="iterative_deepening">
            <input class="btn btn-primary" type="submit" value="Bidirecional" name="bidirectional">
            <input class="btn btn-primary" type="submit" value="Custo Uniforme" name="unifor_cost">
            <input class="btn btn-primary" type="submit" value="Greedy" name="greedy">
            <input class="btn btn-primary" type="submit" value="A Estrela" name="a_star">
        </form>
        <div class="alert alert-primary">
            <?php echo $_SESSION['way']; ?>
            <p>
                <?php echo $_SESSION['cost'];
                ?>
        </div>
        <div id="sigma_div" style="height: 500; background-image: url()"></div>
    </div>

</body>

</html>