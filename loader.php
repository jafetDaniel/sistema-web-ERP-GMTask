<!-- Autor: Jafet Daniel Fonseca Garcia -->
<!-- Pagina que muestra la animacion de carga del sistema -->
<?php
session_start(); //iniciar session de usuario

if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: index.php"); //sino esta loggeado redirigir al home
}
?>

<style>
.loader{
    width: 100px;
    height: 100px;
    margin: 50px auto; 
    position: relative;
    position: fixed;
top: 50%;
left: 50%;
-webkit-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
} 
.loader span{
    width: 100%;
    height: 100%;
    border: 3px solid rgba(255, 255, 255,0.15);
    border-radius: 50%;
    box-shadow: 0px 5px 18px 10px #fff;
    position: absolute;
    top: 0;
    left: 0;
    animation: round 1s linear infinite;
}
.loader span:nth-child(2){
    border-radius: 44% 56% 39% 61% / 37% 35% 65% 63% ;
    box-shadow: 0px 18px 20px 2px #7ab1e8;
}
.loader span:nth-child(3){
    border-radius: 37% 63% 71% 29% / 44% 39% 61% 56% ;
    box-shadow: 0px 8px 30px 4px #01288c;
}
.loader span:nth-child(4){
    border-radius: 68% 32% 46% 54% / 29% 51% 49% 71% ;
    box-shadow: 0px 8px 45px 5px #fff;
}
.loader span:nth-child(5){
    border-radius: 62% 38% 51% 49% / 42% 42% 58% 58% ;
    box-shadow: 2px 15px 49px 12px #4c98cf;
}
.loader span:nth-child(6){
    border-radius: 67% 33% 57% 43% / 45% 61% 39% 55% ;
    box-shadow: 2px 10px 59px 22px #7ab3e8;
}
.loader span:nth-child(7){
    border-radius: 67% 33% 66% 34% / 36% 70% 30% 64% ;
    box-shadow: 2px 6px 69px 2px #145df0;
}
@keyframes round{
    0%{ transform: rotate(0deg); }
    100%{ transform: rotate(360deg); }
} 

body{
    background-color: black;
}
</style>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<body>
    <div class="loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</body>

<script>
        function redireccionar(){ //funcion donde se realiza accion de redireccionar a otra pagina
      window.location.href = "home.php";
    }
    setTimeout("redireccionar()", 1500); //tiempo de espera antes de redireccionar a la pagina de home
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->