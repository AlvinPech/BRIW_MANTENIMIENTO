<?php

$ruta_archivo = 'links.txt';

function leer_archivo($ruta_archivo){
    if(file_exists($ruta_archivo)){
        $archivo = fopen($ruta_archivo, 'r');
        do {
            echo fgets($archivo);
        } while (!feof($archivo));
        fclose($archivo);
    }
}

function find_word($ruta_archivo, $data){
    $dataArray = explode("\r\n", trim($data));
    $lastElementArray = end($dataArray);
    $booleanFindWord = false;


    if(file_exists($ruta_archivo)){
        $archivo = fopen($ruta_archivo, 'r');
        do {
            $currentLine = fgets($archivo);
            if($currentLine === $lastElementArray){
                $booleanFindWord = true;
                break;
            }
        } while (!feof($archivo));
        fclose($archivo);
    }

    if(!$booleanFindWord){
        file_put_contents($ruta_archivo, $data);
    }
}


function escribir_archivo($ruta_archivo){
    if(isset($_POST['textarea'])){
        $data=$_POST['textarea'];

        find_word($ruta_archivo, $data);
        header('Location: links.php');
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="javascript/script.js" defer></script>
    <script src="https://kit.fontawesome.com/7919fb354a.js" crossorigin="anonymous"></script>
    <title>Links</title>
    <!-- jQuery -->
    <script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <nav class="navbar">
        <div class="logo">Links</div>
        <a href="#" class="toggle-btn">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-links">
            <ul>
                <li><a href="index.html">Inicio</a></li>
            </ul>
        </div>
    </nav>
    <div class="links">
        <form method="POST" name="form-link" action="">
            
            <textarea  name="textarea" class="form-control textarea" id="" rows="3" placeholder="Agregar links de busqueda"><?php leer_archivo($ruta_archivo);?></textarea>
            <input type="submit" value="Sync" class="syncbtn" title="Actualizar"><?php escribir_archivo($ruta_archivo); ?></input>
            
            <!-- <input type="button" value="Crawler" class="crawlerbtn" title="Craeler"> -->
            <div class="syncbtn" title="Actualizar" title="Crawler" id="crawler">
                <i class="fas fa-spider"></i>
            </div>
        </form>

    </div>

    <div class="gif" id="charge" style="display: none;">
      <img class="animated-gif" src="image/loader3.gif" alt="">
    </div>

    <!-- Se hace el crawling -->
    <script src="javascript/crawler.js"></script>

</body>
</html>
