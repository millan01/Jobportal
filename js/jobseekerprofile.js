const openOverlayLinks = document.querySelectorAll('.openOverlay');
const closeOverlayBtn = document.getElementById('closeOverlayBtn');
const overlay = document.getElementById('overlay');
const iframe = document.getElementById('iframe');

openOverlayLinks.forEach(function(link) {
  link.addEventListener('click', function(event) {
    event.preventDefault();
    overlay.style.display = 'flex';
    iframe.src = this.href;
  });
});

closeOverlayBtn.addEventListener('click', function() {
  overlay.style.display = 'none';
  iframe.src = '';
});
