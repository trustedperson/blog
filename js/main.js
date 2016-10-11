document.addEventListener("DOMContentLoaded", function(event) { 
	var sword = document.querySelector(".pointer");
	var pb = document.getElementsByClassName("point_button");
	var i;
	for ( i=0 ; i<pb.length; i++ ) {
		pb[i].addEventListener("mouseover", swordJump);
	}
	
	function swordJump(event) {

		x = event.currentTarget.getBoundingClientRect().top;
		y = event.currentTarget.getBoundingClientRect().left;
		sword.style.top = "" + (x + 10) + "px";
		sword.style.left = "" + (y - 100) + "px";

	}

});