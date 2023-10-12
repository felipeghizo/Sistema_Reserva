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
    <link rel="stylesheet" type="text/css" href="style/style.css"/>
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
                    <li><a href="admin.php">Reservas</a></li>
                    <li><a href="#">Sobre</a></li>
                    <li><a href="#">Contato</a></li>
                </ul>
            </nav>
            <div class="clear"></div>
        </div>
    </header>
    <section class="reserva">
        <div class="center">
            <?php
                if(isset($_POST["acao"])){

                    $nome = $_POST["nome"];

                    $dateHora = $_POST["dataHora"];
                    $date = DateTime::createFromFormat("d/m/Y H:i:s", $dateHora);
                    $dateHora = $date->format("Y-m-d H:i:s");

                    $sql = $pdo->prepare("INSERT INTO tb_agendados VALUES (null, ?, ?)");
                    $sql->execute(array($nome, $dateHora));
                    echo "<script>alert('Olá ".$nome."! Seu horário foi agendado com sucesso as ".substr($dateHora, -7)." do dia ".substr($dateHora, 0, 11)."')</script>";
                }
            ?>
            <form method="post">
                <input type="text" name="nome" placeholder="Seu nome..."/>
                <select name="dataHora">
                    <?php
                        for($i=0; $i <= 23; $i++){
                            $hora = $i;
                            if($i < 10){
                                $hora = "0".$hora;
                            }

                            $hora .= ":00:00";

                            $verifica = date("Y-m-d")." ".$hora;
                            $sql = $pdo->prepare("SELECT * FROM tb_agendados WHERE horario = '$verifica'");
                            $sql->execute();

                            if($sql->rowCount() == 0 && strtotime($verifica) > time()){
                                $dateHora = date("d/m/Y")." ".$hora;
                                echo "<option value='".$dateHora."'>".$dateHora."</option>";
                            }
                        }
                    ?>
                </select>
                <input type="submit" name="acao" value="Enviar!"/> 
            </form>
        </div>
    </section>
</body>
</html>