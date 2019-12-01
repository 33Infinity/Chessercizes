<?php

    class ActiveGameTO
    {
        function __construct(){}
        
        const TABLENAME = "activegame";
        const GAMEID = "game_id";
        const WHITE = "white";
        const BLACK = "black";
        const TURN = "turn";
        const DATETIMEINSERT = "datetime_insert";
        const MOVENUMBER = "move_number";
        const SOURCE = "source";
        const DESTINATION = "destination";
       
        public $game_id;
        public $white;
        public $black;
        public $turn;
        public $datetime_insert;
        public $move_number;
        public $source;
        public $destination;
    }