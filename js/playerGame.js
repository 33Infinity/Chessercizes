var playerGame 
{
    var board = null;
    var game = null; 
    var playerColor = null;
    function newGame(fen, color)
    {
        game = new Chess();
        playerColor = color;
        var cfg = {
            draggable: true,
            position: fen,
            onDragStart: onDragStart,
            onDrop: onDrop,
            onSnapEnd: onSnapEnd
        }
    
        board = new ChessBoard('board', cfg);
    }

    function flipBoard()
    {
        board.flip();
    }

    function onDragStart(source, piece, position, orientation)
    {
        if (game.game_over()) return false;
        if(game.turn()!==playerColor) return false;

        // only pick up pieces for the side to move
        if ((game.turn() === 'w' && piece.search(/^b/) !== -1) ||
            (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
            return false;
        }
    }

    function onDrop(source, target)
    { 
        // see if the move is legal
        var move = game.move({
            from: source,
            to: target,
            promotion: 'q'
        });

        // illegal move
        if (move === null) return 'snapback';
    }

    function onSnapEnd()
    {
        /*board.move('e7-e5');
        var move = game.move({
            from: "e7",
            to: "e5",
            promotion: 'q'
        });*/
    }
}