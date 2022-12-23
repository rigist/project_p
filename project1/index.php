
<?php


const IS_ADMIN = [0];

ini_set('display_errors', 'on');
ini_set('error_reporting', E_ALL | E_NOTICE);

$saveEmail = "";
$parts = parse_url($_SERVER['REQUEST_URI']);

switch ($parts['path']) {
    case '/':
    case '/index.php':

        $controllerLogin = new Login();
        $controllerLogin->loginAction();
        $controlPost = new ControllerPost();
        $controlPost->listenPost($saveEmail);

        $controlSession = new ControllerSession();
        $controlSession->controllSession($saveEmail);

        break;
}


class ControllerPost
{

    public function listenPost(&$saveEmail)
    {
        if (!empty($_POST["email"]) && $_POST["email"] !== "") {


            if (count($_POST) == 2) {

                $saveEmail = $_POST["email"];
                $mUser = new ModelUser();
                $mUser->searchEmail($_POST["email"], $_POST["pass"]);
            }
            if (count($_POST) == 3) {

                $mUser = new ModelUser();

                $password = $_POST["pass"];

                if ($_POST["pass"] == $_POST["pass_2"]) {
                    if (strlen($password) >= 4) {
                        $mUser->addUser(htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["pass"]));
                    } else {
                        echo "Пароль короткий";
                    }
                } else {
                    echo "Введено неправильно";
                }
            }
        } // if
    }
}








class Login
{
    function loginAction()
    {

        $vl = new ViewLogin();
        $vl->start();
    }
}

class ControllerSession
{

    public function controllSession(&$saveEmail)
    {
        if (!empty($_SESSION['auth'])) {

            $mm = new ModelMessage;
            $blog =   $mm->writeMessages();
            $bl = new viewBlog();
            $bl->viewBlog($blog);

            $vta = new ViewTextArea();
            $vta->viewTextArea();

            $dm = new ControllerDelMessages();
            $dm->controlDelMessages();
        }
        if (!empty($_POST["message"])) {
            var_dump($_POST["message"]);

            $mm = new ModelMessage;

            if (isset($_FILES['image']['tmp_name'])) {

                $mm->loadFile($_FILES['image']['tmp_name']);
            }

            $mm->addMessage(htmlspecialchars($_POST["message"]), htmlspecialchars($saveEmail));

            $blog = $mm->writeMessages();
            $bl = new viewBlog();
            $bl->viewBlog($blog);

            $dm = new ControllerDelMessages();
            $dm->controlDelMessages();
        }
    }
}

class ControllerDelMessages
{
    public function controlDelMessages()
    {
        if (!empty($_POST['form_id'])) {

            $mm = new ModelMessage;
            $mm->delMessage($_POST['form_id']);
        }
    }
}


class ModelUser
{
    public $name;
    public $id;
    public $data_reg;
    public $email;
    public $pass;

