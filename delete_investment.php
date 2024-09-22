<?php
header('Content-Type: application/json');

$input = file_get_contents("php://input");
$request = json_decode($input, true);

if (isset($request['index'])) {
    $file = 'data/investments.json';

    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);

        if (isset($data[$request['index']])) {
            //delete investment by index
            array_splice($data, $request['index'], 1); 

            file_put_contents($file, json_encode($data));

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Wrong index']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'File does not exist']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Index not accepted']);
}

// akoze neviem ako sa to robi v korporatoch
// ale bud mas to rozdelene v 4. file ako to mas ty (aj ja to tak robim)
// alebo mas jeden kusok avcsi napriklad handleInvestmenst.php a tam s nimi robis vsetko DELETE POST PUT.... chapes, odchytits si aku http metodu restt si poslal 
// inak v kazdom file na backende by som este handloval http_response_code to je ta http.cat stranka aspon tie basic, to si vies potom skontrtolovat cez postmana  