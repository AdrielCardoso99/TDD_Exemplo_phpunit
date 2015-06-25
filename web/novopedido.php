<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Starter Template - Materialize</title>

        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
        <nav class="light-blue lighten-1" role="navigation">
            <div class="nav-wrapper container">
                <a id="logo-container" href="index.php" class="brand-logo">Qualister PHP Testing</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="listaritens.php" id="listaritens">Listar itens</a></li>
                    <li><a href="verpedido.php" id="verpedido">Ver pedido</a></li>
                    <li><a href="novopedido.php" id="novopedido">Novo pedido</a></li>
                    <li>
                        <a onclick="confirm('Tem certeza?');
                                alert('Faça login antes');" id="meuspedidos">Meus pedidos</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="section no-pad-bot" id="index-banner">
            <div class="container">

                <?php
                if (isset($_GET["send"]) && $_GET["send"] == "true") {
                    require '../vendor/autoload.php';
                    $client = new GuzzleHttp\Client();

                    $resposta = $client->post(
                            "http://localhost/phpunit/api/pedido", [
                        'auth' => [
                            'phptesting', '123'
                        ],
                        'form_params' => [
                            'produtoId' => @$_POST["id"],
                            'produtoNome' => @$_POST["produto"],
                            'produtoEstoque' => @$_POST["estoque"],
                            'produtoValor' => @$_POST["valor"],
                            'quantidade' => @$_POST["quantidade"]
                        ]
                            ]
                    );

                    $body = json_decode($resposta->getBody(), true);

                    echo "<script>alert('" . $body["message"] . "');</script>";
                    ?>
                    <h1 class="header center orange-text"><?php echo $body["message"]; ?></h1>

                <?php } ?>

            </div>
        </div>

        <div class="container">
            <div class="section">

                <h3>Novo pedido</h3>
                <div id="signup" class="col s12">
                    <form action="novopedido.php?send=true" method="post">
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="id" id="id" type="text" class="">
                                <label for="id">ID</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <select class="browser-default" id="produto" name="produto">
                                    <option value="" disabled selected>Escolha um produto</option>
                                    <option value="Chrome">Chrome</option>
                                    <option value="Firefox">Firefox</option>
                                    <option value="IE">IE</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="estoque" id="estoque" type="text" class="">
                                <label for="estoque">Estoque</label>
                            </div>
                        </div>
                </div>
                <br><br>

                <div class="row">
                    <div class="input-field col s12">
                        <input name="valor" id="valor" type="text" class="">
                        <label for="valor">Valor</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input name="quantidade" type="radio" value="1" id="quantidade1" class="browser-default" />
                        <label for="quantidade1">1 unidade</label>
                        <input name="quantidade" type="radio" value="5" id="quantidade5" class="browser-default" />
                        <label for="quantidade5">5 unidades</label>
                        <input name="quantidade" type="radio" value="10" id="quantidade10" class="browser-default" />
                        <label for="quantidade10">10 unidades</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <button class="btn waves-effect waves-light blue-grey darken-3" type="submit" name="action">Salvar</button>
                    </div>
                </div>
                </form>
            </div>

        </div>

        <footer class="page-footer orange">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Company Bio</h5>
                        <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


                    </div>
                    <div class="col l3 s12">
                        <h5 class="white-text">Settings</h5>
                        <ul>
                            <li><a class="white-text" href="#!">Link 1</a></li>
                            <li><a class="white-text" href="#!">Link 2</a></li>
                            <li><a class="white-text" href="#!">Link 3</a></li>
                            <li><a class="white-text" href="#!">Link 4</a></li>
                        </ul>
                    </div>
                    <div class="col l3 s12">
                        <h5 class="white-text">Connect</h5>
                        <ul>
                            <li><a class="white-text" href="#!">Link 1</a></li>
                            <li><a class="white-text" href="#!">Link 2</a></li>
                            <li><a class="white-text" href="#!">Link 3</a></li>
                            <li><a class="white-text" href="#!">Link 4</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
                </div>
            </div>
        </footer>


        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="http://materializecss.com/bin/materialize.js"></script>
        <script src="js/init.js"></script>

    </body>
</html>
