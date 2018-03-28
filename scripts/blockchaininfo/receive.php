<?php
   if(isset($_GET['action']) && $_GET['action']=='receive'){
    $my_xpub = 'xpub6DU9uRLk7fgK66HaWThB7esCbPxEeChAcShHVtoaqyUBVmLhiBNAj7fzYyqeMwSJxBrWvT1n7JSkqqSLAE1zrPmNX13Q3rAvL3byHchGkSc';
    $my_api_key = 'b69ee711-ec75-42b2-8525-640bbb2e5fa9';

    $my_callback_url = 'http://138.68.169.89/scripts/blockchaininfo/receive.php?action=callback';

    $root_url = 'https://api.blockchain.info/v2/receive';

    $parameters = 'xpub=' .$my_xpub. '&callback=' .urlencode($my_callback_url). '&key=' .$my_api_key;

    $response = file_get_contents($root_url . '?' . $parameters);

    $object = json_decode($response);

    echo $object->address;

   }

   if(isset($_GET['action']) && $_GET['action']=='callback'){

   }
?>
