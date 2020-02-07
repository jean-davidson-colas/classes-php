<?php



class User

{
    //initialisation des attributs 
    private $id = "";
    public $login = "";
    public $email = "";
    public $firstname = "";
    public $lastname = "";

    

    public function register($login, $password, $email, $firstname, $lastname)

    {
        $connexion = mysqli_connect("localhost", "root", "", "exo1");
        $requete2 = "SELECT login FROM utilisateurs WHERE login = \"$login\"";
        $confirmpass = 'led4';//Deviens $_POST["password"] en situation
        $query = mysqli_query($connexion, $requete2);
        $resultat = mysqli_fetch_all($query);

        if (!empty($resultat)) {
?>
            <p>Le login existe déjà !! </p>

        <?php

        } else if ($password != $confirmpass) {
        ?><p> Mots de passe sont différents.</p>
<?php
        } else {
            //$mdpv = password_hash($_POST["password"],PASSWORD_BCRYPT, array('cost' => 12)); a décommenter et insérer en requete sql pour hasher
            $requete_inscr = "INSERT INTO `utilisateurs`(`id`, `login`, `password`, `email`, `firstame`, `lastname`) VALUES (NULL, \"$login\",\"$password\",\"$email\",\"$firstname\",\"$lastname\")";
            $query_inscr = mysqli_query($connexion, $requete_inscr);
            echo "tout est ok";
        }
    }

    public function connect($login, $password)
    {
        
        $connexion = mysqli_connect("localhost", "root", "", "exo1");
        $requete2 = "SELECT * FROM utilisateurs WHERE login = '" . $login . "'";
        $query = mysqli_query($connexion, $requete2);
        $resultat = mysqli_fetch_row($query);
        //var_dump($resultat);

        if ($password == $resultat[2]) {
            
            $this->id = $resultat[0];
            $this->login = $resultat[1];
            $this->password = $resultat[2];
            $this->email = $resultat[3];
            $this->firstname = $resultat[4];
            $this->lastname = $resultat[5];
            echo "<h2>c bon </h2>";
        } else {
            echo "<h2>Mauvais password Saisir a nouveau</h2>";
        }
    }



    public function disconnect()
    {
        unset($_SESSION['login']);
    }

    public function delete()
    {
        $connexion = mysqli_connect("localhost", "root", "", "exo1");
        $login = $_SESSION['login'];
        $requete2 = "SELECT * FROM utilisateurs WHERE login = '" . $login . "'";
        $query = mysqli_query($connexion, $requete2);
        $resultat = mysqli_fetch_row($query);
        $requete = "DELETE FROM `exo1`.`utilisateurs` WHERE login = '" . $login . "'";
        $query = mysqli_query($connexion, $requete);
        echo "ciao bye bye";
        unset($_SESSION['login']);
    }

    public function update($login, $password, $email, $firstname, $lastname)
    {
        $connexion = mysqli_connect("localhost", "root", "", "exo1");
        $requete = "UPDATE `utilisateurs` SET `login` = '" . $login . "', `password` = '" . $password . "', `email` = '" . $email . "', `firstame` = '" . $firstname . "', `lastname` = '" . $lastname . "' WHERE login = '" . $this->login . "'";
        $query = mysqli_query($connexion, $requete);
        echo "</br>votre nouveau login est  \"$login\" ";
    }

    public function isConnected()
    {
        $connexion = mysqli_connect("localhost", "root", "", "exo1");

        if (isset($_SESSION)) 
        {
            echo "Bonjour vous etes connecté";
        } 
        else 
        {
            echo "non-connecter";
        }
    }

    public function getAllInfos()
    {
        
        if (NULL != $this->id)
        {
            return [$this->id,$this->login,$this->password,$this->email,$this->firstname,$this->lastname];
        }


    }

    public function getLogin()
    {
        if (NULL != $this->id)
        {
            return $this->login;
        }

       
    }
    public function getEmail()
    {
        if (NULL != $this->id)
        {
            return $this->email;
        }

        return $this->email;
    }

    public function getFirstname()
    {
        if (NULL != $this->id)
        {
            return $this->firstname;
        }

        return $this->firstname;
    }
    public function getLastname()
    {
        if (NULL != $this->lastname)
        {
            return $this->lastname;
        }

        return $this->lastname;
    }
    public function refresh()
    {
        $connexion = mysqli_connect("localhost", "root", "", "exo1");
        $requete2 = "SELECT * FROM utilisateurs WHERE login = '" . $this->login. "'";
        $query = mysqli_query($connexion, $requete2);
        $resultat = mysqli_fetch_row($query);
            
        $this->id = $resultat[0];
        $this->login = $resultat[1];
        $this->password = $resultat[2];
        $this->email = $resultat[3];
        $this->firstname = $resultat[4];
        $this->lastname = $resultat[5];

        return $this ;
    }
}


$utilisateur = new User();
$utilisateur->connect("toto", "zegzzrg");
$utilisateur->refresh();
var_dump($utilisateur->refresh());
//var_dump($_SESSION);
//var_dump($utilisateur->getLogin());
//var_dump($_SESSION);



?>