    public function addUser($email_one, $pass)
    {
        try {
            $conn3 = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
            $sql3 = "INSERT INTO users1 (email, pass) VALUES (:useremail, :pass)";

            $stmt3 = $conn3->prepare($sql3);

            $stmt3->bindValue(":useremail", $email_one);
            $stmt3->bindValue(":pass", $pass);

            $affectedRowsNumber = $stmt3->execute();

            if ($affectedRowsNumber > 0) {
                echo "Data successfully added: name=";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    } //add_user


    function searchEmail($email_two, $pass)
    {

        try {
            $conn = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
            $sql = "SELECT * FROM users1 WHERE email = :useremail";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":useremail", $email_two);
            $stmt->execute();


            if ($stmt->rowCount() > 0) {
                foreach ($stmt as $row) {
                    echo "<br>";
                    
                    if ($email_two == $row["email"]) {
                         
                        $this->searchPass($pass);
                        break;
                    }
                }
            } else {
                echo "не найдено";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    function searchPass($pass)
    {

        try {
            $conn = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
            $sql = "SELECT * FROM users1 WHERE pass = :pass";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":pass", $pass);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                foreach ($stmt as $row) {
                    echo "<br>";
                    
                    if ($pass == $row["pass"]) {
                       
                        session_start();
                        $_SESSION['auth'] = true;
                        break;
                    }
                }
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public static function passHash($pass)
    {
        return sha1('gtrhyth' . $pass);
    }
}


class ModelMessage
{

    public $id;
    public $data_text;
    public $text;
    public $id_user;
    public $image = "";


    public function addMessage($text, $id_user)
    {
        try {
            $conn3 = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
            $sql3 = "INSERT INTO messages1 (iduser, text) VALUES (:iduser, :text)";

            $stmt3 = $conn3->prepare($sql3);

            $stmt3->bindValue(":iduser", $id_user);
            $stmt3->bindValue(":text", $text);

            $affectedRowsNumber = $stmt3->execute();

            if ($affectedRowsNumber > 0) {
                echo "Data successfully added:  ";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    } //add_user

    public function writeMessages($limit = 20)
    {


        try {
            $conn = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
            $sql = "SELECT * FROM  messages1 WHERE id>0 ORDER BY id LIMIT 10, $limit";
            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $blogText = [];
            $blogEmail = [];
            $blogId = [];

            if ($stmt->rowCount() > 0) {
                foreach ($stmt as $row) {
                    array_push($blogText, $row["text"]);
                    array_push($blogEmail, $row["iduser"]);
                    array_push($blogId, $row["id"]);
                }
            }
            return [$blogText, $blogEmail, $this->image, $blogId];
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function loadFile($file)
    {
        if (file_exists($file)) {
            $this->image = sha1(microtime(1) . mt_rand(1, 100000000)) . '.jpg';
            move_uploaded_file($file, ".\\" . $this->image);
        }
    }

    public function delMessage($id)
    { {
            try {
                $conn = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
                $sql = "DELETE FROM messages1 WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(":id", $id);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
            }
        }
    }
}


class ViewLogin
{

    public $template = <<<EOT
    <form id="form1" action="index.php" method="post">
        <p>Вход:</p>
        <label>Логин:
            <input class="" name="email" type="text" placeholder="">
        </label>
        <label>Пароль:
            <input class="" name="pass" type="text" placeholder=""></label>
        <input name="" type="submit" value="Войти">
    </form>
    
    <p>Зарегистрироваться</p>
    <form id="formReg" action="index.php" method="post">
        <!-- <div class="">Login:</div> <input type="text" value="" name="name"><br> -->
        <div class="">Email:</div> <input type="text" value="" name="email"><br>
        <div class="">Password:</div> <input type="text" value="" name="pass"><br>
        <div class="">Confirm Password:</div> <input type="text" value="" name="pass_2"><br>
        <input type="submit" value="Зарегистрироваться">
    </form>
    EOT;

    public function start()
    {
        print_r($this->template);
    }
}

class ViewBlog
{
    public function viewBlog($blog)
    {
        $blogEmail = $blog[1];
        $blogText = $blog[0];
        $image = $blog[2];
        $id = $blog[3];

        echo "<br>";
        foreach ($blogEmail as $keyE => $valueE) {
            if ($image != "") {
                echo "<img src='./$image' style='width: 70px;'>";
            }

            if (true) {
                echo '<form action="index.php" method="post">';
                echo " <input type='hidden' name='form_id' value='$id[$keyE]' />";
                echo ' <button type="submit" >Удалить</button>';
                echo ' </form>';
            }

            echo "<b>" . $blogEmail[$keyE] . "</b>";
            echo "<br>";
            echo $blogText[$keyE];
            echo "<br>";
        }
    }
}

class ViewTextArea
{
    public function viewTextArea()
    {
        echo  "<form enctype='multipart/form-data' action='index.php' method='post'>";
        echo   "<textarea style='width: 250px; height: 150px;' type='text' value='' name='message'></textarea><br><br>";
        echo   "Изображение: <input type='file' name='image'><br>";
        echo  "<input type='submit' value='Отправить'>";
        echo   "</form>";
        echo   "<br>";
    }
}


class Api
{
    public function api($user_id)
    {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=testdb1", "root", "root");
            $sql = "SELECT * FROM messages1 WHERE iduser = :iduser LIMIT 20";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":iduser", $user_id);
            $stmt->execute();

            $text = "";

            if ($stmt->rowCount() > 0) {
                foreach ($stmt as $row) {

                    $text .= $row["text"] . " ";
                }
            }
            echo " json "; 
            echo  json_encode($text);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
}

$api = new Api();
$api->api("kirill@mail.ru");
