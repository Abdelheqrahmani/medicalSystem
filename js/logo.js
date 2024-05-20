const restart = document.querySelector(".button-restart");
const logoAnimation = anime.timeline({ autoplay: true,delay: 200});

logoAnimation.add({
  targets: '#logo',
  translateY: [-100, 0],
  opacity: [0, 1],
  elasticity: 600,
  duration: 1600
}).add({
  targets: '#logo-hexagon',
  rotate: [-90, 0],
  duration: 1200,
  elasticity: 600,
  offset: 100
}).add({
  targets: '#logo-circle',
  scale: [0, 1],
  duration: 1200,
  elasticity: 600,
  offset: 500
}).add({
  targets: '#logo-mask',
  scale: [0, 1],
  duration: 1000,
  elasticity: 600,
  offset: 550
}).add({
  targets: '#logo-text',
  translateX: ['-100%', 0],
  opacity: [0, 1],
  duration: 1000,
  easing: 'easeOutExpo',
  offset: 1000
})

restart.addEventListener("click", () => logoAnimation.restart());