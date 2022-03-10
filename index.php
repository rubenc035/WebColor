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
            if (move_uploaded_file($temp, 'images/'.'custom_logo.png')) {
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod('images/'.'custom_logo.png', 0777);
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
    <script src="js/colorDetector.js"></script>
    <title>Document</title>
</head>
<body >
    <div id="CPrin">
        <div id="CCab">
            <canvas id="CLogo">
                <?php if($existe): ?>
                    <script type="text/javascript">
                        var canvas = document.getElementById("CLogo");
                        if (canvas && canvas.getContext) {
                            var ctx = canvas.getContext("2d");
                            var img=new Image();
                            img.src = "images/custom_logo.png";

                            img.onload = function() {
                                ctx.drawImage(this, 0, 25 );
                                colores();
                            }
                        }

                    </script>
                <?php else: ?>
                    <script type="text/javascript">
                        var canvas = document.getElementById("CLogo");
                        if (canvas && canvas.getContext) {
                            var ctx = canvas.getContext("2d");
                            var img=new Image();
                            img.src = "images/logo.png";

                            img.onload = function() {
                                ctx.drawImage(this, 0, 25 );
                            }
                        }
                        //var rgb = ctx.getImageData(5, 5, 1, 1).data; //<-- un pixel en las coordenadas  5 y 5
                    </script>
                <?php endif; ?>
            </canvas>
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

    <div id="contColor">
        <div id="col1" class="cColor"></div>
        <div id="col2" class="cColor"></div>
        <div id="col3" class="cColor"></div>
        <div id="col4" class="cColor"></div>
    </div>
</body>
</html>
