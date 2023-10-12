<style>
    .datos{
        
        border-radius: 0 10px 10px 0;
        font-size: 20px;
    }
    .icon_datos {
  height: 45px;
  width: 35px;
  font-size: 20px;
}
</style>
<div class="modal fade" style="font-size:15px; padding: 10px" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <form method="post" action="gracias.php">
    <div id="gracias" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ENVÍO GRATIS 🚨</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="resultados" class="modal-body">
       
      </div>
        
        <div id="datos" class="col-12 modal-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span style="height: 45px" class="icon_datos input-group-text"><i class="fas fa-user"></i></span>
                </div>
            <input type="text" class="datos form-control" id="nombre" name="nombre" placeholder="Nombre y Apellido *" required>
            <input type="hidden" class="form-control" id="session" name="session" value="<?php echo $session_id;?>">
            <input type="hidden" class="form-control" id="cliente" name="cliente" value="1">
            </div>
    </div>
        
         <div id="datos" class="col-12 modal-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span style="height: 45px" class="icon_datos input-group-text"><i class="fas fa-phone"></i></span>
                </div>
        <input type="text" class="datos form-control" id="telefono" name="telefono" placeholder="Telefono *" required>
            </div>
    </div>
        
        <div id="datos" class="col-12 modal-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span style="height: 45px" class="icon_datos input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
        <input type="text" class="datos form-control" id="calle_principal" name="calle_principal" placeholder="Calle Principal *" required>
            </div>
    </div>
        
        <div id="datos" class="col-12 modal-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span style="height: 45px" class="icon_datos input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
         <input type="text" class="datos form-control" id="calle_secundaria" name="calle_secundaria" placeholder="Calle Secundaria *" required>
            </div>
    </div>
        
        <div id="datos" class="col-12 modal-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span style="height: 45px" class="icon_datos input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
         <input type="text" class="datos form-control" id="referencia" name="referencia" placeholder="Referencia *" required>
            </div>
    </div>
        
       <div id="datos" class="col-12 modal-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span style="height: 45px" class=" icon_datos input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
         <select  class="datos form-control" id="provinica" name="provinica" required>
                  <option value="">Provincia *</option>
                  <?php
                           $sql2="select * from provincia_laar ";
                           $query2 = mysqli_query($conexion, $sql2);
                        
                            $rowcount=mysqli_num_rows($query2);
                            //echo $rowcount;
                            $i=1;
                           while ($row2 = mysqli_fetch_array($query2)) {
                               $id_prov       = $row2['id_prov']; 
                                 $provincia      = $row2['provincia']; 
                           
?>
        <option value="<?php echo $id_prov; ?>"><?php echo $provincia; ?></option>
         <?php }?>
         </select>
            </div>
    </div>
        
         <div id="datos" class="col-12 modal-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span style="height: 45px" class="icon_datos input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
        <input type="text" class="datos form-control" id="ciudad" name="ciudad" placeholder="Ciudad *" required>
            </div>
    </div>
      
     <div id="datos" class="col-12 modal-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span style="height: 45px" class="icon_datos input-group-text"><i class="fas fa-arrow-right"></i></span>
                </div>
       <input type="text" class="datos form-control" id="observacion" name="observacion" placeholder="Referencias Adicionales (Opcional)">
            </div>
    </div>
        
       
       
      <div class="modal-footer">
        
          <button type="submit" style="width:100%; height: 40px; font-size: 20px"  class="btn boton"><span class="texto_boton"> Completa tu compra</span></button>
      </div>
    </div>
      </form>
  </div>
</div>