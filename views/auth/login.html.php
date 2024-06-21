<?php if ($auth::isAuth()) $auth::redirect('/') ?>
<main class="container-form">

  <!-- affichage des erreurs s'il y en a -->
  <?php include(PATH_ROOT . 'views/_templates/_message.html.php') ?>



<div class="login-box">
  <form class="auth-form  mx-auto" action="/login" method="POST">
    <div class="box-auth-input">
      <label class="detail-description mb-3 h4">Adresse Email</label>
      <input type="email" class="form-control" name="email">
    </div>
    <div class="box-auth-input mt-3 ">
      <label class="detail-description mb-3 h4">Mot de passe</label>
      <input type="password" class="form-control" name="password">
    </div>
    
   
    <button type="submit" class="call-action  button  btn-lg mt-4 h5 ">Je me connecte</button>
  </form>
  <p class="header-description mt-5 ">Je n'ai pas de compte, <a class="auth-link" href="/inscription"><span class="spanColor">je m'inscrit</span></a></p>
  </div>
</main>