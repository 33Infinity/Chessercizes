<?php
    require_once('../php/DataStore/DAO/UserDAO.php');
    require_once('../php/Encryption.php');
    
    $register = new Register($_GET['userName'], $_GET['lastName'], $_GET['firstName'], $_GET['email'], $_GET['password']);
    $userName = $register->UserExists();
    if(is_null($userName))
    {
        $register->CreateAccount();
        echo ACCOUNTSUCCESSFULLYCREATED;
    }
    else
    {
        echo ACCOUNTALREADYEXISTS;
    }
    
    class Register
    {
        private $_userName;
        private $_lastName;
        private $_firstName;
        private $_email;
        private $_password;
        private $_userDAO;
        
        function __construct($userName, $lastName, $firstName, $email, $password)
        {
            $this->_userName = $userName;
            $this->_lastName = $lastName;
            $this->_firstName = $firstName;
            $this->_email = $email;
            $this->_password = $password;
            $this->_userDAO = new UserDAO();
        }
        
        public function UserExists()
        {
            $userTO = $this->_userDAO->FindUser($this->_userName);
            return $userTO->user_name;
        }

        public function CreateAccount()
        {
            $to = new UserTO();
            $to->user_name = $this->_userName;
            $to->first_name = $this->_firstName;
            $to->last_name = $this->_lastName;
            $to->email = $this->_email;
            $EncryptObj = new Encryption();
            $to->password = $EncryptObj->Encrypt($this->_password);
            $this->_userDAO->InsertUser($to);
        }
    }
