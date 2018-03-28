<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="/">
   <img src="/assets/images/logo.png" height="25" style="float:left">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" style="position:absolute; top:5px; right:5px">
    <ul class="navbar-nav mr-auto">
     <?php if(!isset($user)){ ?>
       <li class="nav-item">
         <a class="nav-link" href="/registrazione">Registrati</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="/login">Login</a>
       </li>
     <?php }else{ ?>
      <?php if($user['xpub']!=''){ ?>
        <li class="nav-item">
          <a class="nav-link active" href="#">BTC</a>
        </li>
      <?php } ?>
      <?php if($user['eth']!=''){ ?>
        <li class="nav-item">
          <a class="nav-link" href="#">ETH</a>
        </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="/transazioni"><i class="fa fa-list"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/impostazioni"><i class="fa fa-cog"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/logout"><i class="fa fa-sign-out-alt"></i></a>
      </li>
     <?php } ?>
    </ul>
  </div>
</nav>
