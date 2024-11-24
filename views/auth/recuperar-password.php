<h1 class="nombre-pagina">Recuperar Contraseña</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php
    include_once __DIR__ . "/../Templates/alertas.php"
?>

<?php if($error) return; ?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password"
                id="password"
                name="password"
                placeholder="Tu nueva contraseña">
    </div>
    <input type="submit" class="boton" value="Guardar contraseña nueva">
</form>

<div class="acciones"> 
    <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes cuenta? Crea una</a>
</div>