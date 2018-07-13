<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Verificando acesso</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form method="post" class="navbar-form navbar-right" id="frmLogin" role="form">
            <div class="form-group">
              <input name="log_email" type="text" class="form-control" id="log_email" placeholder="Usuário...">
            </div>
            <div class="form-group">
              <input name="log_senha" type="password" class="form-control" id="log_senha" placeholder="Senha...">
            </div>
            <button type="submit" class="btn btn-success">Entrar</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- <div class="container"> -->
      <!-- Example row of columns -->
      <!-- <div class="row">
        <div class="col-md-4">
          <h2>Atual JWT</h2>
          <p id="token" class="code">&nbsp;</p>
          <p><a href="#" class="btn btn-default" id="btnExpire" role="button">Expirar sessão</a></p>
        </div>
        <div class="col-md-4">
          <h2>Descriptografado JWT</h2>
          <p><pre id="decodedToken">&nbsp;</pre></p>
        
        </div>
        <div class="col-md-4">
          <h2>Entrada</h2>
          <p><a href="#" class="btn btn-default" id="btnGetResource" role="button">Simular entrada</a></p>
          <p class="resourceContainer" id="resourceContainer">&nbsp;</p>
        </div>
      </div> -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <script>window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"><\/script>')</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/vendor/jsrsasign-4.1.4-all-min.js"></script>
        <script src="js/main.js"></script>
       
    </body>
</html>
