var game 
{
    var game;
    var wait_for_script;
    var newGame = function () { };
    function initializeGame() {
        load();
        var gameType = getParameterByName(GAMETYPEPARAMETER, window.location.href);
        var startingFenPosition = getStartingFenPosition(gameType);
        game = engineGame(null);
        newGame = function newGame() {
             var baseTime = parseFloat($('#timeBase').val()) * 60;
             var inc = parseFloat($('#timeInc').val());
             var skill = parseInt($('#skillLevel').val());
             game.reset(startingFenPosition);
             game.setTime(baseTime, inc);
             game.setSkillLevel(skill);
             game.setPlayerColor($('#color-white').hasClass('active') ? 'white' : 'black');
             game.setDisplayScore($('#showScore').is(':checked'));
             game.start();
             //game.setFen("8/pppppppp/8/8/8/8/PPPPPPPP/8 w KQkq -");
             var fen = game.getFen();
             
        },
        newGame();
   }
}


