const animation = lottie.loadAnimation({
  container: document.getElementById("animation-container"),
  renderer: "svg",
  path: "js/animation.json",
  autoplay: true,
  loop: true,
});
animation.setSpeed(0.7);

