(function(){

	var top, con, dj, loc, fly, spo;
	var height;

	window.requestAnimFrame = (function(){
	  return  window.requestAnimationFrame       ||
	          window.webkitRequestAnimationFrame ||
	          window.mozRequestAnimationFrame    ||
	          function( callback ){
	            window.setTimeout(callback, 1000 / 60);
	          };
	})();

	function init() {
		top = document.querySelector('#glowmotion');
		top.addEventListener("click",runScrollTop,false);

		con = document.querySelector('#con');
		con.addEventListener("click",runScrollCon,false);

		dj = document.querySelector('#d-j');
		dj.addEventListener("click",runScrollDj,false);

		loc = document.querySelector('#loc');
		loc.addEventListener("click",runScrollLoc,false);

		fly = document.querySelector('#fly');
		fly.addEventListener("click",runScrollFly,false);

		spo = document.querySelector('#spo');
		spo.addEventListener("click",runScrollSpo,false);
	}

	function runScrollTop() {
  		height = 0;
		scrollToY(0, 1500, 'easeInOutQuint');
	}
	function runScrollCon() {
  		height = 1000;
		scrollToY(1000, 1500, 'easeInOutQuint');
	}
	function runScrollDj() {
  		height = 1830;
		scrollToY(1830, 1500, 'easeInOutQuint');
	}
	function runScrollLoc() {
  		height = 2730;
		scrollToY(2730, 1500, 'easeInOutQuint');
	}
	function runScrollFly() {
  		height = 3665;
		scrollToY(3665, 1500, 'easeInOutQuint');
	}
	function runScrollSpo() {
  		height = 4585;
		scrollToY(4585, 1500, 'easeInOutQuint');
	}

	
	// first add raf shim
	// http://www.paulirish.com/2011/requestanimationframe-for-smart-animating/
	window.requestAnimFrame = (function(){
	  return  window.requestAnimationFrame       ||
	          window.webkitRequestAnimationFrame ||
	          window.mozRequestAnimationFrame    ||
	          function( callback ){
	            window.setTimeout(callback, 1000 / 60);
	          };
	})();

	// main function
	function scrollToY(scrollTargetY, speed, easing) {
	    // scrollTargetY: the target scrollY property of the window
	    // speed: time in pixels per second
	    // easing: easing equation to use

	    var scrollY = window.scrollY,
	        scrollTargetY = scrollTargetY || 0,
	        speed = speed || 2000,
	        easing = easing || 'easeOutSine',
	        currentTime = 0;

	    // min time .1, max time .8 seconds
	    var time = Math.max(.1, Math.min(Math.abs(scrollY - scrollTargetY) / speed, .8));

	    // easing equations from https://github.com/danro/easing-js/blob/master/easing.js
	    var PI_D2 = Math.PI / 2,
	        easingEquations = {
	            easeOutSine: function (pos) {
	                return Math.sin(pos * (Math.PI / 2));
	            },
	            easeInOutSine: function (pos) {
	                return (-0.5 * (Math.cos(Math.PI * pos) - 1));
	            },
	            easeInOutQuint: function (pos) {
	                if ((pos /= 0.5) < 1) {
	                    return 0.5 * Math.pow(pos, 5);
	                }
	                return 0.5 * (Math.pow((pos - 2), 5) + 2);
	            }
	        };

	    // add animation loop
	    function tick() {
	        currentTime += 1 / 60;

	        var p = currentTime / time;
	        var t = easingEquations[easing](p);

	        if (p < 1) {
	            requestAnimFrame(tick);

	            window.scrollTo(0, scrollY + ((scrollTargetY - scrollY) * t));
	        } else {
	            console.log('scroll done');
	            window.scrollTo(0, scrollTargetY);
	        }
	    }

	    // call it once to get started
	   tick();
	}

init();
})();