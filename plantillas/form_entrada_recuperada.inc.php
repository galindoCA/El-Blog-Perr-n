<input type="hidden" id="id-entrada" name="id-entrada" value="<?php echo $id_entrada; ?>">
<div class="form-group">
    <label for="titulo">Título</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ponle un titulo a esta entrada"
           value="<?php echo $entrada_recuperada -> obtener_titulo(); ?>">
    <input type="hidden"  id="titulo-original" name="titulo-original" value="<?php echo $entrada_recuperada -> obtener_titulo(); ?>">
</div>
<div class="form-group">
    <label for="url">URL</label>
    <input type="text" class="form-control" id="url" name="url" placeholder="Direccion unica sin espacios"
           value="<?php echo $entrada_recuperada -> obtener_url(); ?>">
    <input type="hidden"  id="url-original" name="url-original" value="<?php echo $entrada_recuperada -> obtener_url(); ?>">
</div>
<div class="form-group">
    <label for="contenido">Contenido</label>
    <textarea class="form-control" rows="5" id="contenido" name="texto" placeholder="Escribe aquí tu artículo"
              ><?php echo $entrada_recuperada -> obtener_texto(); ?></textarea>
    <input type="hidden"  id="contenido-original" name="texto-original" value="<?php echo $entrada_recuperada -> obtener_texto(); ?>">
</div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="publicar" value="si" <?php if($entrada_recuperada -> obtener_activa()) echo 'checked'; ?>>Marca este recuadro si quieres que la entrada se publique de inmediato
        <input type="hidden" id="publicar-original" name="publicar-original" value="<?php echo $entrada_recuperada->obtener_activa(); ?>"
    </label> 
</div>
<br>
<button type="submit" class="btn btn-primary" name="guardar-cambios-entrada">Guardar cambios</button>
