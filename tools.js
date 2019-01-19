function remove()
{
    var str = document.getElementById('phone').value;
    var regex = /^[0-9 \+\(\)x]$/;
    if(!regex.test(str))
    {
        var telephone = document.getElementById('phone').value.replace(/[^0-9\+\(\)x ]/g, "");
        document.getElementById('phone').value = telephone;
    }
}

function nanpCheck()
{
     var str = document.getElementById('phone').value;
    var regex = /^(\+1[ ]?)?\(?[2-9]{1}\d{2}\)?[ ]?[2-9]{1}\d{2}[ ]?\d{4}[ ]?(x{1}\d{1,5})?$/;
    if(regex.test(str))
    {
        document.getElementById("nanp").style.display="inline-block";
    }
    else
    {
        document.getElementById("nanp").style.display="none";
    }
}

function remember()
{
     if (typeof(Storage) !== 'undefined')
    {
        if(document.getElementById('rememberMe').checked)
        {
            window.localStorage.setItem("name", document.getElementById("name").value);
            window.localStorage.setItem("phone", document.getElementById("phone").value);
            window.localStorage.setItem("email", document.getElementById("email").value);
            window.localStorage.setItem("address", document.getElementById("address").value);
            window.localStorage.setItem("remember", "true");
        }
        else
        {
            window.localStorage.clear();
            window.localStorage.setItem("remember", "false");
        }
    }
    else
    {
        alert('Sorry, localStorage not supported.');
    }
}

function prefill()
{
    if (typeof(Storage) !== 'undefined')
    {
        if (window.localStorage.getItem("remember") == "true")
        {
            document.getElementById("name").value = window.localStorage.getItem("name");
            document.getElementById("phone").value = window.localStorage.getItem("phone");
            document.getElementById("email").value = window.localStorage.getItem("email");
            document.getElementById("address").value = window.localStorage.getItem("address");
            document.getElementById("rememberMe").checked = "checked";
        }
    }
    else
    {
        alert('Sorry, localStorage not supported.');
    }
}