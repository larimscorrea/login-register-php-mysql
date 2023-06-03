<?php
if(isset($_POST['register'])) {
    require('./config/db.php');

    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    $password = $_POST["password"];

    echo $userName . "" . $userEmail . "" . $password;
}
    ?>

<?php require('./inc/header.html'); ?>

<div class="container">
    <div class="card">
        <div class="card-header bg-light mb-3">Registre-se
            
        <div class="card-body">
            <form action="register.php" method="POST">
                
                <div class="form-group">
                    <label for="userName">Usuário</label>
                    <input required type="text" name="userName" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="userEmail">E-mail</label>
                    <input required type="email" name="userEmail" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input required type="password" name="password" class="form-control" />
                </div>

                <button name="register" type="submit" class="bt btn-primary">Registrar</button>
            </form>
        </div>
        </div>

    </div>

    <?php require('./inc/footer.html') ?>