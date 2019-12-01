var dashboard
{
    var loggedInUser = "";
    function initialize()
    {
        handleEvents();
        getLoggedInUser(setLoggedInUser);
    }

    function handleEvents()
    {
        $("#classicPVE").click(function()
        {
            window.location.href = "./game.html?gt=classic&gm=pve&tc=quick&un=" + loggedInUser;
        });

        $("#classicPVP").click(function()
        {
            window.location.href = "./game.html?gt=classic&gm=pvp&tc=quick&un=" + loggedInUser;
        });
    }

    function setLoggedInUser(userName)
    {
        loggedInUser = userName;
        $("#loggedInUser").html(userName);
    }
}