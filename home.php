<?php
session_start(); //iniciar session de usuario

if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: index.php"); //sino esta loggeado redirigir al home
}
$nombre = $_SESSION['nombre']; //obtener el nombre de la sesion del usuario
$apellidos = $_SESSION['apellidos']; //obtener apellidos de la sesion usuario
$correo = $_SESSION['correo'];  //obtener el correo de la sesion del usuario
$id = $_SESSION['id'];
$tipo_usuario = $_SESSION['tipo_usuario'];

require "bd/conexion.php"; //llamar a la conexion

$sql_colaboradores = "SELECT * FROM colaboradores_tareas WHERE id_usuario='$id' ORDER BY id_tarea DESC LIMIT 4"; //generar consulta colaboradores
$resultado_colaboradores = $mysqli->query($sql_colaboradores); //guardar consulta

$sql_proy = "SELECT * FROM proyectos WHERE id_usuario='$id' OR privacidad ='PUBLICO' ORDER BY id_proyecto DESC LIMIT 4"; //generar consulta proyectos
$resultado_proy = $mysqli->query($sql_proy); //guardar consulta

//para mostrar imagen de perfil
$sql_imagen = "SELECT nombre FROM imagenes_perfil WHERE id_usuario='$id'"; //generar consulta imagen perfil
$resultado_imagen = $mysqli->query($sql_imagen); //guardar consulta
$row_imagen = mysqli_fetch_array($resultado_imagen); //ejecutar consulta (fetch devuelve un solo registro)

//para obtener el numero de notificaciones
$sql_notificaciones = "SELECT id_notificacion FROM notificaciones 
                       WHERE id_usuario_receptor='$id' AND leido='0'"; //generar consulta notificaciones
$resultado_notificaciones = $mysqli->query($sql_notificaciones); //guardar consulta
$num_notificaciones = $resultado_notificaciones->num_rows; //si la consulta genero resultados

date_default_timezone_set('America/Mexico_City');  //establecer zona horaria y de fecha
$fecha_sistema = date('l, d F', time()); //establecer formato que tendra la fecha

$sql_usuarios = "SELECT usuarios.nombre, usuarios.apellidos, 
                        imagenes_perfil.nombre AS 'nombre_foto' 
                 FROM usuarios
                 JOIN imagenes_perfil
                 USING (id_usuario)
                 ORDER BY usuarios.nombre ASC"; //generar consulta para obtener datos del usuario
$resultado_usuarios = $mysqli->query($sql_usuarios); //guardar consulta proyectos
?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="sistema para el control y gestion de tareas" />
    <meta name="author" content="jafet daniel fonseca garcia" />
    <title>Home Task</title>
    <link href="css/mis_estilos.css" rel="stylesheet" />
    <link href="librerias/jsdelivr_simple_datatables_dist_style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="librerias/fontawesome.js"></script>
    <link href="css/carrusel_personas.css" rel="stylesheet" />
</head>
<style>
    @-webkit-keyframes aitf {
        0% {
            background-position: 0% 50%;
        }

        100% {
            background-position: 100% 50%;
        }
    }

    #mant {
        text-transform: uppercase;
        border: 4px double rgba(255, 255, 255, .25);
        text-align: center;
        font-size: 130%;
    }

    #mantenimiento {
        font: 900 4em/1 'Oswald', Tangerine;
        padding: .25em 0 .325em;
        text-shadow: 0 0 80px rgba(255, 255, 255, .5);

        /* Clip Background Image */
        background: url("images/diagonal.jpg") repeat-y;
        -webkit-background-clip: text;
        background-clip: text;

        /* Animate Background Image */
        -webkit-text-fill-color: transparent;
        -webkit-animation: aitf 10s linear infinite;

        /* Activate hardware acceleration for smoother animations */
        -webkit-transform: translate3d(0, 0, 0);
        -webkit-backface-visibility: hidden;
    }

    #image_perfil {
        width: 25px;
        height: 25px;
        border-radius: 12.5px;
    }

    .badge {
        /* contador de notificaciones*/
        position: relative;
        top: -15px;
        left: -3px;
        border: 1px solid white;
        background-color: orangered;
        border-radius: 50%;
    }

    #nombres {
        text-align: center;
    }

    #div_img {
        text-align: center;
        background: radial-gradient(white, #3acfd5, #2c6dc3, #0c5980);
        border-radius: 10px;
    }

    #imagen_footer {
        margin-top: 20px;
        margin-bottom: 20px;
        opacity: 0.6;
        border-radius: 50%;
        height: 60%;
        width: 40%;
    }
