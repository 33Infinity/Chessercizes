<?php
    require_once('../php/Includes.php');

    $action = $_GET['action'];
    $response = new Response();
    $gameQueue;
    if($action == ADDUSERTOQUEUE)
    {
        $gameQueue = new GameQueue($_GET['userName'], $_GET['gameType'], $_GET['timeControl']);
        $gameQueue->RemoveUserFromQueue();
        $gameQueue->AddUserToQueue();
    }
    if($action == FINDOPPONENT)
    {
        $gameQueue = new GameQueue($_GET['userName'], "", "", "");
        $to = $gameQueue->GetOpponent();
        if($to != null)
        {
            $response->Opponent = $to->opponent;
            $response->GameType = $to->game_type;
            $response->TimeControl = $to->time_control;
            echo json_encode($response);
        }
        else
        {
            $response->Message = STILLSEARCHING;
            echo json_encode($response);
        }
    }
    if($action == REMOVEUSERFROMQUEUE)
    {
        $gameQueue = new GameQueue($_GET['userName'], "", "", "");
        $gameQueue->RemoveUserFromQueue();
    }
    $gameQueue->PerformMatching();

    class GameQueue
    {
        private $_userName;
        private $_gameType;
        private $_timeControl;
        private $_gameQueueDAO;

        function __construct($userName, $gameType, $timeControl)
        {
            $this->_userName = $userName;
            $this->_gameType = $gameType;
            $this->_timeControl = $timeControl;
            $this->_gameQueueDAO = new GameQueueDAO();
        }

        function AddUserToQueue()
        {
            $to = new GameQueueTO();
            $to->user_name = $this->_userName;
            $to->game_type = $this->_gameType;
            $to->time_control = $this->_timeControl;
            $this->_gameQueueDAO->InsertUser($to);
        }

        function FindMatchingUser()
        {
            return $this->_gameQueueDAO->FindMatchingUser($this->_userName, $this->_gameType, $this->_timeControl);
        }

        function GetOpponent()
        {
            return $this->_gameQueueDAO->GetOpponent($this->_userName);
        }

        function RemoveUserFromQueue()
        {
            $this->_gameQueueDAO->DeleteUser($this->_userName);
        }

        function SetMatchingUser($userName, $opponent)
        {
            $columns = [GameQueueTO::OPPONENT];
            $values = [$opponent];
            $this->_gameQueueDAO->AddFilter(sprintf("%s=?", GameQueueTO::USERNAME));
            $this->_gameQueueDAO->AddCommandParameter("s", $userName);
            $this->_gameQueueDAO->UpdateMatchingUser($columns, $values);
        }

        function PerformMatching()
        {
            $tos = $this->_gameQueueDAO->GetUnmatchedUsers();
            if(count($tos) > 1)
            {
                for($i=0; $i<count($tos)+1; $i++)
                {
                    $to1 = $tos[$i];
                    if($to1->opponent == "")
                    {
                        for($j=$i+1; $j<count($tos)+1; $j++)
                        {
                            $to2 = $tos[$j];
                            if($to2->opponent == "" && $this->IsMatch($to1, $to2))
                            {
                                $this->SetMatchingUser($to1->user_name, $to2->user_name);
                                $this->SetMatchingUser($to2->user_name, $to1->user_name);
                                $tos[$i]->opponent = $to2->user_name;
                                $tos[$j]->opponent = $to1->user_name;
                                break;
                            }
                        }
                    }
                }
            }
        }

        function IsMatch($to1, $to2)
        {
            $match = true;
            if($to1->game_type != $to2->game_type && $to1->game_type != ANY && $to2->game_type != ANY)
            {
                return false;
            }
            if($to1->time_control != $to2->time_control && $to1->time_control != ANY && $to2->time_control != ANY)
            {
                return false;
            }
            return $match;
        }
    }