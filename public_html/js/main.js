// and before we define vars
var link;
var bar;
// var menu;
// var state;
var txt;
var bs;
var tt; 
//
var bigimage
var tooltip;
document.addEventListener("DOMContentLoaded", function(event)
{
	// menu vars
	link = document.querySelectorAll(".link");
	for (i=0; i<link.length; i++)
	{
		link[i].addEventListener("mouseover", tooltipOn);
		link[i].addEventListener("mouseleave", tooltipOff);
	}
	
	// menu = document.querySelector("#menu");
	// state = "closed";
	tooltip = document.querySelectorAll(".tooltip");
	bar = document.querySelector(".bar");

	// text vars
	txt = document.querySelector(".text");
	bs = document.querySelector(".back_shadow");
	tt = document.querySelector(".text_trigger");

	// image var
	bigimage = document.getElementById("big_image");
});
// first define stop/play button
function play()
	{
		var video = document.querySelector("#video");
		var button = document.querySelector("#pause");
		if (video.paused)
		{
			button.classList.remove("fa-play");
			button.classList.add("fa-pause");
			video.play();
		}
		else
		{
			button.classList.remove("fa-pause");
			button.classList.add("fa-play");
			video.pause();
		}
	}

// function toggle_bar()
// {
// 	if (state == "closed")
// 	{
// 		for (i=0; i<link.length; i++)
// 		{
// 			link[i].style.visibility = "visible";
// 			link[i].style.opacity = "1";
// 		}
// 		menu.style.color = "red";
// 		state = "opened";
// 	}
// 	else if (state == "opened")
// 	{
// 		for (i=0; i<link.length; i++)
// 		{
// 			link[i].style.visibility = "hidden";
// 			link[i].style.opacity = "0";
// 		}
// 		menu.style.color = "#DDDDDD";
// 		state = "closed";
// 	}
// }



function showText()
{
	txt.style.opacity = 1;
	bs.style.opacity = 0.6;
	bs.style.visibility = "visible";
	tt.style.opacity = "0.2";
}

function closeText()
{
	txt.style.opacity = 0;	
	bs.style.opacity = 0;
	bs.style.visibility = "hidden";
	tt.style.opacity = "1";
}

function tooltipOn(event)
{
	tooltip = event.currentTarget.nextElementSibling;
	tooltip.style.opacity = "1";
	tooltip.style.left = "-2.5em";
}

function tooltipOff(event)
{
	tooltip = event.currentTarget.nextElementSibling;
	tooltip.style.opacity = "0";
	tooltip.style.left = "-5em";
}

function showBigImage()
{
	bigimage.style.top = "0px";		
}

function closeBigImage()
{
	bigimage.style.top = "-9999px";
}