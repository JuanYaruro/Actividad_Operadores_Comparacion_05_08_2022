<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    $mensajes = (array) [];
    $_DATA = ($_SERVER["REQUEST_METHOD"] == "POST") 
            ? json_decode(file_get_contents("php://input"), true)
            : (array) ["num1"=> 0 , "num2" => 0, "operador" => []];
    extract($_DATA);
    unset($_DATA);
    settype($num1, "int"); settype($num2, "int");

    foreach ($operador as $key => $value) {
        $mensajes[$value] = match ($value){
            "Igual" => ($num1 == $num2) ? "$num1 == $num2 True" : "$num1 == $num2 False",
            "Idéntico" => ($num1 === $num2) ? "$num1 === $num2 True" : "$num1 === $num2 False",
            "Diferente" => ($num1 != $num2) ? "$num1 != $num2 True" : "$num1 != $num2 False",
            "No Idéntic" => ($num1 !== $num2) ? "$num1 !== $num2 True" : "$num1 !== $num2 False",
            "Menor Que" => ($num1 < $num2) ? "$num1 < $num2 True" : "$num1 < $num2 False",
            "Mayor Que" => ($num1 > $num2) ? "$num1 > $num2 True" : "$num1 > $num2 False",
            "Menor Igual Que" => ($num1 <= $num2) ? "$num1 <= $num2 True" : "$num1 <= $num2 False",
            "Mayor Igual Que" => ($num1 >= $num2) ? "$num1 >= $num2 True" : "$num1 >= $num2 False"
        };
    };

    print_r(json_encode((object) [
        "Mensaje" => (string) "Actividad de operador de comparacion",
        "Servidor" => $_SERVER["HTTP_HOST"],
        "Respuesta" => $mensajes
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ));

    unset($key, $num1, $num2, $operador, $mensajes);
?>