<?php

   //error_reporting(E_ALL); ini_set('display_errors', 'On');
   //echo '<pre>';

   if(isset($_GET['action']) && $_GET['action']=='create'){

      $password=generate_pwd();
      $email=$user['email'];

      $data=array(
       "password" => $password,
       "api_code" => "b69ee711-ec75-42b2-8525-640bbb2e5fa9",
       "email" => $email,
       "hd" => true
      );

      $endpoint='http://localhost:3000/api/v2/create';

      $request = json_encode($data);

      $curl = curl_init($endpoint);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json"));
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

      $result     = curl_exec($curl);
      $response   = json_decode($result,1);
      echo "<h3>Il tuo wallet è stato creato, la pagina si aggiornerà automaticamente entro 15 secondi,<br>oppure <a href='/'>clicca qui</a> per aggiornare.</h3><script>setTimeout(function(){ window.location='/'; },15000);</script>";

      sendMail(
          $user['email'],
          $user['nome'].' '.$user['cognome'],
          'La tua password del wallet su Blockchain.info',
          'Ciao '.$user['nome'].' '.$user['cognome'].',<br>
          la password che abbiamo creato per te è: <strong>'.$password.'</strong><br><br>
          Attenzione!! Non perdere la password perchè noi non la salveremo al posto tuo!'
      );

      runDBQuery("UPDATE datatype_account SET xpub=? WHERE id=?",array($response['address'],$user['id']));
      curl_close($curl);
   }

   if(isset($_GET['action']) && $_GET['action']=='inspect'){

     $xpub='xpub6DU9uRLk7fgK66HaWThB7esCbPxEeChAcShHVtoaqyUBVmLhiBNAj7fzYyqeMwSJxBrWvT1n7JSkqqSLAE1zrPmNX13Q3rAvL3byHchGkSc';
     $endpoint='https://blockchain.info/it/multiaddr?active='.$xpub;

     $curl = curl_init($endpoint);
     curl_setopt($curl, CURLOPT_HEADER, false);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($curl, CURLOPT_HTTPHEADER,
             array("Content-type: application/json"));
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

     $result     = curl_exec($curl);
     $response   = json_decode($result);
     var_dump($response);
     curl_close($curl);

   }
?>
