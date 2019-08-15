function getRating(uscfid)
{
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState===4 && xmlhttp.status===200)
        {
            var response = xmlhttp.responseText;
            alert(response);
        }
    };
    xmlhttp.open("GET","./php/GetRatings.php?uscfid="+uscfid,true);
    xmlhttp.send();
}


