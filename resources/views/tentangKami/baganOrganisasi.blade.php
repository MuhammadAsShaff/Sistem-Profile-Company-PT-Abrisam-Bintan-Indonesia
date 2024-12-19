<script src="https://balkan.app/js/OrgChart.js"></script>
<div class="container mx-auto p-6 bg-gray-50 rounded-lg bg-white mb-[-42]">
  <h1 class="text-3xl font-bold text-gray-800 text-left font-telkomsel">Bagan Perusahaan</h1>
  <p class=" text-justify md:text-left">Kami membangun tim sales force yang unggul melalui pengembangan individu dan kolaborasi, fokus pada
    identifikasi peluang
    pasar, pemenuhan kebutuhan pelanggan, dan pencapaian target penjualan. Dengan komitmen pada inovasi, kualitas, dan
    keunggulan layanan, kami bertekad menjadi mitra terpercaya dan pemimpin industri.</p>
</div>

<div id="tree" class="overflow-x-auto"> <!-- Tambahkan overflow-x-auto untuk scroll horizontal -->
  <style>
    /* Tambahkan CSS untuk responsivitas */
    @media (max-width: 768px) {
      #tree {
        transform: scale(0.8); /* Mengurangi ukuran bagan untuk tampilan mobile */
        transform-origin: top left; /* Mengatur titik asal transformasi */
      }
    }
  </style>
</div>

<script>
  // Inisialisasi OrgChart dengan node yang sudah dikustomisasi
  var chart = new OrgChart(document.getElementById("tree"), {
    mouseScrool: OrgChart.action.none,
    layout: OrgChart.layout.tree, // Coba layout "tree" untuk memperbaiki tampilan
    scaleInitial: 0.75,
    enableSearch: false,
    template: "ana",
    nodeBinding: {
      field_0: "name",
      field_1: "title",
      img_0: "img"
    },
    nodeMenu: null,
    menu: null,
    enableDragDrop: false,
    nodeCircleMenu: null,
    onClick: function (sender, args) { args.cancel = true; },

    nodes: {!! $nodes !!}
  });

  // Menambahkan listener klik global untuk mencegah munculnya pop-up interaktif
  document.getElementById("tree").addEventListener("click", function (event) {
    event.stopPropagation();
  }, true);
</script>