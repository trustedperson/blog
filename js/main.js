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
	// initial code for cut and paste slides
	var slider = document.querySelector(".slider");
	var panels = document.getElementsByClassName("slider_panel");
	if (panels.length>0) {
		panels[0].classList.add("active_panel");
		// set attributes "last" and "first"
		panels[panels.length-1].setAttribute("data-latest","true");
		panels[0].setAttribute("data-first","true"); 
	}
	// next define listeners for control buttons
	var scl = document.querySelector(".slider_controls_left");
	var scr = document.querySelector(".slider_controls_right");
	var wrap_slider = document.querySelector(".wrap_slider");
	
	
	scl.addEventListener("click", moveLeft);
	scr.addEventListener("click", moveRight);

	// fixed width
	slider.style.width = "" + ((panels.length+1)*600) + "px"; 
	// fixed start pos
	slider.style.left = "0px";
	var called = false;

	function moveRight(event) {
		if (called == true) return null;
		called = true;
		var active_panel = document.querySelector(".active_panel");
		// if (active_panel.hasAttribute("data-latest")) {
		
		// 	active_panel.classList.remove("active_panel");
		// 	panels[0].classList.add("active_panel");
		// // }
		if(active_panel.hasAttribute("data-latest")) {
			var cloned = panels[0].cloneNode(true);
			cloned.removeAttribute("data-first");
			slider.appendChild(cloned);
			panels[0].style.width = "0px";
			
			active_panel.removeAttribute("data-latest");
			active_panel.nextElementSibling.setAttribute("data-latest","true");
			active_panel.nextElementSibling.classList.add("active_panel");
			active_panel.classList.remove("active_panel");
			setTimeout(wait, 1000);
			
			// slider.style.left = "" + (parseInt(slider.style.left) - 600) + "px";
		}
		else {
			active_panel.nextElementSibling.classList.add("active_panel");
			active_panel.classList.remove("active_panel");	
			slider.style.left = "" + (parseInt(slider.style.left) - 600) + "px";
		}
		called = false;
	}

	function moveLeft(event) {
		var active_panel = document.querySelector(".active_panel");
		// if (active_panel.hasAttribute("data-firstCLone")) {
		// 	slider.style.left = "-" + ((panels.length-1)*600) + "px";
		// 	panels[panels.length-1].classList.add("active_panel");
		// 	active_panel.classList.remove("active_panel");
		// }
		
		slider.style.left = "" + (parseInt(slider.style.left) + 600) + "px";
		active_panel.previousElementSibling.classList.add("active_panel");	
		
		active_panel.classList.remove("active_panel");
	
	}

	// timer for slider 
	var timerId;
	// mouseOutSlider();
	// stop/start timer on mouse hover/out AND(!!) hide/show control buttons
	// wrap_slider.addEventListener("mouseover",mouseOnSlider);
	// wrap_slider.addEventListener("mouseleave",mouseOutSlider);

	function wait() {
		
		slider.removeChild(panels[0]);
		panels[0].setAttribute("data-first","true");
	}

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
