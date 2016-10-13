document.addEventListener("DOMContentLoaded", function(event) { 
	var pointer = document.querySelector(".pointer");
	var cb = document.getElementsByClassName("content_button");
	var tooltip = document.querySelector(".tooltip");
	var tooltip_text = document.querySelector(".tooltip_text");
	var content = document.querySelector(".content");
	var i;
	for ( i=0 ; i<cb.length; i++ ) {
		cb[i].addEventListener("mouseover", pointerJump);
	}
	tooltip.top = content.getBoundingClientRect().top;
				

function pointerJump(event) {

		t = event.currentTarget.getBoundingClientRect().top;
		l = event.currentTarget.getBoundingClientRect().left;
		r = event.currentTarget.getBoundingClientRect().right;
		b = event.currentTarget.getBoundingClientRect().bottom;
		cr = content.getBoundingClientRect().right;
		pointer.style.top = "" + (t + 0) + "px";
		pointer.style.left = "" + (l - 100) + "px";
		tooltip.style.left = "" + (cr) + "px";
		tooltip.style.transform = "scale(1,1)";
		changeTooltipText(event.currentTarget.getAttribute("data-section"));
	}

function changeTooltipText(section) {
	if (section == "wordpress") {tooltip_text.innerHTML = "Скачанные шаблоны wordpress"}
	else if (section == "todo") {tooltip_text.innerHTML = "Простой todo сервис"}
	else tooltip_text.innerHTML = "";
}


});
