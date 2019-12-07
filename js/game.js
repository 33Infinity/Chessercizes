var game 
{
     var clockInterval;
     var moveInterval;
     var game;
     var wait_for_script;
     var gameType;
     var gameMode;
     var timeControl;
     var userName;
     var startingFenPosition;
     var white;
     var black;
     var turn;
     var source;
     var destination;
     var whiteTimeRemaining;
     var blackTimeRemaining;
     var started;
     var gameID;
     var color;
     var newEngineGame = function () { };
     function initializeGame() 
     {
          load();
          gameType = getParameterByName(GAMETYPEPARAMETER, window.location.href);
          gameMode = getParameterByName(GAMEMODEPARAMETER, window.location.href);
          timeControl = getParameterByName(TIMECONTROLPARAMETER, window.location.href);
          userName = getParameterByName(USERNAMEPARAMETER, window.location.href);
          startingFenPosition = getStartingFenPosition(gameType);
          if(gameMode===PVE)
          {
               game = engineGame(null, startingFenPosition);
               newEngineGame = function newEngineGame()
               {
                    var baseTime = parseFloat($('#timeBase').val()) * 60;
                    var inc = parseFloat($('#timeInc').val());
                    var skill = parseInt($('#skillLevel').val());
                    game.reset(startingFenPosition);
                    game.setTime(baseTime, inc);
                    game.setSkillLevel(skill);
                    game.setPlayerColor($('#color-white').hasClass('active') ? 'white' : 'black');
                    game.setDisplayScore($('#showScore').is(':checked'));
                    game.start();
               },
               newEngineGame();
          }
          else
          {
               addToQueue(userName, gameType, timeControl);
               waitForQueue(userName);
               //newGame(startingFenPosition, 'w');
          }
     }

     function prepareGame(activeGameObject)
     {
          gameID = activeGameObject.GameID;
          white = activeGameObject.White;
          black = activeGameObject.Black;
          whiteTimeRemaining = activeGameObject.WhiteTimeRemaining;
          blackTimeRemaining = activeGameObject.BlackTimeRemaining;
          timeControl = activeGameObject.TimeControl;
          gameType = activeGameObject.GameType;
          $("#currentPlayer").text(userName);
          if(white===userName)
          {
               color = "w";
               $("#opponent").text(black);
               $("#time1").text(whiteTimeRemaining);
               $("#time2").text(blackTimeRemaining);
               newGame(startingFenPosition, 'w');
          }
          else
          {
               color = "b";
               $("#opponent").text(white);
               $("#time1").text(blackTimeRemaining);
               $("#time2").text(whiteTimeRemaining);
               newGame(startingFenPosition, 'b');
               flipBoard();
          }
     }
}


