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





// login

const loginbutton = document.getElementById("loginbutton");

if(loginbutton){
    loginbutton.addEventListener("click",function(){
      document.getElementById("overlay").style.display = "flex";
      document.getElementById("signup").style.display = "none";
      document.getElementById("login").style.display = "flex";
  })
}

const signuplink = document.getElementById("signuplink");

if(signuplink){
  signuplink.addEventListener("click",function(){
    document.getElementById("login").style.display = "none";
    document.getElementById("signup").style.display = "flex";
  })
}

const closeForm = document.querySelectorAll(".closeForm");
closeForm.forEach(item => item.addEventListener("click",function(){
  document.getElementById("overlay").style.display = "none";
}))

const loginlink = document.getElementById("loginlink");

if(loginlink){
  loginlink.addEventListener("click",function(){
    document.getElementById("login").style.display = "flex";
    document.getElementById("signup").style.display = "none";
  })
}
