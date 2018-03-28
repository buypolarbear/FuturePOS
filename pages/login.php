<!doctype html>
<html lang="it">
  <?php include('assets/header.php'); ?>
  <link href="/assets/css/login.css" rel="stylesheet">
  <body>

    <?php include('assets/menu.php'); ?>

    <form class="form-signin" method="POST" style="padding:200px 0">
     <div class="row">
      <div class="col-sm-4 offset-md-4">
         <h1 class="h3 mb-3 font-weight-normal">Entra in FuturePOS</h1>
         <label for="inputEmail" class="sr-only">Indirizzo e-mail</label>
         <input type="email" id="inputEmail" class="form-control" placeholder="Indirizzo e-mail" name="email" required autofocus>
         <label for="inputPassword" class="sr-only">Password</label>
         <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
         <br>
         <div class="checkbox mb-3">
           <label>
             <input type="checkbox" name="login-remember-me" value="remember-me"> Ricordami
           </label>
         </div>
         <button class="btn btn-lg btn-primary btn-block" type="submit">Entra</button>
       </div>
     </div>
     <input type="hidden" name="login" value="Y">
    </form>
    <?php include('assets/footer.php'); ?>
  </body>
</html>
