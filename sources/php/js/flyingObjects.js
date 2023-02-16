const imageContainer = document.getElementById('flyingImages');
const images = imageContainer.querySelectorAll('img');
const containerWidth = imageContainer.offsetWidth;
const containerHeight = imageContainer.offsetHeight;
let translateX;
let translateY;

function selectRandomImage() {
  const randomIndex = Math.floor(Math.random() * images.length);
  const selectedImage = images[randomIndex];
  selectedImage.style.display = 'block';

  let startX = Math.round(Math.random() * containerWidth);
  let startY = Math.round(Math.random() * containerWidth);
  startY = (startY < 115) ? 115 : startY;

  do {
    translateX = Math.random() * containerWidth;
    translateY = Math.random() * containerWidth;
  } while ((Math.abs(translateX - startX) < 100) || (Math.abs(translateY - startY) < 100))

  translateY = (translateY < 115) ? 115 : translateY;

  selectedImage.animate([
    { transform: 'translate(' + startX + 'px, ' + startY + 'px) rotate(0deg)' },
    { transform: 'translate(' + Math.round(translateX) + 'px, ' + Math.round(translateY) + 'px) rotate(360deg)' }
  ], {
    duration: 3000,
    fill: 'forwards',
    easing: 'linear'
  });
}

function resetImages() {
  images.forEach(image => {
    image.style.display = 'none';
  });
}

selectRandomImage();
setInterval(() => {
  resetImages();
  selectRandomImage();
}, 3000);