        <?php
        $id_cabecera_cpp = $_POST['id_cabecera_cpp'];
        $sql_recibos = "SELECT * FROM detalle_cuenta_pagar WHERE id_cabecera_cpp = '$id_cabecera_cpp'";
        $query_recibos = mysqli_query($conexion, $sql_recibos);
        $num_rows = mysqli_num_rows($query_recibos);
        if ($num_rows > 0) {
            $tabla = `
            <table>
                <thead>
                    <tr>
                        <th>Numero documento</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                        <th>Forma de Pago</th>
                        <th>Recibo</th>
                    </tr>
                </thead>
                <tbody>
            `;
        ?>


            <?php
            while ($row_recibos = mysqli_fetch_array($query_recibos)) {
                $id_detalle_cpp = $row_recibos['id_detalle_cpp'];
                $valor = $row_recibos['valor'];
                $forma_pago = $row_recibos['metodo_pago'];
                $id_pago = $row_recibos['id_pago'];

                $sql_pago = "SELECT * FROM pagos WHERE id_pago = '$id_pago'";
                $query_pago = mysqli_query($conexion, $sql_pago);
                $row_pago = mysqli_fetch_array($query_pago);
                $numero_documento = $row_pago['numero_documento'];
                $imagen = $row_pago['imagen'];
                $tabla .= `
                        <tr>
                            <td>$numero_documento</td>
                            <td>$fecha</td>
                            <td>$valor</td>
                            <td>$forma_pago</td>
                            <td><a href="$imagen" target="_blank"><i class="fa fa-file-pdf-o"></i></a></td>
                        </tr>
                    `;
            }

            $tabla .= `
            </tbody>
            </table>
            `;
            echo $tabla;
        } else {
            echo "No hay recibos";
        }
