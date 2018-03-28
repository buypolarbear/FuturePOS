<?php

  $file = '../.htaccess';
  $fp = fopen($file, 'w');

  $htaccess='
 		 RewriteEngine On
 		 Options -Multiviews
 		 Options -Indexes
		  RewriteCond %{HTTPS} !=on
    RewriteRule ^(.*)$ https://%{HTTP_HOST}/$1 [R,QSA]
    ErrorDocument 404 /index.php?page=404
  		#CUSTOM-DATATYPES#

  		#CUSTOM HTACCESS#
  		#WEBSITE#
  		RewriteRule (\W|^)login(\W|$)  index.php?page=login [L]
  		RewriteRule (\W|^)impostazioni(\W|$)  index.php?page=impostazioni [L]
  		RewriteRule (\W|^)transazioni(\W|$)  index.php?page=transazioni [L]
  		RewriteRule (\W|^)registrazione(\W|$)  index.php?page=registrazione [L]
  		RewriteRule (\W|^)logout(\W|$)  index.php?doLogout=true [L]
  		RewriteRule (\W|^)init(\W|$)  actions.php?require=scripts/blockchaininfo/wallet.php&action=create [L]
		';

  $check_htaccess=fwrite($fp, $htaccess);

  fclose($fp);

?>
