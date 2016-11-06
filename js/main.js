// start js if DOMContentLoaded
document.addEventListener("DOMContentLoaded", function(event) { 

	// definition of elements position
	var wrap_slider = document.querySelector(".wrap_slider");
	var sidebar = document.querySelector(".sidebar");
	var sidebar_navi = document.querySelector(".sidebar_navi");
	var tooltip = document.querySelector(".tooltip");
	redefineElementsPos();

	function redefineElementsPos()
	{
		wrap_slider.style.marginLeft = ((window.innerWidth - 600) / 2) + "px";
		tooltip.style.marginRight = (sidebar.offsetWidth - tooltip.offsetWidth) / 2 + "px";
		tooltip.style.marginTop = ((sidebar.offsetHeight - sidebar_navi.offsetHeight) - 200) / 2 + "px";
		sidebar_navi.style.marginLeft = ((sidebar.offsetWidth - sidebar_navi.offsetWidth) / 2) + "px";

	}

	// if window size changed - redefine elements position
	window.addEventListener("resize", redefineElementsPos);

	// pointer and tooltip code (duck and chicken)
	var pointer = document.querySelector(".pointer");
	var cb = document.getElementsByClassName("content_button");
	
	var tooltip_text = document.querySelector(".tooltip_text");
	var content = document.querySelector(".content");
	
	
	var i;
	for ( i=0 ; i<cb.length; i++ ) {
		cb[i].addEventListener("mouseover", pointerJump);
		cb[i].addEventListener("mouseleave", function()
		{
		  if (timeoutId) 
		  	{
		  		clearTimeout(timeoutId); timeoutId = null; 
		  	} 
		});
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
		tooltip.style.opacity = "1";
		changeTooltipText(event.currentTarget.getAttribute("data-section"));
	}

	function changeTooltipText(section) {
		tooltip_text.innerHTML = "";
		i = 0;
		if (section == "wordpress") { animate("Шаблон wordpress"); }
		else if (section == "todo") { animate("Привет как дела у меня хорошо все нормально а у тебя а  у меня плохо а че так да денег нет жрать нечего"); }
	}

	var animId;
	var timeoutId;
	function animate(text) 
	{
			if (!timeoutId)
			{
				timeoutId = setTimeout(function()
				{
					timeoutId = null;
					clearInterval(animId);
					animId = setInterval(function(){
					if (i<text.length)
					{
						tooltip_text.innerHTML = tooltip_text.innerHTML + text[i];
						i++
					}
					else clearInterval(animId);
					}, 15);
				}, 1000);
			}
			
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
	
	// side_bar
	var side_btn = document.querySelectorAll(".sidebar_navi_btn");
	var c_brace = document.querySelectorAll(".curly_brace");
	// crazy code here
	for (i=0; i<side_btn.length; i++)
	{
		side_btn[i].addEventListener("mouseover", showDot);
		side_btn[i].addEventListener("mouseout", hideDot);
	}

	function showDot(event)
	{
		var c = event.currentTarget.childNodes[1];
		c.innerHTML = "..";
	}
	
	function hideDot(event)
	{
		var h = event.currentTarget.childNodes[1];
		h.innerHTML = "}";
	}

});
