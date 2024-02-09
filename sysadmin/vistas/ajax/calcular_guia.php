<?php

require_once "../db.php";
    require_once "../php_conexion.php";
    require_once "../funciones.php";
    
    @$ciudad = $_POST['ciudad'];
    $valor_total = $_POST['valor_total'];
    $cantidad_total = $_POST['cantidad_total'];
    $cod = $_POST['cod'];
    $seguro = $_POST['seguro'];
    $costo=$_POST['costo_total'];
    
    $transportadora=$_POST['transportadora'];
    //echo $costo;
    $valorasegurado=$_POST['valorasegurado'];
    //valorasegurado=$('#valorasegurado').val();
    
    //echo $valor_total;
    if($transportadora==1){     
    $valor_base= get_row('ciudad_laar', 'precio', 'codigo', $ciudad);
    }else{
        if($ciudad==1){
         $valor_base= 5.5;   
        }else{
          $valor_base= 6.5;    
        }
         
    }
    
    //echo $cod;
if ($cod=="1"){
      $cod=$valor_total*0.03;  
    }else{
      $cod=0;  
    }

    if ($seguro==1){
      $seguro=$valorasegurado*0.01;  
    }else{
      $seguro=0;  
    }
    $valor_envio=$valor_base+$cod+$seguro;
    
    $valor_texto="Precio de envío $".number_format($valor_envio,2);
    

    
?>
<table  class="table table-sm table-striped">
    
    <tr> <th>
            <?php
    if ($transportadora=="1"){
        ?>
   <img width="100px" src="../../img_sistema/logo-dark.png" alt=""/>
    <?php
      
    }else{
        ?>
   <img width="100px" src="../../img_sistema/logo_ecom.webp" alt=""/>
    <?php  
    }
    ?>
           
        
        </th>
        <th>$<?php echo number_format($valor_envio,2)?></th>
    </tr>
     <tr> <th>Total Venta </th>
        <td>$<?php echo number_format($valor_total,2)?></td>
    </tr>
    <tr> <th>Costo  </th>
        <td>$<?php echo number_format($costo,2)?></td>
    </tr>
    <tr> <th>Precio de Envío </th>
        <td>$<?php echo number_format($valor_envio,2)?></td>
    </tr>
    <tr> <th>Comisión de la plataforma </th>
        <td>$<?php echo number_format(0,2)?></td>
    </tr>
    <tr> <th>Monto a recibir </th>
        <td>$<?php echo number_format($valor_total-$costo-$valor_envio,2)?></td>
    </tr>
</table>

<input type="hidden" id="valor_envio2" name="valor_envio2" value="<?php echo $valor_envio; ?>" >


