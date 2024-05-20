window.onscroll = function() {scrollFunction()};

function scrollFunction()
{
	if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10)
	{
		document.getElementById("navbar").style.backgroundColor = "#a3f7bf";
		document.querySelector(".site-logo #logo").style.display = "none";
		document.querySelector(".site-logo #logo-text").style.fontSize = "1.5rem";
		document.querySelector(".site-logo #logo-text").style.marginLeft = "20px";
		document.querySelector(".site-logo #logo-text").style.transition = "1s";
		x = document.querySelectorAll("#navbar-right a")
		var i;
		for ( i = 0 ; i < x.length ; i++ )
		{
			x[i].style.paddings = "4px";
			x[i].style.fontSize = "16px";
			x[i].style.lineHeight = "10px";
			x[i].style.transition = "1s";
		}
	}
	else
	{
		document.getElementById("navbar").style.backgroundColor = "#e9e4f0";
		document.querySelector(".site-logo #logo").style.display = "block";
		document.querySelector(".site-logo #logo-text").style.fontSize = "2rem";
		document.querySelector(".site-logo #logo-text").style.transition = "1s";
		x = document.querySelectorAll("#navbar-right a")
		var i;
		for ( i = 0 ; i < x.length ; i++ )
		{
			x[i].style.paddings = "12px";
			x[i].style.fontSize = "18px";
			x[i].style.lineHeight = "25px";
			x[i].style.transition = "1s";
		}
	}
}