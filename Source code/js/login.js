document.getElementById("submit").addEventListener("click", function(){

    var email = document.getElementById('email').value;
    var pass = document.getElementById('pass').value;
    var staylogged = document.getElementById('staylogged').value;


  
    var login = new XMLHttpRequest;

    login.open("POST","login.php",1);
    login.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    login.onload = function(){
    if(this.status = 200){
        if(login.response == ""){
            window.location = "redirector.php";
        } else{
            document.getElementById('error').innerHTML = login.response;
        }
    }
    }
    login.send("pass=" + pass + "&email=" + email + "&staylogged=" + staylogged);
})
