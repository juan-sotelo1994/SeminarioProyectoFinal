<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

  }
?>
<?php if(isset($_SESSION['id'])) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Al Ferretero</title>
    <link rel="stylesheet" href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" href="../../backend/img/ca.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
     <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="../../backend/css/datatable.css">
    <link rel="stylesheet" type="text/css" href="../../backend/css/buttonsdataTables.css">
    <link rel="stylesheet" type="text/css" href="../../backend/css/font.css">
    <style type="text/css">
 .loader-container{
   
}

.load_animation{
  width: 100%;
  height: 100vh;
  font-size: 4rem ;
  background-color: #fff;
  z-index: 500;
  position: fixed;
  top: 0;
  left: 0;
  overflow: hidden;
  
}
.animation {
  position: absolute;
  top: 50%;
  left: 50%;
  border: 3px solid rgb(0, 0, 0);
  border-radius: 50%;
  box-sizing: content-box;
  padding: 10px;
  transform: translate(-50% , -50%) ;
  opacity: .5;
  animation: spinner 1s infinite;
  transition: .1s;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
@keyframes spinner {
  50% {
    transform: translate(-50% , -50%) ;
    border: 2px solid rgba(0, 0, 0, 0.178);
    padding: 30px;
  }
  100% {
    opacity: 1;
    transform:translate(-50% , -50%) rotate(360deg);
    border: 3px solid rgba(0, 0, 0, 0);
    padding: 17rem;
    color: #233975;
  }

}


    </style>

</head>
<body>
    <div class="loader-container">
    <div class="load_animation">
        <ion-icon name="bag-handle-outline" class="animation"></ion-icon>
    </div>
</div>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            
        </div>
        
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(../../backend/img/user13.png)"></div>
                <h4><?php echo $_SESSION['username']; ?></h4>
                <small>Administrador</small>
            </div>

            <div class="side-menu">
                <ul>
                    
                    <li>
                       <a href="../productos/mostrar.php" class="active">
                            <span class="las la-shopping-cart"></span>
                            <small>Productos</small>
                        </a>
                    </li>
                    <li>
                       <a href="../categorias/mostrar.php">
                            <span class="las la-paperclip"></span>
                            <small>Categorias</small>
                        </a>
                    </li>
                   
                    <li>
                        <a href="../clientes/mostrar.php">
                            <span class="las la-user-friends"></span>
                            <small>Clientes</small>
                        </a>
                    </li>
                    <li>
                       <a href="../proveedores/mostrar.php">
                            <span class="las la-user-friends"></span>
                            <small>Proveedores</small>
                        </a>
                    </li>

                    <li>
                       <a href="../ventas/venta.php">
                            <span class="las la-money-bill"></span>
                            <small>Ventas</small>
                        </a>
                    </li>

                    <li>
                       <a href="../compra/mostrar.php">
                            <span class="las la-store"></span>
                            <small>Compras</small>
                        </a>
                    </li>

                    <li>
                       <a href="../salir.php">
                            <span class="las la-power-off"></span>
                            <small>Salir</small>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                
                <div class="header-menu">
                
                    <div class="user">
                        <div class="bg-img" style="background-image: url(../../backend/img/user13.png)"></div>

                    </div>
                </div>
            </div>
        </header>
        
        <main>
            
            <div class="page-header">
                <h1>Bienvenido <?php echo '<strong>'.$_SESSION['nombre'].'</strong>'; ?></h1>
                <small>Home / Productos / Actualizar</small>
            </div>
            
            <div class="page-content">
            <?php 
require '../../backend/config/Conexion.php';
$id = $_GET['id'];
 $sentencia = $connect->prepare("SELECT productos.idprod,productos.codpro ,productos.nomprd, productos.desprd, productos.foto, productos.precio, productos.stock, marca.idmar, marca.nomarc, categoria.idcate, categoria.nocate,productos.modelo, productos.peso, productos.state, productos.fere FROM productos INNER JOIN marca ON productos.idmar = marca.idmar INNER JOIN categoria ON productos.idcate = categoria.idcate WHERE idprod= '$id';");
 $sentencia->execute();

$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
  ?>
  <?php if(count($data)>0):?>
        <?php foreach($data as $d):?>
<form action="" enctype="multipart/form-data" method="POST"  autocomplete="off">
  <div class="containerss">
    <h1>Actualizar producto</h1>
    <div class="alert-danger">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Importante!</strong> Es importante rellenar los campos con &nbsp;<span class="badge-warning">*</span>
</div>
    <hr>
    <br>
    <label for="email"><b>Código del producto</b></label><span class="badge-warning">*</span>
    <input type="text" value="<?php echo $d->codpro; ?>" maxlength="14" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="ejm: 22478754784578" name="prdcod"  required>

    <input type="hidden" value="<?php echo $d->idprod; ?>" name="prdid">

    <label for="email"><b>Nombre del producto</b></label><span class="badge-warning">*</span>
    <input type="text" value="<?php echo $d->nomprd; ?>" placeholder="ejm: Laptop Lenovo" name="prdnom"  required>

    <label for="email"><b>Descripción del producto</b></label><span class="badge-warning">*</span>
    <textarea required value="<?php echo $d->desprd; ?>" name="prddes" id="consl" required placeholder="Write something.." style="height:200px"><?php echo $d->desprd; ?></textarea>

    <label for="email"><b>Precio del producto</b></label><span class="badge-warning">*</span>
    <input type="text" value="<?php echo $d->precio; ?>" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  placeholder="ejm: 299" name="prdprec"  required>
    
    <label for="psw"><b>Marca del producto</b></label><span class="badge-warning">*</span>
    <select required name="prdmarc" id="marc">
        <option value="<?php echo $d->idmar; ?>"><?php echo $d->nomarc; ?></option>
        <option>-------------------Seleccione------------------</option>

        <?php 
    $stmt = $connect->prepare('SELECT * FROM marca');
    $stmt->execute();

while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            ?>
            <option value="<?php echo $idmar; ?>"><?php echo $nomarc; ?></option>
            <?php
        }
        ?>
     ?>
        
    </select>

    <label for="psw"><b>Categoria del producto</b></label><span class="badge-warning">*</span>
    <select required name="prdcate" id="cat">
        <option value="<?php echo $d->idcate; ?>"><?php echo $d->nocate; ?></option>
        <option>-----------------------------Seleccione------------------------------------</option>

        <?php 
    $stmt = $connect->prepare('SELECT * FROM categoria');
    $stmt->execute();

while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            ?>
            <option value="<?php echo $idcate; ?>"><?php echo $nocate; ?></option>
            <?php
        }
        ?>
     ?>
    </select>

    <label for="email"><b>Modelo del producto</b></label><span class="badge-warning">*</span>
    <input type="text" value="<?php echo $d->modelo; ?>" placeholder="ejm: Lenovo" name="prdmod"  required>

     <label for="email"><b>Peso del producto</b></label><span class="badge-warning">*</span>
    <input type="text" value="<?php echo $d->peso; ?>" placeholder="ejm: 20kg" name="prdpes"  required>
                   
    </div>


    <hr>
   
    <button type="submit" name="upd_prodct" class="registerbtn">Guardar</button>
  </div>
  
</form>

 <?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>
            
            </div>
            
        </main>
        
    </div>

    <script src="../../backend/js/jquery.min.js"></script>
   
    <script type="text/javascript">
        $(window).on("load",function(){
            $(".load_animation").fadeOut(1000);
        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include_once '../../backend/php/upd_prodct.php' ?>
    <script type="text/javascript" src="../../backend/js/reenvio.js"></script>

 

</body>
</html>

<?php }else{ 
    header('Location: ../login.php');
 } ?>