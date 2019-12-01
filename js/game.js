var game 
{
     var game;
     var wait_for_script;
     var gameType;
     var gameMode;
     var timeControl;
     var userName;
     var startingFenPosition;
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

     function prepareGame()
     {
          alert(userName);
          alert(gameType);
          alert(timeControl);
     }
}


