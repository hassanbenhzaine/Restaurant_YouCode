// loadmore - START

offset_default = 0;

function loadmore(offset){
  var xhr = new XMLHttpRequest;
  xhr.open("GET","products.php?offset=" + offset);
  
  xhr.onload = function(){
    if(this.status = 200){
      document.getElementById('realcontent').insertAdjacentHTML('beforeend', xhr.response);
      switch(xhr.response){
        case "":
        document.getElementById('showmore').style.display = "none";
        break;
        case "error":
        document.getElementById('realcontent').innerHTML = '<p class="error">Error could not load products</p>';
        break;
      }
    }
  }

  xhr.send();
}

loadmore(offset_default);

document.getElementById('showmore').addEventListener("click",function(){
  offset_default += 3;
  loadmore(offset_default);
})

// loadmore - END