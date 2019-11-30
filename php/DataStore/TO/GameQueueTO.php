<?php

    class GameQueueTO
    {
        function __construct(){}
        
        const TABLENAME = "gamequeue";
        const ROWID = "row_id";
        const USERNAME = "user_name";
        const DATETIMEINSERT = "datetime_insert";
        const GAMETYPE = "game_type";
        const GAMEMODE = "game_mode";
        const TIMECONTROL = "time_control";
        const OPPONENT = "opponent";
       
        public $row_id;
        public $user_name;
        public $datetime_insert;
        public $game_type;
        public $game_mode;
        public $time_control;
        public $opponent;
    }