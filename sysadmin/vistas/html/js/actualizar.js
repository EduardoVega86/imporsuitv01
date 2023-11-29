const actualizar = () => {
  const dominio = window.location.origin + "/";
  Swal.fire({
    title: "¿Estás seguro?",
    text: "¡Se actualizará el sistema!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "¡Sí, actualizar!",
    cancelButtonText: "¡No, cancelar!",
    reverseButtons: true,
    showLoaderOnConfirm: true,
    preConfirm: async () => {
      const responseAS = await fetch(
        dominio + "actualizacion_sistema291123.php",
        {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
          },
        }
      );
      responseAS.json().then((data) => {
        if (data === "ok") {
          Swal.fire({
            title: "¡Actualización del sistema exitosa!",
            icon: "success",
            showConfirmButton: false,
            timer: 1000,
          }).then(async () => {
            const responseAS = await fetch(dominio + "db_update291123.php", {
              method: "GET",
              headers: {
                "Content-Type": "application/json",
              },
            });
            responseAS.json().then((data) => {
              if (data === "ok") {
                Swal.fire({
                  title: "¡Actualización de la base de datos exitosa!",
                  icon: "success",
                  confirmButtonText: "¡Aceptar!",
                });
              }
            });
          });
        }
      });
    },
  });
};
