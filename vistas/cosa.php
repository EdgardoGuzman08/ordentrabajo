<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/estilos.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="controlador/orden">
            <table class="container-segundo">
                <tr>
                    <td>
                        <img src="public/img/logo-01.png" alt="" class="logo">
                    </td>
                    <td>
                        <h2 class="principaltitulo">Orden de Trabajo</h2>
                        <h4>Departamento de IT</h4>
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
            <table class="tabla1">
                <tr>
                    <th colspan="3">Datos de Orden de Trabajo</th>
                    <td class="segundoentitulo">Orden No. <input type="text"> </td>
                </tr>
                <tr>
                    <td class="label">Nombre PC</td>
                    <td>
                        <select class="nombrepc">
                            <option value="">Selecciona una opción</option>
                            <option value="pc1">Pc1</option>
                            <option value="pc2">Pc2</option>
                            <option value="pc3">Pc3</option>
                        </select>
                    </td>
                    <td class="label">Código de Equipo</td>
                    <td><input type="text"></td>
                </tr>
                <tr>
                    <td class="label">Departamento</td>
                    <td>
                        <select class="departamentos">
                            <option value="">Selecciona una opción</option>
                            <option value="inyeccion">Mantenimiento</option>
                            <option value="corona">Logistica</option>
                            <option value="produccion">Produccion</option>
                        </select>
                    </td>
                    
                    <td class="label">Fecha</td>
                    <td><input type="date"></td>
                </tr>
                <tr>
                    <td class="label">Area</td>
                    <td>
                        <select class="areas">
                            <option value="">Selecciona una opción</option>
                            <option value="inyeccion">Inyección</option>
                            <option value="corona">Corona</option>
                            <option value="produccion">Inyeccion 2</option>
                        </select>
                    </td>
                    <td class="label">Hora Inicio</td>
                    <td><input type="time" class="hora-inicio" onchange="calcularDiferencia()"></td>
                </tr>
                <tr>
                    <td class="label">Usuario</td>
                    <td><input type="text"></td>
                    <td class="label">Hora Final</td>
                    <td><input type="time" class="hora-final" onchange="calcularDiferencia()"></td>
                </tr>
                <tr>
                    <td class="label">Prioridad</td>
                    <td>
                        <select class="prioridad">
                            <option value="">Selecciona una opción</option>
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
                    <td><input type="checkbox" name="" id="">Manto Preventivo</td>
                    <td><input type="checkbox" name="" id="">Manto Predictivo</td>
                    <td><input type="checkbox" name="" id="">Manto Correctivo</td>
                    <td><input type="checkbox" name="" id="">Manto Proactivo</td>
                    <td><input type="checkbox" name="" id="">De baja</td>
                </tr>
                <tr>
                    <td class="label">Detalle de Trabajo Realizado:</td>
                    <td colspan="6">
                        <textarea rows="8" cols="50"></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="total-horas" id="total-horas">Total de Horas:</td>
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
                    <td><input type="text"></td>
                    <td class="label">Firma:</td>
                    <td><input type="text"></td>
                </tr>
            </table>
            <br><br>
            <button type="submit">GUARDAR</button>
        </form>
    </div>
</body>
<script src="public/js/script.js"></script>

</html>
