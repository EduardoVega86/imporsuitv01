<?php
$datos = mysqli_query($conexion,"SELECT * FROM dropi");
$datos = mysqli_fetch_assoc($datos);
if(!empty($datos)){
    ?>
 <script>
    let usuario = "<?php echo $datos["usuario"];?>"
    let contrasena = "<?php echo $datos["contrasena_hash"];?>"
    var url_origen = location.origin + "/sysadmin/api/integracion/Dropi/login";

    fetch( url_origen, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                correo:usuario, contrasena:contrasena
            })
        }).then(response => response.json()).then(data => console.log(data)).catch(error => console.log(error))
 </script> 
 <?php
}
?>
</body>
</html>
