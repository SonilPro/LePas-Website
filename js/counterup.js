window.addEventListener("scroll", reveal);
function reveal() {
  var reveals = document.querySelectorAll(".count");
  for (var i = 0; i < reveals.length; i++) {
    var windowheight = window.innerHeight;
    var revealtop = reveals[i].getBoundingClientRect().top;
    var revealpoint = 150;
    var number = parseInt(reveals[i].getAttribute("data-number"));
    if (revealtop < windowheight - revealpoint) {
      counter(reveals[i], 0, number, 2000);
      reveals[i].classList.remove("count");
    }
  }
}
function counter(obj, start, end, duration) {
  if (start != end) {
    let current = start,
      range = end - start,
      step = Math.abs(Math.floor(duration / range));
    func();
    function func() {
      current += 1;
      obj.textContent = current;
      if (current != end) {
        setTimeout(func, ((-100 / step) + 1000/(current - end) * -1));
      }
    }
  }
}
