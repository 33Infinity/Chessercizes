<?php
    require_once('Includes.php');
    class GameBaseDAO extends BaseDAO
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

        function CreateGame($to)
        {
            $this->Connect();
            $columns = [$to::WHITE, $to::BLACK, $to::GAMETYPE, $to::TIMECONTROL, $to::GAMEMODE];
            $values = [$to->white, $to->black, $to->game_type, $to->time_control, $to->game_mode];
            $this->Insert($columns, $values, $to::TABLENAME);
            $this->CleanUp();
        }

        function UpdateGame()
        {
            $this->Connect();
            $this->Update($columns, $values, GameBaseTO::TABLENAME);
            $this->CleanUp();
        }
    }