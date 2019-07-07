<?php

include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentario.inc.php';

Conexion :: abrir_conexion();

for($usuarios = 0; $usuarios < 100; $usuarios++){
    $nombre = sa(10);
    $email = sa(5).'@'.sa(3);
    $password = password_hash('123456', PASSWORD_DEFAULT);
    
    $usuario = new Usuario('', $nombre, $email, $password, '', '');
    RepositorioUsuario::insertar_usuario(Conexion::obtener_conexion(), $usuario);
}

for($entradas=0; $entradas < 100; $entradas++){
    $titulo = sa(10);
    $url = $titulo;
    $texto = lorem();
    $autor = rand(1, 100);
    
    $entrada = new Entrada('', $autor, $url, $titulo, $texto, '', '');
    RepositorioEntrada::insertar_entrada(Conexion::obtener_conexion(), $entrada);
}

for($comentarios=0; $comentarios < 100; $comentarios++){
    $titulo = sa(10);
    $texto = lorem();
    $autor = rand(1, 100);
    $entrada= rand(1, 100);
    
    $comentario = new Comentario('', $autor, $entrada, $titulo, $texto, '');
    RepositorioComentario::insertar_comentario(Conexion::obtener_conexion(), $comentario);
}

function sa($longitud){
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';
    
    for($i =0; $i < $longitud; $i++){
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres-1)]; //metodo ran crea un numero aleatorio con parametro menor y mayor
        
    }
    
    return $string_aleatorio;
}

function lorem(){
    $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pretium metus at nisl cursus porta. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur commodo quam eu tellus porta posuere. Nullam eu placerat ex, id consectetur nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus tempor mauris ut eros molestie posuere. Nulla nec fringilla nunc. In viverra euismod nibh, sed dapibus lectus ultricies sed. Donec aliquam dignissim purus sit amet gravida. Sed elementum sollicitudin ornare. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer nisi eros, tempor sit amet neque eu, rhoncus egestas quam. Nunc vestibulum cursus magna quis sagittis. Curabitur mollis fringilla lorem vel efficitur. Vestibulum id eros ac odio suscipit fermentum. Integer euismod in leo et aliquam.

In hac habitasse platea dictumst. Mauris odio sapien, fermentum sed malesuada vitae, porta et tortor. Cras scelerisque pellentesque finibus. Nunc nulla tortor, dignissim sed lorem eu, venenatis rutrum diam. Duis molestie gravida ante, id finibus leo ultrices quis. Cras a tortor luctus, gravida nisl rhoncus, varius urna. Cras erat sapien, mollis nec nunc id, laoreet sagittis augue. Pellentesque vulputate sem a magna elementum efficitur. Sed iaculis pharetra semper. Curabitur turpis libero, blandit nec cursus eget, dapibus sed urna.

Ut commodo venenatis justo vel accumsan. Aenean mi nisl, gravida imperdiet rhoncus sit amet, dictum id nulla. Donec vel sapien ut enim pulvinar interdum. Aliquam imperdiet accumsan ex. Vivamus eu nisi imperdiet, suscipit leo eu, gravida sem. Praesent euismod arcu non faucibus elementum. Donec sed tortor pellentesque, faucibus metus non, scelerisque purus. Pellentesque non risus tempor mi aliquam accumsan. Vestibulum et libero felis. Aliquam varius finibus odio. Sed ut neque id lacus eleifend convallis et at leo.

Nunc et est ac felis lobortis venenatis vitae ac lorem. Nam tincidunt, sem vitae eleifend dictum, leo turpis posuere sem, at ullamcorper nisl metus et nisl. Integer ut lacus lectus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam ut nisl libero. Duis sem ante, suscipit eget lacinia nec, consectetur ut libero. Aenean pharetra tellus nunc, quis fringilla nibh scelerisque eu. Sed et ipsum blandit, pulvinar tellus at, ultricies magna. Donec vitae tempus metus. Aliquam ac blandit ante. Proin sed purus vehicula, luctus urna at, pharetra odio. Vivamus luctus, quam ut commodo cursus, nisi tellus molestie mi, at porta orci urna molestie ligula. Phasellus sit amet metus eget turpis congue eleifend ac ac metus. Pellentesque vitae pellentesque sem.

Integer eu consequat erat, in consectetur erat. Aliquam mattis massa nec orci tempor scelerisque vel sed turpis. Fusce turpis turpis, tincidunt vel posuere eu, accumsan et ipsum. Aenean eleifend magna tortor, id suscipit turpis commodo at. Quisque quis molestie mauris. Integer nec nisi eu turpis mollis sollicitudin gravida ac tellus. Nulla scelerisque imperdiet elit, et volutpat justo. Aliquam rutrum, tellus vitae auctor mollis, velit lacus rhoncus tellus, quis blandit odio nibh a urna. Nam eget dictum nunc, id eleifend neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus cursus gravida lectus. Vestibulum vel commodo ante. Quisque iaculis sollicitudin libero, ut elementum ligula laoreet lobortis. Ut id aliquet ligula.';

    return $lorem;
}







































