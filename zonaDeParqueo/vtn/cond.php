<?php  
	if($zonaC!=0){
		$sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' order by idRegistro DESC LIMIT 10";
		if($puestoC!=0) {
			$sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC' order by idRegistro DESC LIMIT 10";
			if($tipoDeAccionC!=0){
				$sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC'and registros.idTipoDeAccion='$tipoDeAccionC' order by idRegistro DESC LIMIT 10";
				if(strlen($fechaIni)>0 and strlen($fechaFin)>0){
					$sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC'and registros.idTipoDeAccion='$tipoDeAccionC' and fecha BETWEEN '$fechaIni' AND '$fechaFin'  order by idRegistro DESC LIMIT 10";
					if(strlen($horaIni)>0 and strlen($horaFin)>0){
						$sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC'and registros.idTipoDeAccion='$tipoDeAccionC' and fecha BETWEEN '$fechaIni' AND '$fechaFin'  order by idRegistro DESC LIMIT 10";
					}else{
						$sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC'and registros.idTipoDeAccion='$tipoDeAccionC' and fecha BETWEEN '$fechaIni' AND '$fechaFin'  order by idRegistro DESC LIMIT 10";
					}
				}else{
					if(strlen($horaIni)>0 and strlen($horaFin)>0){
						$sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC'and registros.idTipoDeAccion='$tipoDeAccionC' and fecha BETWEEN '$fechaIni' AND '$fechaFin'  order by idRegistro DESC LIMIT 10";
					}else{
						$sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC'and registros.idTipoDeAccion='$tipoDeAccionC' and fecha BETWEEN '$fechaIni' AND '$fechaFin'  order by idRegistro DESC LIMIT 10";
					}
				}	
			}else{
				
			}
			
		}else{
			
		}	
	}else{

	}
