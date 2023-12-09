const wallet = (numero_factura) => {
  const dominio = window.location.origin + "/";

  Swal.fire({
    title: "¿Estás seguro?",
    text: "¡Se generara una nueva billetera de esta factura!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "¡Sí, actualizar!",
    cancelButtonText: "¡No, cancelar!",
    reverseButtons: true,
    showLoaderOnConfirm: true,
    preConfirm: async () => {
      const responseAS = await fetch(
        dominio + "sysadmin/vistas/html/enviar_wallet.php",
        {
          method: "POST",
          body: numero_factura,
        }
      );
      responseAS.json().then((data) => {
        if (data === "ok") {
          Swal.fire({
            title: "¡Actualización de la billetera exitosa!",
            icon: "success",
            confirmButtonText: "¡Aceptar!",
          }).then(() => {
            window.location.reload();
          });
        } else {
          Swal.fire({
            title: "¡Error al actualizar la billetera!",
            icon: "error",
            confirmButtonText: "¡Aceptar!",
          });
        }
      });
    },
  });
};
