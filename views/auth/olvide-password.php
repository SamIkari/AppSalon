<h1 class="nombre-pagina">Olvide mi contraseña</h1>
<p class="descripcion-pagina">Reestablece tu contraseña escribiendo tu correo electronico</p>

<?php
    include_once __DIR__ . "/../Templates/alertas.php"
?>

<form action="/olvide" method="POST" class="formulario">

<div class="campo">
    <label for="email">Correo electronico</label>
    <input type="email"
            id="emial"
            name="email"
            placeholder="Ingresa tu correo electronico">
</div>
    <input type="submit" value="Enviar correo" class="boton">
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicie Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
</div>