/*
          if((strlen($fechaIni)>0 and empty($fechaFin)) or (strlen($fechaFin)>0 and empty($fechaIni))){
            echo "<script> Swal.fire('Campo Obligatorio', 'Debe llenar los campos de las fechas', 'error')</script>";
          }
          if((strlen($horaIni)>0 and empty($horaFin)) or (strlen($horaFin)>0 and empty($horaIni))){
            echo "<script> Swal.fire('Campo Obligatorio', 'Debe llenar los campos de horas', 'error')</script>";
          }

          if($zonaC==0 and $puestoC==0 and $tipoDeAccionC==0 and empty($fechaIni) and empty($fechaFin) and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion order by idRegistro DESC LIMIT 10"; 

          }elseif($zonaC!=0 and $puestoC==0 and $tipoDeAccionC==0 and empty($fechaIni) and empty($fechaFin) and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC==0 and $puestoC!=0 and $tipoDeAccionC==0 and empty($fechaIni) and empty($fechaFin) and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE puesto='$puestoC' order by idRegistro DESC LIMIT 10"; 

          }elseif($zonaC==0 and $puestoC==0 and $tipoDeAccionC!=0 and empty($fechaIni) and empty($fechaFin) and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE registros.idTipoDeAccion='$tipoDeAccionC' order by idRegistro DESC LIMIT 10"; 

          }elseif($zonaC==0 and $puestoC==0 and $tipoDeAccionC==0 and strlen($fechaIni)>0 and strlen($fechaFin)>0 and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE fecha BETWEEN '$fechaIni' AND '$fechaFin'  order by idRegistro DESC LIMIT 10";

          }elseif($zonaC==0 and $puestoC==0 and $tipoDeAccionC==0 and empty($fechaIni) and empty($fechaFin) and strlen($horaIni)>0 and strlen($horaFin)>0){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE hora BETWEEN '$horaIni' AND '$horaFin'  order by idRegistro DESC LIMIT 10";

          }elseif($zonaC!=0 and $puestoC!=0 and $tipoDeAccionC==0 and empty($fechaIni) and empty($fechaFin) and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC!=0 and $puestoC!=0 and $tipoDeAccionC!=0 and empty($fechaIni) and empty($fechaFin) and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC' and registros.idTipoDeAccion='$tipoDeAccionC' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC==0 and $puestoC!=0 and $tipoDeAccionC!=0 and empty($fechaIni)>0 and empty($fechaFin)>0 and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE registros.idTipoDeAccion='$tipoDeAccionC' and puesto='$puestoC' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC!=0 and $puestoC==0 and $tipoDeAccionC!=0 and empty($fechaIni)>0 and empty($fechaFin)>0 and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE registros.idTipoDeAccion='$tipoDeAccionC' and zona='$zonaC' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC==0 and $puestoC==0 and $tipoDeAccionC==0 and strlen($fechaIni)>0 and strlen($fechaFin)>0 and strlen($horaIni)>0 and strlen($horaFin)>0){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE hora BETWEEN '$horaIni' AND '$horaFin' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC!=0 and $puestoC!=0 and $tipoDeAccionC!=0 and strlen($fechaIni)>0 and strlen($fechaFin)>0 and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC' and registros.idTipoDeAccion='$tipoDeAccionC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC!=0 and $puestoC==0 and $tipoDeAccionC==0 and strlen($fechaIni)>0 and strlen($fechaFin)>0 and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC==0 and $puestoC!=0 and $tipoDeAccionC==0 and strlen($fechaIni)>0 and strlen($fechaFin)>0 and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE puesto='$puestoC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC==0 and $puestoC==0 and $tipoDeAccionC!=0 and strlen($fechaIni)>0 and strlen($fechaFin)>0 and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE registros.idTipoDeAccion='$tipoDeAccionC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC!=0 and $puestoC==0 and $tipoDeAccionC!=0 and strlen($fechaIni)>0 and strlen($fechaFin)>0 and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE registros.idTipoDeAccion='$tipoDeAccionC' and zona='$zonaC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC==0 and $puestoC!=0 and $tipoDeAccionC!=0 and strlen($fechaIni)>0 and strlen($fechaFin)>0 and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE registros.idTipoDeAccion='$tipoDeAccionC' and puesto='$puestoC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC!=0 and $puestoC!=0 and $tipoDeAccionC==0 and strlen($fechaIni)>0 and strlen($fechaFin)>0 and empty($horaIni) and empty($horaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC==0 and $puestoC==0 and $tipoDeAccionC!=0 and strlen($horaIni)>0 and strlen($horaFin)>0 and strlen($fechaIni)>0 and strlen($fechaFin)>0){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE hora BETWEEN '$horaIni' AND '$horaFin' and fecha BETWEEN '$fechaIni' AND '$fechaFin' and registros.idTipoDeAccion='$tipoDeAccionC' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC==0 and $puestoC!=0 and $tipoDeAccionC==0 and strlen($horaIni)>0 and strlen($horaFin)>0 and strlen($fechaIni)>0 and strlen($fechaFin)>0){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE hora BETWEEN '$horaIni' AND '$horaFin' and fecha BETWEEN '$fechaIni' AND '$fechaFin' and puesto='$puestoC' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC!=0 and $puestoC==0 and $tipoDeAccionC==0 and strlen($horaIni)>0 and strlen($horaFin)>0 and strlen($fechaIni)>0 and strlen($fechaFin)>0){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE hora BETWEEN '$horaIni' AND '$horaFin' and fecha BETWEEN '$fechaIni' AND '$fechaFin' and zona='$zonaC' order by idRegistro DESC LIMIT 10";

          }
          elseif($zonaC!=0 and $puestoC!=0 and $tipoDeAccionC!=0 and strlen($horaIni)>0 and strlen($horaFin)>0 and empty($fechaIni) and empty($fechaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC' and registros.idTipoDeAccion='$tipoDeAccionC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC!=0 and $puestoC==0 and $tipoDeAccionC==0 and strlen($horaIni)>0 and strlen($horaFin)>0 and empty($fechaIni) and empty($fechaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC==0 and $puestoC!=0 and $tipoDeAccionC==0 and strlen($horaIni)>0 and strlen($horaFin)>0 and empty($fechaIni) and empty($fechaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE puesto='$puestoC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC==0 and $puestoC==0 and $tipoDeAccionC!=0 and strlen($horaIni)>0 and strlen($horaFin)>0 and empty($fechaIni) and empty($fechaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE registros.idTipoDeAccion='$tipoDeAccionC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC!=0 and $puestoC==0 and $tipoDeAccionC!=0 and strlen($horaIni)>0 and strlen($horaFin)>0 and empty($fechaIni) and empty($fechaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE registros.idTipoDeAccion='$tipoDeAccionC' and zona='$zonaC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC==0 and $puestoC!=0 and $tipoDeAccionC!=0 and strlen($horaIni)>0 and strlen($horaFin)>0 and empty($fechaIni) and empty($fechaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE registros.idTipoDeAccion='$tipoDeAccionC' and puesto='$puestoC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }elseif($zonaC!=0 and $puestoC!=0 and $tipoDeAccionC==0 and strlen($horaIni)>0 and strlen($horaFin)>0 and empty($fechaIni) and empty($fechaFin)){
            $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion WHERE zona='$zonaC' and puesto='$puestoC' and fecha BETWEEN '$fechaIni' AND '$fechaFin' order by idRegistro DESC LIMIT 10";

          }*/

?>