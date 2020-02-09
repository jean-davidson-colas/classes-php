<?php


    class userpdo
    
    
    {
        private $id = "";
        public $login = "";
        public $email = "";
        public $firstname = "";
        public $lastname = "";
    
        public function register ($login, $password, $email, $firstname,$lastname)
        {
            
                try
                {
                    // Sous WAMP (Windows)
                    $bdd = new PDO('mysql:host=localhost;dbname=exo1;', 'root', '');
                    $bdd->query("INSERT INTO `utilisateurs`(`id`, `login`, `password`, `email`, `firstame`, `lastname`)
                    VALUES (NULL, \"$login\",\"$password\",\"$email\",\"$firstname\",\"$lastname\")");
                    
                    echo "tout est ok";
                }
                catch (Exception $e)
                {
                        die('Erreur : ' . $e->getMessage());
                }



    
        }
    
        public function connect($login, $password)
        {
            $bdd = new PDO('mysql:host=localhost;dbname=exo1;', 'root', '');
            $requete = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = '" . $login . "'");
            $requete->execute();
            $resultat = $requete->fetch();
            
    
            if ($password == $resultat[2]) {
                
                $this->id = $resultat[0];
                $this->login = $resultat[1];
                $this->password = $resultat[2];
                $this->email = $resultat[3];
                $this->firstname = $resultat[4];
                $this->lastname = $resultat[5];
                echo "<h2>c bon </h2>";
                
            } 
            
            else 
            {
                echo "<h2>Mauvais password Saisir a nouveau</h2>";
            }
    
        }
    
        public function disconnect()
        {
            
            $this->id = "";
            $this->login = "";
            $this->password = "";
            $this->email = "";
            $this->firstname = "";
            $this->lastname = "";
            
            
            if($this->id == "")
            {
                echo "vous etes deconnecter au revoir";
            }
            
        }
    
        public function delete()
        {
            $bdd = new PDO('mysql:host=localhost;dbname=exo1;', 'root', '');
            $sqlr = "DELETE FROM utilisateurs WHERE id =" . $this->id;
            $requete = $bdd->query($sqlr);
            if($requete == TRUE)
            {
                $this->disconnect();
            }
    
        }
    
        public function update($login, $password, $email, $firstname,$lastname)
        {
            //UPDATE retravailler merci Enzo  !!
            if ($this->id != NULL) 
            {
                $bdd = new PDO('mysql:host=localhost;dbname=exo1;', 'root', '');
                $sqlr = "SELECT * FROM utilisateurs WHERE id =" . $this->id;
                $requete = $bdd->query($sqlr);
                $resultat = $requete->fetchAll();
    
                if (!empty($resultat)) 
                {
                    if ($this->login != $login)
                    {
                        $this->login = $login;
                        echo "votre login a bien été modifer<br>";
                    } 
                    else
                    {
                        echo "ce login est déja utiliser<br>";
                    }
                    if ($this->email != $email)
                    {
                        $this->email = $email;
                        echo "votre email a bien été modifier<br>";
                    } 
                    else 
                    {
                        echo "cette email est déja utiliser<br>";
                    }
                    if ($this->firstname != $firstname)
                    {
                        $this->firstname = $firstname;
                        echo " votre firstname a bien été modifier<br>";
                    } 
                    else 
                    {
                        echo "ce firstname est déja utiliser<br><br>";
                    }
                    if ($this->lastname != $lastname) 
                    {
                        $this->lastname = $lastname;
                        echo "votre lastname a bien été modifier<br>";
                    } 
                    else
                    {
                        echo "ce lastname est déja utiliser<br><br>";
                    }
                    if ($this->password != password_verify($password,$this->password))
                    {
                        $this->password = password_hash($password,PASSWORD_DEFAULT);
                        echo "votre password a bien été modifier<br>";
                    } 
                    else
                    {
                        echo "cette password est déja utiliser<br><br>";
                    }
                    $req = "UPDATE `utilisateur` SET `login`= '" .
                    $this->login . "', `email`= '" . $this->email . "', `firstame`= '" .
                    $this->firstname . "', `lastname`= '" . $this->lastname . "',
                    `password`= '" .$this->password . "'WHERE id = " . $this->id;
                    $requete = $bdd->query($sqlr);
                }
            }
        }
            
    
        
    
        public function isConnected()
        {
            
            if(!empty($this->id))
            {
                echo "vous etes deco";
            }
            else 
            {
                echo "vous etes co";
            }
    
        }
    
        public function getAllInfos()
        {
            $bdd = new PDO('mysql:host=localhost;dbname=exo1;', 'root', '');
            $sqlr = "SELECT * FROM utilisateurs WHERE id =" . $this->id;
            $requete = $bdd->query($sqlr);
            $resultat = $requete->fetch();

            return [$this->id,$this->login,$this->password,$this->email,$this->firstname,$this->lastname]; 
            
    
        }
    
        public function getLogin()
        {
            $bdd = new PDO('mysql:host=localhost;dbname=exo1;', 'root', '');
            $sqlr = "SELECT login FROM utilisateurs WHERE id =" . $this->id;
            $requete = $bdd->query($sqlr);
            $resultat = $requete->fetch();

            return $this->login;
    
        }
        public function getEmail()
        {
            $bdd = new PDO('mysql:host=localhost;dbname=exo1;', 'root', '');
            $sqlr = "SELECT email FROM utilisateurs WHERE id =" . $this->id;
            $requete = $bdd->query($sqlr);
            $resultat = $requete->fetch();

            return $this->email;
    
        }
    
        public function getFirstname()
        {
            $bdd = new PDO('mysql:host=localhost;dbname=exo1;', 'root', '');
            $sqlr = "SELECT firstame FROM utilisateurs WHERE id =" . $this->id;
            $requete = $bdd->query($sqlr);
            $resultat = $requete->fetch();

            return $this->firstname;
    
        }
        public function getLastname()
        {
            $bdd = new PDO('mysql:host=localhost;dbname=exo1;', 'root', '');
            $sqlr = "SELECT lastname FROM utilisateurs WHERE id =" . $this->id;
            $requete = $bdd->query($sqlr);
            $resultat = $requete->fetch();

            return $this->lastname;
    
        }
        public function refresh()
        {
            $bdd = new PDO('mysql:host=localhost;dbname=exo1;', 'root', '');
            $sqlr = "SELECT * FROM utilisateurs WHERE id =" . $this->id;
            $requete = $bdd->query($sqlr);
            $resultat = $requete->fetch();


            $this->id = $resultat[0];
            $this->login = $resultat[1];
            $this->password = $resultat[2];
            $this->email = $resultat[3];
            $this->firstname = $resultat[4];
            $this->lastname = $resultat[5];
    
            return $this ; 
        }
    


    }


    $utilisateur = new Userpdo();
    $utilisateur->connect("toto","azerty");
    $utilisateur->update("azerty", "azerty","azerty", "azerty","azerty");
    
    
    
   





?>