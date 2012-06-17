<?php

include ("../funciones/Funciones.php");

getMasInformacion($_GET['id'], &$nombre, &$nickfacebook, &$imagen, &$categoria, &$direccion, &$telefono, &$paginaweb);

?>
<p>
<?php if($imagen){ ?>
    <a style="display:block;" href="http://www.facebook.com/<?php echo $nickfacebook; ?>" target="_blank" >
        <span style="display:block;background:center url(<?php echo $imagen; ?>) no-repeat; width:100px; height:100px; margin:auto"></span>
    </a>
<?php } ?>
</p>

<p><strong>Nombre:</strong> <?php echo $nombre; ?>
</p>
<p><strong>Categoria:</strong> <?php echo str_replace('-',' ',$categoria); ?>
</p>
<p><strong>Direccion:</strong> <?php echo $direccion; ?>
</p>
<p><strong>Telefono: </strong><?php echo $telefono; ?>
</p>
<p><strong>Sitio web:</strong> <a target="_blank" href="<?php echo $paginaweb; ?>"><b>click para entrar</b></a>
</p>
