// start js if DOMContentLoaded
document.addEventListener("DOMContentLoaded", function(event) { 

	// pointer and tooltip code (duck and chicken)
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

	// slider code
	// first bind first and latest sliders
	var panels = document.getElementsByClassName("slider_panel");
	if (panels.length>0) {
		panels[0].setAttribute("data-first","true"); 
		panels[panels.length-1].setAttribute("data-latest","true");
		panels[0].classList.add("active_panel");
	}
	// next define listeners for control buttons
	var slider = document.querySelector(".slider");
	var scl = document.querySelector(".slider_controls_left");
	var scr = document.querySelector(".slider_controls_right");
	var wrap_slider = document.querySelector(".wrap_slider");
	slider.style.left = "0px";
	slider.style.width = "" + (panels.length*600) + "px";
	scl.addEventListener("click", moveRight);
	scr.addEventListener("click", moveLeft);

	function moveLeft(event) {
		var active_panel = document.querySelector(".active_panel");
		if (active_panel.hasAttribute("data-latest")) {
			slider.style.left = "0px"
			active_panel.classList.remove("active_panel");
			panels[0].classList.add("active_panel");
		}
		else {
			slider.style.left = "" + (parseInt(slider.style.left) - 600) + "px";
			active_panel.nextElementSibling.classList.add("active_panel");
			active_panel.classList.remove("active_panel");
		}
	}

	function moveRight(event) {
		var active_panel = document.querySelector(".active_panel");
		if (active_panel.hasAttribute("data-first")) {
			slider.style.left = "-" + ((panels.length-1)*600) + "px";
			panels[panels.length-1].classList.add("active_panel");
			active_panel.classList.remove("active_panel");
		}
		else {
			slider.style.left = "" + (parseInt(slider.style.left) + 600) + "px";
			active_panel.previousElementSibling.classList.add("active_panel");	
			
			active_panel.classList.remove("active_panel");
		}
	}

	// timer for slider 
	var timerId;
	mouseOutSlider();
	// stop/start timer on mouse hover/out AND(!!) hide/show control buttons
	wrap_slider.addEventListener("mouseover",mouseOnSlider);
	wrap_slider.addEventListener("mouseleave",mouseOutSlider);

	function mouseOutSlider() { 
		timerId = setTimeout(function tick() {
			moveLeft();
			timerId = setTimeout(tick, 7000);
		}, 7000);
		scl.style.opacity = 0;
		scr.style.opacity = 0;
	}

	function mouseOnSlider() { 
		clearInterval(timerId);
		scl.style.opacity = 1;
		scr.style.opacity = 1;
	}
	
});
