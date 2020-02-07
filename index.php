<?php

//creer un objet 

class User 
{
    //private sous entend que la variable ne peut etre modifier a l'inverse public !!!!! (encapsulation)

    private $login = "";

    public function setlogin($str)
    {
        if(strlen($str) > 3)
        {
            $this->login =$str;
        }

        else
        {
            $this->login = "iytizeithiozehhi";
        }
    }

    public function getlogin()
    {
        return ($this->login);
    }


}



$pascal = new User();

$pascal->setlogin("amelie");


//echo $pascal->getlogin();








?>