// loadmore - START

offset_defaut = 0;

function loadmore(offset){
  var xhr = new XMLHttpRequest;
  xhr.open("GET","products.php?offsetadmin=" + offset);
  
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