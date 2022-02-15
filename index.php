<?php
    //Si se quiere subir una imagen
    if (isset($_POST['subir'])) {
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['archivo']['name'];
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
        //Obtenemos algunos datos necesarios sobre el archivo
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
            echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
            - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
        }
        else {
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor
            if (move_uploaded_file($temp, 'images/'.$archivo)) {
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod('images/'.$archivo, 0777);
            }
            else {
            //Si no se ha podido subir la imagen, mostramos un mensaje de error
            echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
            }
        }
    }
    }

    $nombre_fichero = 'images/custom_logo.png';
    $existe = false;

    if (file_exists($nombre_fichero)) {
        $existe = true;
    } else {
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.cdnfonts.com/css/mv-boli" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css" media="screen" />
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <title>Document</title>
</head>
<body>
    <div id="CPrin">
        <div id="CCab">
            <div id="CLogo">
                <?php if($existe): ?>
                    <img src="images/custom_logo.png">
                <?php else: ?>
                    <img src="images/logo.png">
                <?php endif; ?>
            </div>
            <div id="CCarga"> 
                <form enctype="multipart/form-data" action="index.php" method="POST">
                    <label id="EtForm" for="file-upload" class="custom-file-upload">
                        <i class="fa-solid fa-cloud-arrow-up fa-2xl"></i>
                    </label>
                    <input id="file-upload" type="file" name="archivo"/>
                    <input name="subir" id="file-send" type="submit" value="Enviar Archivo" />
                </form>
            </div>
        </div>
    </div>
    <hr id="sepCab">
    <div id="CMenu">
        <ul>
            <li><a class="ElMenu" href="#">Nosotros</a></li>
            <li><a class="ElMenu" href="#">Qué ofrecemos</a></li>
            <li><a class="ElMenu" href="#">Localización</a></li>
            <li><a class="ElMenu" href="#">Contacto</a></li>
        </ul>
    </div>
</body>
</html>
