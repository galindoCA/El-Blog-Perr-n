<div class="form-group">
    <lavel>Nombre de usuario</lavel>
    <input type="text" class="form-control" name="nombre" placeholder="Entre 6 y 24 caracteres" <?php $entrada_recuperada -> mostrar_nombre(); ?>>
    <?php 
    $entrada_recuperada -> mostrar_error_nombre();
    ?>
</div>
<div class="form-group">
    <lavel>email</lavel>
    <input type="email" class="form-control" name="email" placeholder="usuario@servicio.com" <?php $entrada_recuperada -> mostrar_email(); ?>>
    <?php 
    $entrada_recuperada -> mostrar_error_email();
    ?>
</div>
<div class="form-group">
    <lavel>Contraseña</lavel>
    <input type="password" class="form-control" name="clave1">
    <?php 
    $entrada_recuperada -> mostrar_error_pass1();
    ?>
</div>
<div class="form-group">
    <lavel>Confirma tu contraseña</lavel>
    <input type="password" class="form-control" name="clave2">
    <?php 
    $entrada_recuperada -> mostrar_error_pass2();
    ?>
</div>
<br>
<button type="submit" class="btn bg-primary" name="enviar">Enviar datos</button>
<button type="submit" class="btn btn-default">Limpiar formulario</button>
