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
            text: "¡Espere un momento mientras se actualiza la base de datos!",

            showLoaderOnConfirm: true,
            preConfirm: async () => {
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
            },
          });
        }
      });
    },
  });
};

const dominio = (e) => {
  e.preventDefault();
  const dominioActual = window.location.origin + "/";
  const dominio = document.getElementById("dominio").value;
  const nombre = document.getElementById("nombre").value;
  const formData = new FormData();
  formData.append("dominio", dominio);
  formData.append("nombre", nombre);
  fetch(dominioActual + "sysadmin/vistas/html/dominio.php", {
    method: "POST",
    body: formData,
  }).then((response) => {
    response.json().then((data) => {
      if (data === "ok_ok_ok") {
        Swal.fire({
          title: "¡Dominio actualizado!",
          icon: "success",
          confirmButtonText: "¡Aceptar!",
        }).then(() => {
          window.location.reload();
        });
      } else {
        Swal.fire({
          title: "¡Error al actualizar el dominio!",
          icon: "error",
          confirmButtonText: "¡Aceptar!",
        });
      }
    });
  });
};
document.querySelector("#dominioForm").addEventListener("submit", dominio);
