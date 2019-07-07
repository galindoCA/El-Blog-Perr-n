<div class="form-group">
    <label for="titulo">Título</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ponle un titulo a esta entrada"
    value="<?php echo $entrada_recuperada -> obtener_titulo(); ?>">
    <?php $entrada_recuperada -> mostrar_error_titulo(); ?>
</div>
<div class="form-group">
    <label for="url">URL</label>
    <input type="text" class="form-control" id="url" name="url" placeholder="Direccion unica sin espacios"
    value="<?php echo $entrada_recuperada -> obtener_url(); ?>">
    <?php $entrada_recuperada -> mostrar_error_url(); ?>
</div>
<div class="form-group">
    <label for="contenido">Contenido</label>
    <textarea class="form-control" rows="5" id="contenido" name="texto" placeholder="Escribe aquí tu artículo"
    ><?php echo $entrada_recuperada -> obtener_texto(); ?></textarea>
    <?php $entrada_recuperada -> mostrar_error_texto(); ?>
</div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="publicar" value="si" <?php if($entrada_publica) echo 'checked'; ?>
               >Marca este recuadro si quieres que la entrada se publique de inmediato
    </label> 
</div>
<br>
<button type="submit" class="btn btn-primary" name="guardar">Guardar entrada</button>
