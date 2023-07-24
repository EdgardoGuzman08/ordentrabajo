<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link rel="stylesheet" href="public/css/estilos.css">
    <title>Orden de Trabajo</title>
</head>
<body>
    <div class="container">
        <table class="container-segundo2">
            <tr>
                <td>
                    <img src="public/img/logo-01.png" alt="" class="logo">
                </td>
                <td>
                    <h2 class="principaltitulo">Orden de Trabajo</h2>
                    <br>
                    <h6>Departamento de IT</h6>
                </td>
                <td class="contenido">
                    <span>Codigo: DD-DD-D-DDD-DD</span>
                    <hr>
                    <span>Version: 01</span>
                    <hr>
                    <span>Fecha: 04/07/2023</span>
                </td>
            </tr>
        </table>
        
        <br><br><br>
        <form class="formulario" method="post" action="controladores/orden" id="myForm">
            <div class="container-tercer3">
                <table class="tabla1">
                    <tr>
                        <th colspan="3">Datos de Orden de Trabajo</th>
                        <td class="segundoentitulo">Orden No. <br> <span style="text-align: center; font-size: 16px; font-weight: bold;"> <?php echo $orden_no; ?></span></td>
                    </tr>
                    <tr>
                            <td class="label">Nombre PC</td>
                            <td class="search_select_box">
                                <select class="selectpicker w-100" data-live-search="true" name="nombre_pc" required>
                                    <option value="" selectec>Selecciona nombre pc</option>
                                    <option value="pc1">Pc1</option>
                                    <option value="pc2">Pc2</option>
                                    <option value="pc3">Pc3</option>
                                </select>
                            </td>
                            <td class="label">Fecha Inicio</td>
                            <td><input type="text" id="fecha-inicio" name="fecha_inicio" class="datepicker" required></td>
                    </tr>
                    <tr>
                        <td class="label">Departamento</td>
                        <td class="search_select_box">
                            <select class="selectpicker w-100" data-live-search="true" name="departamento" required>
                                <option value="" selected>Selecciona un depto.</option>
                                <option value="inyeccion">Mantenimiento</option>
                                <option value="corona">Logistica</option>
                                <option value="produccion">Produccion</option>
                            </select>
                        </td>
                        <td class="label">Hora Inicio</td>
                        <td>
                            <input required type="text" class="hora-inicio" name="hora_inicio" onchange="calcularDiferencia()">
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Area</td>
                        <td class="search_select_box">
                            <select class="selectpicker w-100" data-live-search="true" name="area" required>
                                <option value="" selected>Selecciona un area</option>
                                <option value="inyeccion">Inyección</option>
                                <option value="corona">Corona</option>
                                <option value="produccion">Inyeccion 2</option>
                            </select>
                        </td>
                        <td class="label">Fecha Final</td>
                            <td><input required type="text" id="fecha-final" name="fecha_final" class="datepicker"></td>
                    </tr>
                    <tr>
                        <td class="label">Operador</td>
                        <td><input type="text" name="operador" class="operador" required></td>
                        <td class="label">Hora Final</td>
                        <td><input required type="text" class="hora-final" name="hora_final" onchange="calcularDiferencia()"></td>
                    </tr>
        
                    <tr>
                        <td class="label">Prioridad</td>
                        <td colspan="3">
                            <select required class="selectpicker w-100" name="prioridad">
                                <option value="" selected>Selecciona una opción</option>
                                <option value="baja">Baja</option>
                                <option value="media">Media</option>
                                <option value="alta">Alta</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                <br>
        
                <table class="tabla2">
                    <tr>
                        <th colspan="5">Para uso del Operador</th>
                    </tr>
                    <tr>
                        <td><input type="checkbox" id="mantenimiento1" name="mantenimiento[]" value="Manto Preventivo" onclick="mostrarSeleccion()">Manto Preventivo</td>
                        <td><input type="checkbox" id="mantenimiento2" name="mantenimiento[]" value="Manto Predictivo" onclick="mostrarSeleccion()">Manto Predictivo</td>
                        <td><input type="checkbox" id="mantenimiento3" name="mantenimiento[]" value="Manto Correctivo" onclick="mostrarSeleccion()">Manto Correctivo</td>
                        <td><input type="checkbox" id="mantenimiento4" name="mantenimiento[]" value="Manto Proactivo" onclick="mostrarSeleccion()">Manto Proactivo</td>
                        <td><input type="checkbox" id="mantenimiento5" name="mantenimiento[]" value="De baja" onclick="mostrarSeleccion()">De baja</td>
                    </tr>

                    <tr>
                        <td class="label">Observacion</td>
                        <td colspan="6">
                            <textarea id="resultado" rows="8" cols="50"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td> <label for="">Total horas</label> <input type="text" readonly name="total_horas" class="total-horas" id="total-horas-input" </td>
                        <td class="total-horas" id="total-horas">Total Hrs:</td>
                    </tr>
                    
                </table>
        
                <br>
                <br>
                <table class="tabla4">
                    <tr>
                        <th colspan="4">Datos del Operador</th>
                    </tr>
                    <tr>
                        <td class="label">Nombre:</td>
                        <td><input type="text" name="nombre"></td>
                        <td class="label">Firma:</td>
                        <td><input type="text" name="firma"></td>
                    </tr>
                </table>
            </div>
            <br>
            <br>
            <input class="submit-button" type="submit" value="Enviar">
        </form>
    </div>
    
    <a class="submit-button" href="index.php?exportar=1">Enviar a vista Exportar</a>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>


<script src="public/js/knowledge.js"></script>
<script src="public/js/script.js"></script>
</html>
