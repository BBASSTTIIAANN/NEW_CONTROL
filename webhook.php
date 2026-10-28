<?php

$token_verificacion = "newcontrol2026";

/* =====================================
   VERIFICACIÓN DE META
===================================== */

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $modo = $_GET['hub_mode'] ?? '';
    $token = $_GET['hub_verify_token'] ?? '';
    $desafio = $_GET['hub_challenge'] ?? '';

    if ($modo === 'subscribe' && $token === $token_verificacion) {
        echo $desafio;
        exit;
    }

    http_response_code(403);
    echo "Token incorrecto";
    exit;
}


/* =====================================
   RECIBIR MENSAJE
===================================== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recibir JSON enviado por WhatsApp
    $entrada = file_get_contents("php://input");


    // Guardar JSON completo
    file_put_contents(
        __DIR__ . "/mensajes_recibidos.txt",
        date("Y-m-d H:i:s") . "\n" .
        $entrada .
        "\n\n==============================\n",
        FILE_APPEND
    );


    /* =====================================
       CONVERTIR JSON
    ===================================== */

    $datos = json_decode($entrada, true);


    if ($datos) {

        $valor = $datos['entry'][0]['changes'][0]['value'] ?? [];

        $contacto = $valor['contacts'][0] ?? [];

        $mensaje = $valor['messages'][0] ?? [];


        $nombre = $contacto['profile']['name'] ?? 'Desconocido';

        $telefono = $mensaje['from'] ?? 'Desconocido';

        $tipo = $mensaje['type'] ?? 'Desconocido';

        $texto = $mensaje['text']['body'] ?? '';


        /* =====================================
           GUARDAR MENSAJE EXTRAÍDO
        ===================================== */

        $contenido = "";

        $contenido .= "==============================\n";

        $contenido .= date("Y-m-d H:i:s") . "\n";

        $contenido .= "NOMBRE: " . $nombre . "\n";

        $contenido .= "TELEFONO: " . $telefono . "\n";

        $contenido .= "TIPO: " . $tipo . "\n";

        $contenido .= "MENSAJE: " . $texto . "\n";

        $contenido .= "==============================\n\n";


        file_put_contents(
            __DIR__ . "/mensajes_extraidos.txt",
            $contenido,
            FILE_APPEND
        );
    }


    // Responder a Meta
    http_response_code(200);

    echo "EVENT_RECEIVED";

    exit;
}

?>