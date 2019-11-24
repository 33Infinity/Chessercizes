var register
{
    function initialize()
    {
        handleEvents();
    }
    
    function handleEvents()
    {
        $("#btnRegister").click(function(){
           newRegistration();
        });
    }
    
    function newRegistration()
    {
        var firstName = $("#inputFirstName").val();
        var lastName = $("#inputLastName").val();
        var userName = $("#inputUsername").val();
        var email = $("#inputEmail").val();
        var password = $("#inputPassword").val();
        var confirmPassword = $("#inputConfirmPassword").val();
        if(password !== confirmPassword)
        {
            customMessage(PASSWORDSDONOTMATCH);
            return false;
        }
        else
        {
            var parameterNames = ["firstName", "lastName", "userName", "email", "password"];
            var parameterValues = [firstName, lastName, userName, email, password];
            var queryString = getQueryString(parameterNames, parameterValues);
            
            xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState===4 && xmlhttp.status===200)
                {
                    //var response = xmlhttp.responseText;
                    var response = JSON.parse(this.responseText);
                    if(response.ErrorMessage !== null)
                    {
                        customMessage(response.ErrorMessage);
                    }
                    else
                    {
                        customMessage(response.Message);
                        window.location.href = './login.html';
                    }
                }
            };
            xmlhttp.open("GET","./php/Register.php?"+queryString,true);
            xmlhttp.send();
        }
    }
    
    function customMessage(message)
    {
        bootbox.alert(message);
    }
}


