
<!doctype html>
<html lang="it">
  <?php include('assets/header.php'); ?>
  <body>

    <?php include('assets/menu.php'); ?>

    <main role="main" style="margin-top:50px">
     <div class="row" style="margin:0">
        <div class="col-sm-9" style="margin:0; padding:0;">
           <div class="wrap-numbers">
             <div class="btn-number" onClick="addTotal('1')">1</div>
             <div class="btn-number" onClick="addTotal('2')">2</div>
             <div class="btn-number" onClick="addTotal('3')">3</div>
             <div class="btn-number" onClick="addTotal('4')">4</div>
             <div class="btn-number" onClick="addTotal('5')">5</div>
             <div class="btn-number" onClick="addTotal('6')">6</div>
             <div class="btn-number" onClick="addTotal('7')">7</div>
             <div class="btn-number" onClick="addTotal('8')">8</div>
             <div class="btn-number" onClick="addTotal('9')">9</div>
             <div class="btn-number" onClick="addTotal(',')">,</div>
             <div class="btn-number" onClick="addTotal('0')">0</div>
             <div class="btn-number" onClick="delTotal()"><img src="/assets/images/delete.jpg" height="38"></div>
           </div>
        </div>
        <div class="col-sm-3" style="background:#eee; height:calc(100vh - 55px); position:relative; margin:0; padding:0;">
          <div id="qr-wrap"></div>
          <div style="position:absolute; bottom:0; left:0; width:100%">
             <div id="wrap-total" style="position:absolute; bottom:0; left:0; background:#fff; height:80px; line-height:80px; padding: 0 15px"></div>
             <div id="wrap-total" style="position:absolute; bottom:0; right:0; width: 100px; height:80px; line-height:80px; padding: 0 15px">€</div>
          </div>
        </div>
     </div>
    </main><!-- /.container -->
    <?php include('assets/footer.php'); ?>
  </body>
</html>
