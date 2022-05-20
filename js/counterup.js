window.addEventListener("scroll", reveal);
    function reveal() {
        var reveals = document.querySelectorAll('.count');
        for (var i = 0; i < reveals.length; i++) {
          var windowheight = window.innerHeight;
          var revealtop = reveals[i].getBoundingClientRect().top;
          var revealpoint = 150;
          var number = parseInt(reveals[i].getAttribute("data-number"));
          if (revealtop < windowheight - revealpoint) {
            counter(reveals[i], 0, number, 1900);
            reveals[i].classList.remove("count");
          }
        }
    }

    function counter(obj, start, end, duration) {
      if(start < end){
        let current = start,
        range = end - start,
        increment = end > start ? 1 : -1,
        step = Math.abs(Math.floor(duration / range)),
        timer = setInterval(() => {
          current += increment;
          obj.textContent = current;
          if (current == end) {
            clearInterval(timer);
          }
        }, step);
      }
    }