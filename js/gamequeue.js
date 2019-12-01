var gameQueue
{
    var interval;
    function addToQueue(userName, gameType, gameMode, timeControl)
    {
        var parameterNames = ["action", "userName", "gameType", "gameMode", "timeControl"];
        var parameterValues = [ADDUSERTOQUEUE, userName, gameType, gameMode, timeControl];
        var queryString = getQueryString(parameterNames, parameterValues);
        xmlhttp=new XMLHttpRequest();
        xmlhttp.open("POST","./php/GameQueue.php?"+queryString,true);
        xmlhttp.send();
    }

    function waitForQueue(userName)
    {
        interval = setInterval(function(){ return getOpponent(userName); }, 5000);
    }

    function getOpponent(userName)
    {
        //alert("Searching for opponent");
        var parameterNames = ["action", "userName"];
        var parameterValues = [FINDOPPONENT, userName];
        var queryString = getQueryString(parameterNames, parameterValues);
        xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState===4 && xmlhttp.status===200)
            {
                var response = JSON.parse(this.responseText);
                if(response.ErrorMessage !== null)
                {
                    //alert(response.ErrorMessage);
                }
                else if(response.Message !== null)
                {
                    //alert(response.Message);
                }
                else
                {
                    clearInterval(interval);
                    alert(response.Opponent);
                }
            }
        };
        xmlhttp.open("GET","./php/GameQueue.php?"+queryString,true);
        xmlhttp.send();
    }
}