</style>
<!-- Autor: Jafet Daniel Fonseca Garcia -->

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a href="home.php" style="margin-left: 1%"><img id="img_negro" src="images/logo_negro.jpg" width="30px" height="30px"></a>
        <a class="navbar-brand ps-3" href="home.php">Task</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </div>

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-add fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="tareas/create_tarea.php">Tarea</a></li>
                    <li><a class="dropdown-item" href="proyectos/create_proyecto.php">Proyecto</a></li>
                </ul>
            </li>
        </ul>

        <!-- Navbar config del usuario-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $nombre; ?>
                    <img id="image_perfil" src="<?php echo $row_imagen['nombre'] ?>">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="usuarios/usuarios.php">Configuración</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Salir</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- primera seccion del menu lateral-->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-home-alt"></i></div>
                            Inicio
                        </a>
                        <a class="nav-link" href="tareas/bandeja.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-bell"></i></div>
                            Bandeja de entrada
                            <?php
                            if ($num_notificaciones > 0) {
                            ?>
                                <span class="badge badge-light"><?php echo $num_notificaciones ?></span>
                            <?php
                            }
                            ?>
                        </a>

                        <a class="nav-link" href="proyectos/proyectos.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-project-diagram"></i></div>
                            Proyectos
                        </a>

                        <a class="nav-link" href="tareas/tareas.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-check"></i></div>
                            Mis tareas
                        </a>
                        <?php
                        if($tipo_usuario == 2){
                        ?>
                        <a class="nav-link" href="tareas/agenda.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                            Agenda de Tareas
                        </a>
                        <?php
                        }
                        ?>
                        <a class="nav-link" href="estadisticas/estadisticas_tareas.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Estadísticas
                        </a>

                        <hr size="3px" color="white" style="margin-bottom: 0px;">

                        <!-- seccion "reportes" del menu lateral-->
                        <div class="sb-sidenav-menu-heading">Reporte de Servicios</div>
                        <a class="nav-link" href="reportes/reportes.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Reparaciones y Servicios
                        </a>

                        <a class="nav-link" href="reportes/tipo_reporte.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-add"></i></div>
                            Agregar nuevo
                        </a>

                        <a class="nav-link" href="reportes/status_reporte.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Status de servicios
                        </a>

                        <hr size="3px" color="white" style="margin-bottom: 0px;">

                        <!-- seccion "proyectos del menu lateral-->
                        <div class="sb-sidenav-menu-heading">Proyectos y Tareas</div>

                        <a class="nav-link" href="proyectos/create_proyecto.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-add"></i></div>
                            Nuevo Proyecto
                        </a>

                        <a class="nav-link" href="tareas/create_tarea.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-add"></i></div>
                            Nueva Tarea
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $correo ?>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <p id="mant">
                        <span id="mantenimiento">Mantenimiento</span>
                    </p>
                    <div>
                        <h1 class="mt-4" style="display: inline;">Task</h1>

                        <div style="display: inline; margin-left: 69%;">
                            <form action="tareas/busqueda_general.php" method="POST" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Buscar una tarea" name="busqueda"/>
                                    <input type="submit" class="btn btn-primary" value="Buscar"/>
                                </div>
                            </form>
                        </div>

                        <ol class="breadcrumb mb-4" style="display: inline;">
                            <li class="breadcrumb-item active">general motors</li>
                        </ol>
                    </div>

                    <h5 id="fecha"><?php echo $fecha_sistema ?></h5>
                    <h1 id="saludo" class="mt-4" style="font-family: 'Tangerine', serif; text-shadow: 4px 4px 4px #aaa;">Welcome <?php echo $nombre . ' ' . $apellidos; ?></h1>
                    <br>

                    <div class="row">
                        <div class="col-xl-6">
                            <!-- tabla de tareas recientes -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Tareas Recientes
                                </div>
                                <div class="card-body">
                                    <table class="table table-primary table-striped">
                                        <tbody>

                                            <?php
                                            while ($row_colaboradores = mysqli_fetch_array($resultado_colaboradores)) {

                                                $id_t_colaborador = $row_colaboradores['id_tarea']; //guardar id en variable

                                                $sql_t_colaborador = "SELECT * FROM tareas WHERE id_tarea='$id_t_colaborador'"; //consulta para obtener los datos de la tarea
                                                $resultado_t_colaborador = $mysqli->query($sql_t_colaborador); //guardar consulta
                                                $row_t_colaborador = mysqli_fetch_array($resultado_t_colaborador); //ejecutar consulta (fetch devuelve un solo registro)
                                                $num_t_colaborador = $resultado_t_colaborador->num_rows; //si la consulta genero resultados  

                                                if ($num_t_colaborador > 0) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <a href="tareas/detalles_tarea.php?id_tarea=<?php echo $row_t_colaborador['id_tarea'] ?>"><i class="fa-solid fa-eye" style="width: 23px; height: 23px;"></i></a>
                                                            <?php echo $row_t_colaborador['nombre'] ?>
                                                        </td>
                                                        <td><?php echo $row_t_colaborador['fecha_entrega'] ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <!-- tabla de proyectos recientes -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Proyectos recientes
                                </div>
                                <div class="card-body">
                                    <table class="table table-primary table-striped">
                                        <tbody>
                                            <?php
                                            while ($row_proy = mysqli_fetch_array($resultado_proy)) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <a href="proyectos/detalles_proyecto.php?id_proyecto=<?php echo $row_proy['id_proyecto'] ?>"><i class="fa-solid fa-eye" style="width: 23px; height: 23px;"></i></a>
                                                        <?php echo $row_proy['nombre'] ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <h4 style="text-align: center;">Personas</h4>
            <section class="product">
                <!-- CARRUSEL de personas -->
                <div class="product-container">
                    <?php
                    while ($row_usuarios = mysqli_fetch_array($resultado_usuarios)) { //mientras devuelva resultados la consulta
                    ?>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="<?php echo $row_usuarios['nombre_foto'] ?>" class="product-thumb">
                            </div>
                            <div class="product-info">
                                <p id="nombres"><?php echo $row_usuarios['nombre'] . ' ' . $row_usuarios['apellidos'] ?></p>
                            </div>
                        </div>
                    <?php
                    } //while
                    ?>
                </div>
            </section><!-- CARRUSEL de personas-->

            <!-- imagen de pie de pagina -->
            <div id="div_img" class="container-fluid px-4">
                <img src="images/gm_marcas_.jpg" id="imagen_footer">
            </div>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022. By Jafet Daniel Fonseca Garcia</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="librerias/bootstrap.js"></script>
    <script src="js/scripts.js"></script>
    <script src="librerias/ajax_chart.js"></script>
    <script src="demo/chart-area-demo.js"></script>
    <script src="demo/chart-bar-demo.js"></script>
    <script src="librerias/jsdelivr_simple_datatables.js"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
<!-- Autor: Jafet Daniel Fonseca Garcia -->