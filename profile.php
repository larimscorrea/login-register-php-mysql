<?php

    if(isset($_SESSION['userId'])) {
        require('.config/db.php');
        
        $userId = $_SESSION['userId'];

        if($_POST['edit']) {
            $userName = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
        $userEmail = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
        }

        $stmt = $pdo -> prepare('SELECT * from users WHERE id = ? ');
        $stmt->execute([$userId]);

        $user = $stmt -> fetch();

    }


   

        // $userName = $_POST["userName"];
        // $userEmail = $_POST["userEmail"];
        // $password = $_POST["password"];
    
        $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

        if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $stmt = $pdo -> prepare('SELECT * from users WHERE email = ? ');
        $stmt -> execute([$userEmail]);
        $totalUsers = $stmt -> rowCount();

        // echo $totalUsers . '<br >';

            if( $totalUsers > 0) {
                // echo "E-mail já foi  adicionado <br>";
                $emailTaken = "Email já foi adicionado";
                } else {
                $stmt = $pdo -> prepare('INSERT into user(name, email, password) VALUES(?, ?, ?)');
                $stmt -> execute( [ $userName, $userEmail, $passwordHashed]);
            } 
        }

        // echo $userEmail . " " . $userName . " " . $password;

    }
?>

<?php require('./inc/header.html'); ?>

<div class="container">
    <div class="card">

        <div class="card-header bg-light mb-3">Atualize com seus dados
            
        <div class="card-body">
            <form action="profile.php" method="POST">

                <div class="form-group">
                    <label for="userName">Usuário</label>
                    <input required type="text" name="userName" class="form-control" value="<?php echo $user->name ?>" />
                </div>

                <div class="form-group">
                    <label for="userEmail">E-mail</label>
                    <input required type="email" name="userEmail" class="form-control" value="<?php echo $user->email ?>" />
                    <br />
                    <?php if(isset($emailTaken)) { ?>
                        <p style="background-color: red"><?php echo $emailTaken ?></p>
                    <?php } $emailTaken ?>
                </div>

                <button name="edit" type="submit" class="bt btn-primary">Atualizar dados</button>
            </form>
        </div>
        </div>

    </div>

    <?php require('./inc/footer.html') ?>