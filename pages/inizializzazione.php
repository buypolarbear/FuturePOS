<!doctype html>
<html lang="it">
  <?php include('assets/header.php'); ?>
  <body>

    <?php include('assets/menu.php'); ?>

    <main role="main" class="container" style="margin-top:90px">
     <div class="starter-template">
       <h1>Mancano ancora gli ultimi passaggi</h1>
       <p class="lead">
        Stiamo creando per te un account su Blockchain.info<br>non appena creato ti arriverà un'email di conferma e dovrai attivare il tuo account.<br><br>
        Se vuoi attivare i pagamenti attraverso Ethereum inserisci nella pagina delle impostazioni il wallet di riferimento.<br><br>
        Stiamo creando per te la password di accesso, ti preghiamo di salvarla e custodirla per bene perchè noi non lo faremo per te!
        <div id="response"></div>
       </p>
     </div>
    </main><!-- /.container -->
    <?php include('assets/footer.php'); ?>
    <script>
      $(document).ready(function(){
        initUser();
      });
    </script>
  </body>
</html>
