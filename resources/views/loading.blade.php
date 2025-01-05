<style>
  /* Overlay untuk loading screen */
  #loading-screen {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.15);
    position: fixed;
    inset: 0;
    z-index: 50;
  }

  /* Gaya untuk loader (animasi bola berputar) */
  .loader {
    display: flex;
    justify-content: center;
    /* Tambahkan ini untuk memusatkan */
    align-items: center;
    width: 100%;
    height: 64px;
  }

  .loader div {
    width: 16px;
    height: 16px;
    margin: 0 8px;
    /* Tambahkan margin untuk memberi jarak antar bola */
    border-radius: 50%;
    background: linear-gradient(to right, #D10A3C, #FF0038);
    animation: loader-animation 1.2s linear infinite;
  }

  .loader div:nth-child(1) {
    animation-delay: -0.45s;
  }

  .loader div:nth-child(2) {
    animation-delay: -0.3s;
  }

  .loader div:nth-child(3) {
    animation-delay: -0.15s;
  }

  /* Animasi bola */
  @keyframes loader-animation {

    0%,
    80%,
    100% {
      transform: scale(0);
    }

    40% {
      transform: scale(1);
    }
  }

  /* Teks pesan */
  #loading-screen p {
    color: black;
    font-size: 18px;
    font-weight: bold;
    margin-top: 15px;
    text-align: center;
  }
</style>

<div id="loading-screen" class="fixed inset-0 bg-black bg-opacity-15 z-50 flex items-center justify-center">
  <div class="text-center">
    <!-- Loader Animasi -->
    <div class="loader">
      <div></div>
      <div></div>
      <div></div>
    </div>
    <!-- Pesan Teks -->
    <!-- <p class="text-black text-lg bg-opacity-70 font-semibold bg-white rounded-xl p-2 mx-4 sm:mx-6 md:mx-8">
    Mohon bersabar ya, halaman sedang memuat...
</p> -->
  </div>
</div>

<script>
  window.addEventListener("load", function () {
    const loadingScreen = document.getElementById("loading-screen");
    loadingScreen.style.transition = "opacity 0.5s ease";
    loadingScreen.style.opacity = "0";

    setTimeout(() => {
      loadingScreen.style.display = "none";
    }, 500); // Waktu transisi
  });
</script>