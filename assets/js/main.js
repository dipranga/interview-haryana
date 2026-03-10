/* Interview haryana — Main JS */
document.addEventListener('DOMContentLoaded', function () {
  // Slider
  var track = document.querySelector('.slider-track');
  if (track) {
    var slides  = track.querySelectorAll('.slide');
    var dots    = document.querySelectorAll('.slider-dot');
    var current = 0, autoPlay;
    function goTo(n) {
      current = (n + slides.length) % slides.length;
      track.style.transform = 'translateX(-' + (current * 100) + '%)';
      dots.forEach(function(d, i) { d.classList.toggle('active', i === current); });
    }
    var prev = document.querySelector('.slider-prev');
    var next = document.querySelector('.slider-next');
    if (prev) prev.addEventListener('click', function() { clearInterval(autoPlay); goTo(current - 1); startAuto(); });
    if (next) next.addEventListener('click', function() { clearInterval(autoPlay); goTo(current + 1); startAuto(); });
    dots.forEach(function(d, i) { d.addEventListener('click', function() { clearInterval(autoPlay); goTo(i); startAuto(); }); });
    function startAuto() { autoPlay = setInterval(function() { goTo(current + 1); }, 5000); }
    startAuto();
  }

  // Hamburger
  var ham = document.querySelector('.hamburger');
  var nav = document.querySelector('.nav-list');
  if (ham && nav) ham.addEventListener('click', function() { nav.classList.toggle('open'); });

  // Scroll to top
  var scrollBtn = document.getElementById('scrollTop');
  if (scrollBtn) {
    window.addEventListener('scroll', function() { scrollBtn.style.display = window.scrollY > 400 ? 'flex' : 'none'; });
    scrollBtn.addEventListener('click', function() { window.scrollTo({ top: 0, behavior: 'smooth' }); });
  }
});
