<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php
    include_once __DIR__ . "/../Templates/alertas.php"
?>

<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Ingresa tu correo"
            name="email"
        >
    </div>
    <div class="campo">
        <label for="Password">Contraseña</label>
        <input 
            type="password"
            id="password"
            placeholder="Ingresa tu Contraseña"
            name="password"
        >
    </div>
    <input type="submit" class="boton" value="Iniciar Sesión" >
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>