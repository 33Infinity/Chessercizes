<?php
    require_once('BaseDAO.php');
    require_once(dirname(__DIR__, 2) . '/DataStore/TO/UserTO.php');
    class UserDAO extends BaseDAO
    {   
        function __construct()
        {
            $this->Connect();
        }
        
        function Insert()
        {
            $this->Connect();
            
            $this->Disconnect();
        }
         
        function AddQueryItem($queryItem)
        {
            array_push($this->QueryItems, $queryItem);
            //$this->AddQueryItem($queryItem);
        }
        
        function AddFilter($filter)
        {
            array_push($this->Filters, $filter);
        }
        
        function FindUser($userName)
        {
            $to = new UserTO();
            $this->AddQueryItem($to::USERNAME);
            
            $to->user_name = "JK";
            return $to;
        }
        
    }
