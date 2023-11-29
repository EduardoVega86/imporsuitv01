const actualizar = () => {
  Swal.fire({
    title: "¿Estás seguro?",
    text: "¡Se actualizará el sistema!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "¡Sí, actualizar!",
    cancelButtonText: "¡No, cancelar!",
    reverseButtons: true,
  }).then(async (result) => {
    console.log(result);
    if (!result.isConfirmed) {
      return;
    } else {
      const response = await fetch("http://localhost/db_update.php", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((res) => res.json())
        .then((data) => {
          if (data === "ok") {
            Swal.fire(
              "¡Actualizado!",
              "El sistema se actualizó correctamente.",
              "success"
            );
          } else {
            Swal.fire(
              "¡Error!",
              "El sistema no se actualizó correctamente.",
              "error"
            );
          }
        });
    }
  });
};
