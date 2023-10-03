<?php
if (isset($_POST['enviar'])) {
          $zonaC = $_POST['zona'];
          $tipoDeAccionC = $_POST['tipoDeAccion'];
          $horaIni = $_POST['horaIni'];
          $horaFin = $_POST['horaFin'];
          $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion";
          if($zonaC!=0 or $tipoDeAccionC!=0 or (strlen($horaIni)>0 and strlen($horaFin)>0)){
            $sql1 = $sql1.' WHERE';
            if($zonaC!=0){
              $sql1 = $sql1.' zona='.$zonaC;
              if ((strlen($horaIni)>0 and strlen($horaFin)>0)) {
                $sql1 = $sql1.' and';
              }
            }
            if($tipoDeAccionC!=0){
              $sql1 = $sql1.' registros.idTipoDeAccion='.$tipoDeAccionC;
            }
            
            if(strlen($horaIni)>0 and strlen($horaFin)>0){
              $sql1 = $sql1.' hora BETWEEN '.'"'.$horaIni.'"'.' and '.'"'.$horaFin.'"';
            }
          }else{
            if((strlen($horaIni)>0 and empty($horaFin)) or (strlen($horaFin)>0 and empty($horaIni))){
              echo "<script> Swal.fire('Campo Obligatorio', 'Debe llenar los campos de horas', 'error')</script>";
            }
          }

          ****$sql1 = $sql1.' order by idRegistro DESC LIMIT 10';
          //echo "".$sql1;
          
        }else{
          $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion order by idRegistro DESC LIMIT 10"; 
        }

        $result1 = $mysqli->query($sql1);
        $contador = 0;
        while($row1 = $result1->fetch_array(MYSQLI_NUM)){
          $idUsuario = $row1[1];
          $zona = $row1[2];
          $hora = $row1[7];
          $tipoDeAccion = $row1[9];
          
          $contador++;