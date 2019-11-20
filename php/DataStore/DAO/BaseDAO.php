<?php
    require_once('Connection.php');
    //require_once('BaseDAO.php');
    class BaseDAO
    {
        public $con;
        function __construct(){}
        
        public $QueryItems = [];
        public $Filters = [];
        public $CommandParameters = [];
        
        function Connect()
        {
            $this->con=mysqli_connect(connection::url(),connection::user(),connection::pass(),connection::dbName());
        }
        
        function Disconnect()
        {
            mysqli_close($this->con);
        }
        
        function Select()
        {
            
        }
    }

