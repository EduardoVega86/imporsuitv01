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
  }).then(async (result) => {
    if (!result.isConfirmed) {
      return;
    } else {
      const response = await fetch(
        dominio + "actualizacion_sistema291123.php",
        {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
          },
        }
      )
        .then((res) => res.json())
        .then((data) => {
          if (data === "ok") {
            Swal.fire({
              title: "¡Actualizado!",
              text: "El sistema se actualizó correctamente.",
              icon: "success",
              showConfirmButton: false,
              timer: 1000,
            }).then((result) => {
              fetch(dominio + "db_update291123.php", {
                method: "GET",
                headers: {
                  "Content-Type": "application/json",
                },
              })
                .then((res) => res.json())
                .then((data) => {
                  if (data === "ok") {
                    Swal.fire({
                      title: "¡Actualizado!",
                      text: "La base de datos se actualizó correctamente.",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1000,
                    });
                  } else {
                    Swal.fire(
                      "¡Error!",
                      "La base de datos no se actualizó correctamente.",
                      "error"
                    );
                  }
                });
            });
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
