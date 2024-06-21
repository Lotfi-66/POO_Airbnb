<?php if ($auth::isAuth()) $auth::redirect('/') ?>
<main class="container-form">
  <h1 class="text-center">Je crée mon compte</h1>
  <!-- affichage des erreurs s'il y en a -->
  <?php include(PATH_ROOT . 'views/_templates/_message.html.php') ?>
  <div class="login-box">
  <form class="auth-form" action="/register" method="POST">
    <div class="box-auth-input">
      <label class="detail-description pb-3">Adresse Email</label>
      <input type="email" class="form-control" name="email">
    </div>
    <div class="box-auth-input">
      <label class="detail-description p-3">Mot de passe</label>
      <input type="password" class="form-control" name="password">
    </div>
    <div class="box-auth-input">
      <label class="detail-description p-3">Votre nom</label>
      <input type="text" class="form-control" name="lastname">
    </div>
    <div class="box-auth-input">
      <label class="detail-description p-3">Votre prénom</label>
      <input type="text" class="form-control" name="firstname">
    </div>
    <button type="submit" class="call-action button mt-4">Je m'inscrit</button>
  </form>
  <p class="header-description p-3">J'ai déja un compte, <a class="auth-link " href="/connexion">je me <b>connecte</b></a></p>
  </div>
</main>