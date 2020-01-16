<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
</html>

<?php



database::connect(database::selectHost(), database::selectUser(), database::selectPassword(), database::selectDatabase());
// nazdarek

class admin {
    public $email;
    public $password;

    public function newUser($email, $password) {
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        database::query('INSERT INTO users(email, password) VALUES (?, ?)', array($this->email, $this->password));
    }

    public function loginUser () {
        if (isset($_SESSION['email'])) {
            header('Location: adminPage.php');
            exit();
        }

        if ($_POST) {
            $user = database::query('SELECT email, password FROM users');
            $getUser = $user->fetchAll(PDO::FETCH_NAMED);
            foreach ($getUser as $key => $value) {
                if (password_verify($_POST['password'], $value['password'])) {
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['password'] = $_POST['password'];
                    header('Location: adminPage.php');
                    exit();
                }
            }
        }

    }

    public function checkLogin ($pageRedirect) {
        if (isset($_SESSION['email'])) {
            return true;
        } else {
            header('Location: '.$pageRedirect);
            return false;
        }
    }

    public function displayTable () {
        $data = database::query('SELECT * FROM reservationinfo');
        $table = $data->fetchAll(PDO::FETCH_ASSOC);
        echo '<div class="container">
                <table class="table"><thead>
                <tr>
                <th>Jméno</th>
                <th>E-mail</th>
                <th>Datum konání koncertu</th>
                <th>Místo konání</th>
                <th>Datum odeslání rezervace</th>
                <th>Potvrzeno</th>
                <th>Potvrdit</th>
                </tr>
                </thead>
                <tbody>';

        foreach ($table as $array => $value) {
            echo '<tr><td>'.$value['name'].'</td><td>'.$value['email'].'</td><td>'.$value['datetime'].'</td>
                    <td>'.$value['place'].'</td><td>'.$value['created'].'</td><td>'.$value['approved'].'</td>
                    <td><a href="adminPage.php?id='.$value['id'].'&app=1">Schválit</a> / 
                    <a href="adminPage.php?id='.$value['id'].'&app=0">Zamítnout</a></td></tr>' ;
        }
        echo '</tbody></table></div>';
    }

    public function updateApproved () {
        if (isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['app'] == 0) {
            database::query('UPDATE reservationinfo SET approved=1 WHERE id='. $_GET['id'] );
            $mail = database::query('SELECT name, email FROM reservationinfo WHERE id= ' . $_GET['id']);
            $email = $mail->fetchAll(PDO::FETCH_ASSOC);
            // Odeslani mailu: mail($email['0']['email'], 'Rezervace', 'Vaše rezervace byla potvrzena.');
        } elseif (isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['app'] == 1) {
            database::query('UPDATE reservationinfo SET approved=0 WHERE id='. $_GET['id'] );
        }

    }

}
