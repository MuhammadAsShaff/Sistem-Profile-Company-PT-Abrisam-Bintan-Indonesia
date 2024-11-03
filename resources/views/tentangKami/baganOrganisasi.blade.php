<script src="https://balkan.app/js/OrgChart.js"></script>
<div id="tree" class="container mx-auto mt-20 p-4"></div>

<style>
  html,
  body {
    width: 100%;
    height: 100%;
    overflow-x: hidden;
  }

  /* Atur div agar sesuai dengan tinggi konten bagan */
  #tree {
    width: 100%;
    min-height: 100vh;
    /* Minimal setinggi layar */
    overflow-y: auto;
    padding: 10px;
  }
</style>

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

    nodes: [
      { id: 1, name: "Reni Susanti", title: "Direktur", img: "https://via.placeholder.com/100" },
      { id: 2, pid: 1, name: "Wawan Putra", title: "Vice President (VP)", img: "https://via.placeholder.com/100" },
      { id: 3, pid: 2, name: "Angga Pramana Putra", title: "Keuangan", img: "https://via.placeholder.com/100" },
      { id: 4, pid: 2, name: "Ihsan Rinanda P", title: "General Manager", img: "https://via.placeholder.com/100" },
      { id: 5, pid: 2, name: "Youli Samusda", title: "Manager Data", img: "https://via.placeholder.com/100" },
      { id: 6, pid: 4, name: "Arrie", title: "Team Leader" },
      { id: 7, pid: 4, name: "Abdul", title: "Team Leader" },
      { id: 8, pid: 4, name: "Anwar", title: "Team Leader" },
      { id: 9, pid: 4, name: "Iqbal", title: "Team Leader" },
      { id: 10, pid: 4, name: "Yunus", title: "Team Leader" },
      { id: 11, pid: 4, name: "Zul Apriandi", title: "Team Leader" },
      { id: 12, pid: 5, name: "Redho", title: "Admin Support", img: "https://via.placeholder.com/100" }
    ]
  });

  // Menambahkan listener klik global untuk mencegah munculnya pop-up interaktif
  document.getElementById("tree").addEventListener("click", function (event) {
    event.stopPropagation();
  }, true);
</script>