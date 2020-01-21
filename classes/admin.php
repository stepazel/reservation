<?php



database::connect(database::selectHost(), database::selectUser(), database::selectPassword(), database::selectDatabase());
// nazdarek

class admin {
    public $email;
    public $password;

    public function checkLogin ($pageRedirect) {
        if (!isset($_SESSION['email'])) {
            header('Location: reservationLogin.php');
        }
    }

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

    public function updateApproved () {
        if (isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['app'] == 1) {
            database::query('UPDATE reservationinfo SET approved=1 WHERE id='. $_GET['id'] );
            $mail = database::query('SELECT name, email FROM reservationinfo WHERE id= ' . $_GET['id']);
            $email = $mail->fetchAll(PDO::FETCH_ASSOC);
            // Odeslani mailu: mail($email['0']['email'], 'Rezervace', 'Vaše rezervace byla potvrzena.');
        } elseif (isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['app'] == 0) {
            database::query('UPDATE reservationinfo SET approved=0 WHERE id='. $_GET['id'] );
        }
    }
}
