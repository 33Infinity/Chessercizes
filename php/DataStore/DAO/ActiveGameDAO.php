<?php
    require_once('Includes.php');
    class ActiveGameDAO extends BaseDAO
    {
        function __construct(){}
        
        function AddQueryItem($queryItem)
        {
            array_push($this->QueryItems, $queryItem);
        }
        
        function AddFilter($filter)
        {
            array_push($this->Filters, $filter);
        }

        function AddCommandParameter($type, $value)
        {
            $commandParameter = new CommandParameter($type, $value);
            array_push($this->CommandParameters, $commandParameter);
        }

        function AddSortItem($column, $order)
        {
            $sortItem = new SortItem($column, $order);
            array_push($this->SortItems, $sortItem);
        }

        function UpdateGame($columns, $values)
        {
            $this->Connect();
            $this->Update($columns, $values, ActiveGameTO::TABLENAME);
            $this->CleanUp();
        }
    }