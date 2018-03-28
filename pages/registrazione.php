<!doctype html>
<html lang="it">
  <?php include('assets/header.php'); ?>
  <link href="/assets/css/login.css" rel="stylesheet">
  <body>

    <?php include('assets/menu.php'); ?>

    <form class="form-signin" method="POST" style="padding:200px 0">
     <div class="row">
      <div class="col-sm-4 offset-md-4">
         <h1 class="h3 mb-3 font-weight-normal">Registrati subito</h1>
         <label for="inputNome" class="sr-only">Nome</label>
         <input type="text" id="inputNome" name="nome" class="form-control" placeholder="Nome" required autofocus>
         <label for="inputCognome" class="sr-only">Cognome</label>
         <input type="text" id="inputCognome" name="cognome" class="form-control" placeholder="Cognome" required autofocus>
         <label for="inputEmail" class="sr-only">Indirizzo e-mail</label>
         <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Indirizzo e-mail" required autofocus>
         <br>
         <button class="btn btn-lg btn-primary btn-block" type="submit">Registrati</button>
       </div>
     </div>
     <input type="hidden" name="register" value="Y">
    </form>
    <?php include('assets/footer.php'); ?>
  </body>
</html>
