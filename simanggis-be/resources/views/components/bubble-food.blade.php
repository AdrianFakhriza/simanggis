<style>
.bubble-food {
  position: absolute;
  bottom: -30px;
  animation: rise 12s linear infinite;
  opacity: 0.85;
}
@keyframes rise {
  0% {
    transform: translateY(0) scale(0.7) rotate(0deg);
    opacity: 0;
  }
  80% {
    opacity: 1;
  }
  100% {
    transform: translateY(-70vh) scale(1.1) rotate(360deg);
    opacity: 0;
  }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const foodImages = [
    '🍎', '🍌', '🍚', '🍗', '🍞', '🥦', '🍊', '🥚', '🥕', '🍉', '🍇', '🍓', '🥛', '🧀', '🍠', '🍤', '🍔', '🍕', '🍜', '🍩'
  ];
  const section = document.querySelector('section.relative');
  for (let i = 0; i < 18; i++) {
    const bubble = document.createElement('div');
    bubble.className = 'bubble-food pointer-events-none select-none';
    bubble.style.left = Math.random() * 95 + '%';
    bubble.style.fontSize = (Math.random() * 2.5 + 2) + 'rem';
    bubble.style.animationDuration = (Math.random() * 6 + 8) + 's';
    bubble.style.animationDelay = (Math.random() * 8) + 's';
    bubble.innerText = foodImages[Math.floor(Math.random() * foodImages.length)];
    section.appendChild(bubble);
  }
});
</script>
