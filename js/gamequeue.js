var gameQueue
{
    function addToQueue(userName, gameType, gameMode, timeControl)
    {
        var parameterNames = ["action", "userName", "gameType", "gameMode", "timeControl"];
        var parameterValues = [ADDUSERTOQUEUE, userName, gameType, gameMode, timeControl];
        var queryString = getQueryString(parameterNames, parameterValues);
        xmlhttp=new XMLHttpRequest();
        xmlhttp.open("POST","./php/GameQueue.php?"+queryString,true);
        xmlhttp.send();
    }
}