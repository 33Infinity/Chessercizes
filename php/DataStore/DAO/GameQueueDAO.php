<?php
    require_once('Includes.php');
    class GameQueueDAO extends BaseDAO
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

        function InsertUser($to)
        {
            $this->Connect();
            $columns = [$to::USERNAME, $to::GAMETYPE, $to::GAMEMODE, $to::TIMECONTROL];
            $values = [$to->user_name, $to->game_type, $to->game_mode, $to->time_control];
            $this->Insert($columns, $values, $to::TABLENAME);
            $this->CleanUp();
        }

        function DeleteUser($userName)
        {
            $this->Connect();
            $this->AddFilter(sprintf("%s=?", GameQueueTO::USERNAME));
            $this->AddCommandParameter("s", $userName);
            $this->Delete(GameQueueTO::TABLENAME);
            $this->CleanUp();
        }

        function FindMatchingUser($userName, $gameType, $gameMode, $timeControl)
        {
            $this->Connect();
            $this->AddQueryItem(GameQueueTO::USERNAME);
            $this->AddFilter(sprintf("%s!=?", GameQueueTO::USERNAME));
            $this->AddCommandParameter("s", $userName);
            $this->AddFilter(sprintf("%s=?", GameQueueTO::OPPONENT));
            $this->AddCommandParameter("s", "");
            if($gameType != ANY)
            {
                $this->AddFilter(sprintf("%s=?", GameQueueTO::GAMETYPE));
                $this->AddCommandParameter("s", $gameType);
            }
            if($gameMode != ANY)
            {
                $this->AddFilter(sprintf("%s=?", GameQueueTO::GAMEMODE));
                $this->AddCommandParameter("s", $gameMode);
            }
            if($timeControl != ANY)
            {
                $this->AddFilter(sprintf("%s=?", GameQueueTO::TIMECONTROL));
                $this->AddCommandParameter("s", $timeControl);
            }
            $results = $this->Select(GameQueueTO::TABLENAME);
            $this->CleanUp();
            if(count($results)>0)
            {
               return $results[0][GameQueueTO::USERNAME];
            }
            return "";
        }

        function GetOpponent($userName)
        {
            $to = new GameQueueTO();
            $this->Connect();
            $this->AddQueryItem(GameQueueTO::OPPONENT);
            $this->AddQueryItem(GameQueueTO::GAMETYPE);
            $this->AddQueryItem(GameQueueTO::GAMEMODE);
            $this->AddQueryItem(GameQueueTO::TIMECONTROL);
            $this->AddFilter(sprintf("%s=?", GameQueueTO::USERNAME));
            $this->AddCommandParameter("s", $userName);
            $this->AddFilter(sprintf("%s!=?", GameQueueTO::OPPONENT));
            $this->AddCommandParameter("s", "");
            $results = $this->Select(GameQueueTO::TABLENAME);
            $this->CleanUp();
            if(count($results)>0)
            {
               $to->opponent = $results[0][GameQueueTO::OPPONENT];
               $to->game_type = $results[0][GameQueueTO::GAMETYPE];
               $to->game_mode = $results[0][GameQueueTO::GAMEMODE];
               $to->time_control = $results[0][GameQueueTO::GAMEMODE];
               return $to;
            }
            return null;
        }

        function UpdateMatchingUser($userName)
        {
            $this->Connect();
            $this->Update($columns, $values, GameQueueTO::TABLENAME);
            $this->CleanUp();
        }
    }