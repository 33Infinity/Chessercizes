<?php
    require_once('../php/DataStore/DAO/UserDAO.php');
    
    //echo "here";
    $register = new Register($_GET['userName'], $_GET['lastName'], $_GET['firstName'], $_GET['email'], $_GET['password']);
    echo $register->UserExists();
    //echo "dfs";
    
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
            $this->_userDAO->AddQueryItem(UserTO::USERNAME);
            $this->_userDAO->AddQueryItem(UserTO::LASTNAME);
            $userTO = $this->_userDAO->FindUser($this->_userName);
            return $userTO->user_name;
        }
    }
