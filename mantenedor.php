<?php
//Importar conexión
require("conection.php");

//consulta constante
const SQL_SELECT = "SELECT f.id_farmaco as 'id_farmaco', f.nombre_far as 'farmaco', l.nombre_lab as 'laboratorio', 
                    f.stock as 'stock', f.precio as 'precio' FROM farmaco as f 
                    inner join farmaco_lab as flb on f.id_farmaco = flb.id_farmaco 
                    inner join laboratorio as l on l.id_lab = flb.id_lab WHERE f.stock > 0 ORDER BY f.stock DESC";
//variable para listar                  
$list = $mysqli->query(SQL_SELECT);

//consulta constante para buscar laboratorios
const SQL_SELECT_LABS = "SELECT * FROM laboratorio";
//variable para mostrar consulta
$labList = $mysqli->query(SQL_SELECT_LABS);

//Agregar farmaco
if(isset($_POST['btnGuardar'])){
    $nombre = $_POST['nombre'];
    $lab = $_POST['laboratorio'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];
    $detalle = $_POST['detalle'];
    $sqlInsert = "INSERT INTO farmaco(nombre_far, stock, precio, detalle) VALUES('$nombre', '$stock', '$precio', '$detalle')";
    $agregar = $mysqli->query($sqlInsert);
    //primero inserto el farmaco, luego recupero el id para hacer el insert en la tabla relacional farmaco_lab
    $id = $mysqli->insert_id;
    
    //realizo el insert en la tabla relacional
    $sqlInsertRelacion = "INSERT INTO farmaco_lab(id_farmaco, id_lab) VALUES('$id', '$lab')";
    $agregar = $mysqli->query($sqlInsertRelacion);

    //sobreescribo la variable list
    $list = $mysqli->query(SQL_SELECT);
}

//filtro
if(isset($_GET['btnBuscar'])){
    $id = $_GET['lab'];
    if($id != ''){
    $sqlFiltro = "SELECT f.nombre_far as 'farmaco', l.nombre_lab as 'laboratorio', f.stock as 'stock', f.precio as 'precio' 
                  FROM farmaco as f 
                  inner join farmaco_lab as flb on f.id_farmaco = flb.id_farmaco 
                  INNER JOIN laboratorio as l on flb.id_lab = l.id_lab WHERE l.id_lab = '$id' ORDER BY f.stock DESC";
    $list = $mysqli->query($sqlFiltro);
    }
}

//disminuir el stock -1 cuando den click al enlace
if(isset($_GET['id'])){
    if(isset($_GET['stock'])){
        $idFarmaco = $_GET['id'];
        $stockActual = $_GET['stock'];
        $stockActualizado = $stockActual - 1;
        $sqlUpdate = "UPDATE farmaco SET stock='$stockActualizado' WHERE id_farmaco = '$idFarmaco'";
        $mysqli->query($sqlUpdate);
        $list = $mysqli->query(SQL_SELECT);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Farmacia</title>
</head>

<body>
    <div class="container">
        <h2>Búsqueda de farmacos</h2>

        <!-- filtro -->
        <div class="row">
            <form action="mantenedor.php" class="col s9" method="GET" name="filtro" id="filtro">
                <div class="input-field">
                    <select name="lab" id="lab">
                        <option value="">Seleccione</option>
                        <?php 
                        foreach($labList as $lab){
                            echo '<option value="'.$lab['id_lab'].'">'.$lab['nombre_lab'].'</option>';
                        }
                    ?>
                    </select>
                    <label>Laboratorio</label>
                </div>
                <button type="submit" name="btnBuscar" id="btnBuscar"
                    class="btn waves-effect waves-light col s2">Buscar</button>
            </form>
        </div>

        <!-- Tabla -->

        <div class="row">
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Laboratorio</th>
                        <th>Stock</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $row){?>
                    <tr>
                        <td><a href="mantenedor.php?id=<?php echo $row['id_farmaco']?>&stock=<?php echo $row['stock']?>">
                                <?php echo $row['farmaco'];?></a></td>
                        <td><?php echo $row['laboratorio']; ?></td>
                        <td><?php echo $row['stock']; ?></td>
                        <td><?php echo $row['precio']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!--Formulario para agregar nuevos farmacos-->

        <h2>Agregar nuevo farmaco</h2>
        <div class="row">
            <form action="mantenedor.php" method="post" name="form" id="form" class="col s12" onsubmit="return validar();">
                <div class="input-field">
                    <input type="text" name="nombre" id="nombre" class="validate" required>
                    <label for="nombre">Nombre</label>
                </div>

                <div class="input-field">
                    <select name="laboratorio" id="laboratorio" class="validate">
                        <option value="" selected disabled>Seleccione</option>
                        <?php 
                        foreach($labList as $lab){
                            echo '<option value="'.$lab['id_lab'].'">'.$lab['nombre_lab'].'</option>';
                        }
                        ?>
                    </select>
                    <label for="lab">Laboratorio</label>
                </div>

                <div class="input-field">
                    <input type="number" name="stock" id="stock" class="validate" required>
                    <label for="stock">Stock</label>
                </div>

                <div class="input-field">
                    <input type="number" name="precio" id="precio" class="validate" required>
                    <label for="precio">Precio</label>
                </div>

                <div class="input-field">
                    <textarea name="detalle" id="detalle" cols="30" rows="10" class="materialize-textarea"></textarea>
                    <label for="detalle">Detalle</label>
                </div>

                <button type="submit" name="btnGuardar" id="btnGuardar"
                    class="btn waves-effect waves-light">Guardar</button>
            </form>
        </div>
    </div>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>