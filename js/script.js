 var m = document.querySelector("main-content"), 
 h = document.querySelector("navbar"),
  hHeight; 
  function setTopPadding() { 
  	hHeight = h.offsetHeight; 
  	m.style.paddingTop = hHeight + "px"; 
  }

function onScroll() {
 window.addEventListener("scroll", callbackFunc); 
 function callbackFunc() { 
 	var y = window.pageYOffset; 
 	if (y > 150) { h.classList.add("scroll"); 
 	} 
 	else {
  		h.classList.remove("scroll"); 
		} 
 } 
}
 window.onload = function() { 
 	setTopPadding(); onScroll(); 
 }; 
 window.onresize = function() { 
 	setTopPadding(); 
 };
