<?php  
  require_once('../../backend/config/Conexion.php');
 if(isset($_POST['add_prodct']))
 {
  //$username = $_POST['user_name'];// user name
  //$userjob = $_POST['user_job'];// user email
    $codpro=$_POST['prdcod'];
    $nomprd=$_POST['prdnom'];
    $desprd=$_POST['prddes'];

    $imgFile = $_FILES['foto']['name'];
    $tmp_dir = $_FILES['foto']['tmp_name'];
    $imgSize = $_FILES['foto']['size'];

    $precio=$_POST['prdprec'];
    $stock=$_POST['prdstco'];
    $idmar=$_POST['prdmarc'];
    $idcate=$_POST['prdcate'];
    $modelo=$_POST['prdmod'];
    $peso=$_POST['prdpes'];
    
  if(empty($codpro)){
   $errMSG = "Please enter your code.";
  }
  else if(empty($nomprd)){
   $errMSG = "Please Enter your name.";
  }

  {
   $upload_dir = '../../backend/img/subidas/'; // upload directory
 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
   $foto = rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$foto);
    }
    else{
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }



  }
  
  if(!isset($errMSG))
  {
   $stmt = $connect->prepare("INSERT INTO productos(codpro, nomprd,desprd,foto,precio,stock,idmar,idcate,modelo,peso,state) VALUES(:codpro, :nomprd,:desprd,:foto,:precio,:stock,:idmar,:idcate,:modelo,:peso, '1')");
   $stmt->bindParam(':codpro',$codpro);
   $stmt->bindParam(':nomprd',$nomprd);
   $stmt->bindParam(':desprd',$desprd);
   $stmt->bindParam(':foto',$foto);
   $stmt->bindParam(':precio',$precio);
   $stmt->bindParam(':stock',$stock);
   $stmt->bindParam(':idmar',$idmar);
   $stmt->bindParam(':idcate',$idcate);
   $stmt->bindParam(':modelo',$modelo);
   $stmt->bindParam(':peso',$peso);


   if($stmt->execute())
   {
    echo '<script type="text/javascript">
swal("¡Registrado!", "Agregado correctamente", "success").then(function() {
            window.location = "../productos/mostrar.php";
        });
        </script>';
   }
   else
   {
    $errMSG = "error while inserting....";
   }

  }
 
 }
?>