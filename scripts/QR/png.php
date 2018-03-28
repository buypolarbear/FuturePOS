<?php
  $coinmarketcap=json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/bitcoin/?convert=EUR'),1);
  $BTC=$coinmarketcap[0];
?>
<img src="/scripts/QR/qrgen.php?qr=bitcoin:<?php echo $_POST['address']; ?>?amount=<?php echo round(str_replace(',','.',$_POST['amount'])/$BTC['price_eur'],8); ?>" width="100%">
<br>
<div style="font-size: 22px; text-align:center; padding:25px">
   <?php echo round(str_replace(',','.',$_POST['amount'])/$BTC['price_eur'],8); ?><br>in BTC<br>
   <span style="font-size:10px"><?php echo round($BTC['price_eur'],2); ?>€</span>
   <br><br>
   Attendo il pagamento...
</div>
