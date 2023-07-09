const carousel = document.querySelector('.carousel');

carousel.addEventListener('animationiteration', () => {
  const firstItem = document.querySelector('.carousel-items');
  carousel.appendChild(firstItem);
});
