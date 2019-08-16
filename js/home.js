var board;
function load()
{
    initialize();
    //handleEvents();
}

function initialize()
{
    $.Chessboard = $("#board");
    /*cfg = {
        draggable: true,
        position: 'start',
        sparePieces: false,
        onDrop: onDrop
    };*/
    
    /*this.onDragStart = function(source, piece, position, orientation) {
        console.log("Drag started:");
        console.log("Source: " + source);
        console.log("Piece: " + piece);
        console.log("Position: " + ChessBoard.objToFen(position));
        console.log("Orientation: " + orientation);
        console.log("--------------------");
    };*/
    
}

function handleEvents()
{
    $("#decreaseBoardSize").click(function() {
        var width = $.Chessboard.width();
        $.Chessboard.width(width-25);
        //board = ChessBoard('board', cfg);
        //board.start();
    });
    $("#increaseBoardSize").click(function() {
        var width = $.Chessboard.width();
        $.Chessboard.width(width+25);
        //board = ChessBoard('board', cfg);
        //board.start();
    });
}

function customMessage(message)
{
    bootbox.alert(message);
}