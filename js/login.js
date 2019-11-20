function handleLoggedInOutUser()
{
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState===4 && xmlhttp.status===200)
        {
            var response = xmlhttp.responseText;
            if(response==="Y")
            {
                $("#isLoggedInOut").text("Logged In");
                $("#btnAdminManager").prop("disabled",false);
            }
            else
            {
                $("#isLoggedInOut").text("Logged Out");
                $("#btnAdminManager").prop("disabled",true);
            }
        }
    };
    xmlhttp.open("GET","./php/Login.php?action=isLoggedIn&username=''&password=''&admin=''",true);
    xmlhttp.send();
}

function logIn()
{
    var username = $("#txtLoginUsername").val();
    var password = $("#txtLoginPassword").val();
    if(username.length===0)
    {
        customMessage("Username cannot be empty");
        return;
    }
    if(password.length===0)
    {
        customMessage("Password cannot be empty");
        return;
    }
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState===4 && xmlhttp.status===200)
        {
            var response = xmlhttp.responseText;
            customMessage(response);
            if(response==="Successfull login")
            {
                $("#isLoggedInOut").text("Logged In");
                $("#btnAdminManager").prop("disabled",false);
            }
            else
            {
                $("#isLoggedInOut").text("Logged Out");
                $("#btnAdminManager").prop("disabled",true);
            }
        }
    };
    xmlhttp.open("GET","./php/Login.php?action=logIn&username="+username+"&password="+password+"&admin=Y",true);
    xmlhttp.send();
}

function logOut()
{
    
}
