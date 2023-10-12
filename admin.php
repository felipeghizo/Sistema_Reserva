<?php
    date_default_timezone_set("America/Sao_Paulo");
    $pdo = new PDO("mysql:host=localhost;dbname=sistemas", "root", "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style/style_admin.css"/>
    <title>Reservas</title>
</head>
<body>
    <header>
        <div class="center">
            <div class="logo">
                <h2>Danki Code</h2>
            </div>
            <nav class="menu">
                <ul>
                    <li><a href="#">Reservas Atuais</a></li>
                </ul>
            </nav>
            <div class="clear"></div>
        </div>
    </header>
    <section class="agendamentos">
        <div class="center">
            <?php
                if(isset($_GET["excluir"])){
                    $id = (int)$_GET["excluir"];
                    $pdo->exec("DELETE FROM tb_agendados WHERE id = $id");
                    echo "<script>alert('Agendamento deletado!')</script>";
                
                }

                $info = $pdo->prepare("SELECT * FROM tb_agendados");
                $info->execute();
                $info = $info->fetchAll();
                foreach($info as $key => $value){
            ?>
            <div class="box-single-horario">
                <div class="box-single-wraper">
                    <?php
                        echo "Nome: ".$value["nome"];
                        echo "<br>";
                        echo "Horário: ".date("d/m/Y H:i:s", strtotime($value["horario"]));
                        echo "<br>"; 
                    ?>
                    <a href="?excluir=<?php echo $value['id']; ?>">Excluir!</a>
                </div>
            </div>
            <?php } ?>
            <div class="clear"></div>
        </div>
    </section>
</body>
</html>