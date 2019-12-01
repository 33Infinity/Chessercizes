<?php
    require_once('../php/Includes.php');

    $action = $_GET['action'];
    $response = new Response();
    if($action == ADDUSERTOQUEUE)
    {
        $gameQueue = new GameQueue($_GET['userName'], $_GET['gameType'], $_GET['gameMode'], $_GET['timeControl']);
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
            $response->GameMode = $to->game_mode;
            $response->TimeControl = $to->time_control;
            echo json_encode($response);
        }
        else
        {
            $response->Message = STILLSEARCHING;
            echo json_encode($response);
        }
    }

    class GameQueue
    {
        private $_userName;
        private $_gameType;
        private $_gameMode;
        private $_timeControl;
        private $_gameQueueDAO;

        function __construct($userName, $gameType, $gameMode, $timeControl)
        {
            $this->_userName = $userName;
            $this->_gameType = $gameType;
            $this->_gameMode = $gameMode;
            $this->_timeControl = $timeControl;
            $this->_gameQueueDAO = new GameQueueDAO();
        }

        function AddUserToQueue()
        {
            $to = new GameQueueTO();
            $to->user_name = $this->_userName;
            $to->game_type = $this->_gameType;
            $to->game_mode = $this->_gameMode;
            $to->time_control = $this->_timeControl;
            $this->_gameQueueDAO->InsertUser($to);
        }

        function FindMatchingUser()
        {
            return $this->_gameQueueDAO->FindMatchingUser($this->_userName, $this->_gameType, $this->_gameMode, $this->_timeControl);
        }

        function GetOpponent()
        {
            return $this->_gameQueueDAO->GetOpponent($this->_userName);
        }

        function RemoveUserFromQueue()
        {
            $this->_gameQueueDAO->DeleteUser($this->_userName);
        }

        function SetMatchingUser($userName)
        {
            $columns = [GameQueueTO::OPPONENT];
            $values = [$userName];
            $this->_gameQueueDAO->AddFilter(sprintf("%s=?", GameQueueTO::USERNAME));
            $this->_gameQueueDAO->AddCommandParameter("s", $this->_userName);
            $this->_gameQueueDAO->UpdateMatchingUser($columns, $values);
        }
    }