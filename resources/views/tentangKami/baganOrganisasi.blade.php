<script src="https://balkan.app/js/OrgChart.js"></script>
<div class="container mx-auto p-6 bg-gray-50 rounded-lg bg-white mb-[-42]">
  <h1 class="text-3xl font-bold text-gray-800 text-left ml-6 font-telkomsel">Bagan Perusahaan</h1>
  <p class="ml-6">Kami membangun tim sales force yang unggul melalui pengembangan individu dan kolaborasi, fokus pada
    identifikasi peluang
    pasar,pemenuhan kebutuhan pelanggan, dan pencapaian target penjualan.Dengan komitmen pada inovasi, kualitas, dan
    keunggulan layanan,kami bertekad menjadi mitra terpercaya dan pemimpin industri.</p>
</div>

<div id="tree"></div>
<script>
  // Inisialisasi OrgChart dengan node yang sudah dikustomisasi
  var chart = new OrgChart(document.getElementById("tree"), {
    mouseScrool: OrgChart.action.none,
    layout: OrgChart.layout.tree, // Coba layout "tree" untuk memperbaiki tampilan
    scaleInitial: 0.85,
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