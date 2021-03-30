const checkpoint = 300;
 var position = 0;
window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset;
  if (currentScroll <= checkpoint) {
    opacity = 1 - currentScroll / checkpoint;
  } else {
    opacity = 0;
  }
  document.getElementById("downarrow").style.opacity = opacity;
});




// loadmore - START

offset_defaut = 0;

function loadmore(offset){
  var xhr = new XMLHttpRequest;
  xhr.open("GET","products.php?offset=" + offset);
  
  xhr.onload = function(){
    if(this.status = 200){
      document.getElementById('realcontent').innerHTML += xhr.response;
      if(xhr.response == ""){
        document.getElementById('showmore').style.display = "none";
      }
    }
  }

  xhr.send();
}

loadmore(offset_defaut);

document.getElementById('showmore').addEventListener("click",function(){
  offset_defaut += 3;
  loadmore(offset_defaut);
})

// loadmore - END


// login
document.getElementById("loginbutton").addEventListener("click",function(){
  document.getElementById("overlay").style.display = "flex";
  document.getElementById("signup").style.display = "none";
  document.getElementById("login").style.display = "flex";
})


var closeForm = document.querySelectorAll(".closeForm");
closeForm.forEach(item => item.addEventListener("click",function(){
  document.getElementById("overlay").style.display = "none";
}));
 


document.getElementById("signuplink").addEventListener("click",function(){
  document.getElementById("login").style.display = "none";
  document.getElementById("signup").style.display = "flex";
})

document.getElementById("loginlink").addEventListener("click",function(){
  document.getElementById("login").style.display = "flex";
  document.getElementById("signup").style.display = "none";
})