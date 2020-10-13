<?php session_start(); ?>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="col-sm-10">
        <form action="/action.php" method="post">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Origem</label>
                <select class="form-control" id="exampleFormControlSelect1" name="source">
                    <option value="A" <?php if(isset($_SESSION['source'])){if($_SESSION['source']=="A" ){ echo 'selected' ;}else{ echo '' ;}} ?> >A </option>
                    <option value="B" <?php if(isset($_SESSION['source'])){if($_SESSION['source']=="B" ){ echo 'selected' ;}else{ echo '' ;}} ?> >B </option>
                    <option value="C" <?php if(isset($_SESSION['source'])){if($_SESSION['source']=="C" ){ echo 'selected' ;}else{ echo '' ;}} ?> >C </option>
                    <option value="D" <?php if(isset($_SESSION['source'])){if($_SESSION['source']=="D" ){ echo 'selected' ;}else{ echo '' ;}} ?> >D </option>
                    <option value="E" <?php if(isset($_SESSION['source'])){if($_SESSION['source']=="E" ){ echo 'selected' ;}else{ echo '' ;}} ?> >E </option>
                    <option value="F" <?php if(isset($_SESSION['source'])){if($_SESSION['source']=="F" ){ echo 'selected' ;}else{ echo '' ;}} ?> >F </option>
                    <option value="G" <?php if(isset($_SESSION['source'])){if($_SESSION['source']=="G" ){ echo 'selected' ;}else{ echo '' ;}} ?> >G </option>
                    <option value="H" <?php if(isset($_SESSION['source'])){if($_SESSION['source']=="H" ){ echo 'selected' ;}else{ echo '' ;}} ?> >H </option>
                    <option value="P" <?php if(isset($_SESSION['source'])){if($_SESSION['source']=="P" ){ echo 'selected' ;}else{ echo '' ;}} ?> >P </option>
                    <option value="Q" <?php if(isset($_SESSION['source'])){if($_SESSION['source']=="Q" ){ echo 'selected' ;}else{ echo '' ;}} ?> >Q </option>
                    <option value="R" <?php if(isset($_SESSION['source'])){if($_SESSION['source']=="R" ){ echo 'selected' ;}else{ echo '' ;}} ?> >R </option>
                    <option value="S" <?php if(isset($_SESSION['source'])){if($_SESSION['source']=="S" ){ echo 'selected' ;}else{ echo '' ;}} ?> >S </option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Destino</label>
                <select class="form-control" id="exampleFormControlSelect1" name="destiny">
                    <option value="A" <?php if(isset($_SESSION['destiny'])){if($_SESSION['destiny']=="A" ){ echo 'selected' ;}else{ echo '' ;}} ?>>A</option>
                    <option value="B" <?php if(isset($_SESSION['destiny'])){if($_SESSION['destiny']=="B" ){ echo 'selected' ;}else{ echo '' ;}} ?>>B</option>
                    <option value="C" <?php if(isset($_SESSION['destiny'])){if($_SESSION['destiny']=="C" ){ echo 'selected' ;}else{ echo '' ;}} ?>>C</option>
                    <option value="D" <?php if(isset($_SESSION['destiny'])){if($_SESSION['destiny']=="D" ){ echo 'selected' ;}else{ echo '' ;}} ?>>D</option>
                    <option value="E" <?php if(isset($_SESSION['destiny'])){if($_SESSION['destiny']=="E" ){ echo 'selected' ;}else{ echo '' ;}} ?>>E</option>
                    <option value="F" <?php if(isset($_SESSION['destiny'])){if($_SESSION['destiny']=="F" ){ echo 'selected' ;}else{ echo '' ;}} ?>>F</option>
                    <option value="G" <?php if(isset($_SESSION['destiny'])){if($_SESSION['destiny']=="G" ){ echo 'selected' ;}else{ echo '' ;}} ?>>G</option>
                    <option value="H" <?php if(isset($_SESSION['destiny'])){if($_SESSION['destiny']=="H" ){ echo 'selected' ;}else{ echo '' ;}} ?>>H</option>
                    <option value="P" <?php if(isset($_SESSION['destiny'])){if($_SESSION['destiny']=="P" ){ echo 'selected' ;}else{ echo '' ;}} ?>>P</option>
                    <option value="Q" <?php if(isset($_SESSION['destiny'])){if($_SESSION['destiny']=="Q" ){ echo 'selected' ;}else{ echo '' ;}} ?>>Q</option>
                    <option value="R" <?php if(isset($_SESSION['destiny'])){if($_SESSION['destiny']=="R" ){ echo 'selected' ;}else{ echo '' ;}} ?>>R</option>
                    <option value="S" <?php if(isset($_SESSION['destiny'])){if($_SESSION['destiny']=="S" ){ echo 'selected' ;}else{ echo '' ;}} ?>>S</option>
                </select>
            </div>
            <input class="btn btn-primary" type="submit" value="Amplitude" name="amplitude">
            <input class="btn btn-primary" type="submit" value="Profundidade" name="depth">
            <input class="btn btn-primary" type="submit" value="Profundidade Limitada" name="depth_limit">
            <input class="btn btn-primary" type="submit" value="Aprofundamento Interativo" name="iterative_deepening">
            <input class="btn btn-primary" type="submit" value="Bidirecional" name="bidirectional">
            <input class="btn btn-primary" type="submit" value="Custo Uniforme" name="unifor_cost">
        </form>
        <div>
            <?php echo $_SESSION['way'];?>
            <p>
            <?php echo $_SESSION['cost'];?>
        </div>
        <div id="sigma_div" style="width: 700px; height: 300px; background-image: url()"></div>
    </div>

</body>

</html>