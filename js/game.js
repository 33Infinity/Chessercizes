var game 
{
     var game;
     var wait_for_script;
     var newEngineGame = function () { };
     function initializeGame() 
     {
          load();
          var gameType = getParameterByName(GAMETYPEPARAMETER, window.location.href);
          var gameMode = getParameterByName(GAMEMODEPARAMETER, window.location.href);
          var timeControl = getParameterByName(TIMECONTROLPARAMETER, window.location.href);
          var userName = getParameterByName(USERNAMEPARAMETER, window.location.href);
          var startingFenPosition = getStartingFenPosition(gameType);
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
               addToQueue(userName, gameType, gameMode, timeControl);
               newGame(startingFenPosition, 'w');
          }
     }

     function waitForQueue()
     {
          
     }
}


