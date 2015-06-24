<?php

require_once '../vendor/autoload.php';

$app = new \Slim\Slim();

$valid_passwords = array("phptesting" => "123");
$valid_users = array_keys($valid_passwords);
$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];
$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    die("Not authorized");
    exit();
}

$app->get('/', function () {

    $resposta = array(
        "status" => "successo",
        "message" => "Bem vindos a API Qualister",
        "data" => array("codigo" => "gnitsetphp")
    );

    header("Content-Type: application/json");
    header('HTTP/1.0 200 OK');

    echo json_encode($resposta);
    exit();
});

$app->get('/pedido', function () {

    $pedido = new Pedido();
    $itens = $pedido->getPedidosItens();

    $resposta = array(
        "status" => "successo",
        "message" => "a lista esta vazia",
        "data" => $itens
    );

    header("Content-Type: application/json");
    header('HTTP/1.0 200 OK');

    echo json_encode($resposta);
    exit();
});

$app->get('/pedido/:id', function ($id) use ($app) {
    
    // acesso a query string with $app
    $clienteNome = $app->request()->get("nome");

    $resposta = array(
        "status" => "successo",
        "message" => "o id que voce enviou foid " . $id . " : nome de autenticacao: " . $clienteNome,
    );

    header("Content-Type: application/json");
    header('HTTP/1.0 200 OK');

    echo json_encode($resposta);
    exit();
});

$app->post('/pedido', function() use ($app) {

    $produto = new Produto(
            $app->request()->post("produtoId"),
            $app->request()->post("produtoNome"),
            $app->request()->post("produtoEstoque"),
            $app->request()->post("produtoValor")
    );

    $pedido = new Pedido();
    $pedidoServico = new PedidoServicos();
    
    $status = $pedidoServico->salvar($pedido->addItemPedido($produto, $app->request()->post("quantidade")));
    
    header("Content-Type: application/json");
    header('HTTP/1.0 200 OK');
    
    echo json_encode(Array(
        'status' => '$status',
        'message' => ('$status' == 'success' ? "Pedido adicionado com sucesso" : "Error ao adicionar um novo pedido"),
    ));
});

$app->run();
