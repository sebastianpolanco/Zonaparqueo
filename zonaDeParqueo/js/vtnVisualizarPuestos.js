function reservarPuesto(zona, puesto, idUsuario){ 
  var tipoDeAccion = 3;
  Swal.fire({
        title: 'Confirmación',
        icon: 'question',
        backdrop: true,
        text: '¿Seguro que desea reservar esté puesto?',
        showConfirmButton:  true,
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#24B379",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#C92B43",
        closeOnConfirm: true,
        timer: 20000
  }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/zonaDeParqueo/eventos/actualizarEstado.php',
          type: 'POST',
          data: 'zona='+zona+'&puesto='+puesto+'&estado='+'3'+'&idUsuario='+idUsuario+'&tipoDeAccion='+tipoDeAccion,
          success:function(response){
            Swal.fire('Puesto reservado', 'Tiene 5 min para ocupar el puesto, de lo contario la reservación se cancelará', 'info').then(function(){
              location.href="/zonaDeParqueo/vtn/vtnInfoPuestoReservado.php";
            });
          }
        })
      }
  })
};

function terminarPuesto(zona, puesto, idUsuario){ 
  var tipoDeAccion = 1;
  Swal.fire({
        title: 'Terminación de servicio',
        icon: 'question',
        backdrop: true,
        text: '¿Seguro que desea terminar el servicio?',
        showConfirmButton:  true,
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#24B379",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#C92B43",
        closeOnConfirm: true,
        timer: 20000
  }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/zonaDeParqueo/eventos/actualizarEstado.php',
          type: 'POST',
          data: 'zona='+zona+'&puesto='+puesto+'&estado='+'2'+'&idUsuario='+idUsuario+'&tipoDeAccion='+tipoDeAccion,
          success:function(response){
            Swal.fire('Servicio terminado', 'Tiene 15 min para desoocupar el puesto, de lo contario se hará de nuevo el cobro', 'info').then(function(){
              $.ajax({
                url: '/zonaDeParqueo/eventos/registrarTarifa.php',
                type: 'POST',
                data: 'zona='+zona+'&puesto='+puesto+'&idUsuario='+idUsuario,
                success:function(response){
                    location.href="/zonaDeParqueo/vtn/vtnInfoPuestoOcupado.php";
                }
              })
            });
          }
        })
      }
  })
};

function cancelarPuesto(zona, puesto, idUsuario){ 
  var tipoDeAccion = 4;
  Swal.fire({
        title: 'Confirmación',
        icon: 'question',
        backdrop: true,
        text: '¿Seguro que desea cancelar la reservación de esté puesto?',
        showConfirmButton:  true,
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#24B379",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#C92B43",
        closeOnConfirm: true,
        timer: 20000
  }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/zonaDeParqueo/eventos/actualizarEstado.php',
          type: 'POST',
          data: 'zona='+zona+'&puesto='+puesto+'&estado='+'1'+'&idUsuario='+idUsuario+'&tipoDeAccion='+tipoDeAccion,
          success:function(response){
            Swal.fire('Cancelación exitosa', 'Seleccione uno de los puestos libres para reservar', 'success').then(function(){
              location.reload();
            });
          }
        })
      }
  })
};

function generarAlerta(zona, puesto){ 
  Swal.fire({
        title: 'Confirmación',
        icon: 'question',
        backdrop: true,
        text: '¿Seguro que desea generar alerta?',
        showConfirmButton:  true,
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#24B379",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#C92B43",
        closeOnConfirm: true,
        timer: 20000
  }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/zonaDeParqueo/eventos/actualizarEstadoAlerta.php',
          type: 'POST',
          data: 'zona='+zona+'&puesto='+puesto+'&estado='+'2'+'&idUsuario='+'0'+'&tipoDeAccion='+'2'+'&alerta='+'1',
          success:function(response){
            Swal.fire('Alerta generada', 'Se ha generado una alerta de ocupación indebida', 'info').then(function(){
              location.href="/zonaDeParqueo/vtn/vtnAdminInicio.php";
            });
          }
        })
      }
  })
};

function cancelarAlerta(zona, puesto){ 
  Swal.fire({
        title: 'Confirmación',
        icon: 'question',
        backdrop: true,
        text: '¿Seguro que desea cancelar alerta?',
        showConfirmButton:  true,
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#24B379",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#C92B43",
        closeOnConfirm: true,
        timer: 20000
  }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/zonaDeParqueo/eventos/actualizarEstadoAlerta.php',
          type: 'POST',
          data: 'zona='+zona+'&puesto='+puesto+'&estado='+'1'+'&idUsuario='+'0'+'&tipoDeAccion='+'1'+'&alerta='+'0',
          success:function(response){
            Swal.fire('Alerta generada', 'Se ha cancelado la alerta', 'info').then(function(){
              location.href="/zonaDeParqueo/vtn/vtnAdminInicio.php";
            });
          }
        })
      }
  })
};