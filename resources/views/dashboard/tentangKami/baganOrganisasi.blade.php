<!-- Kondisi jika tidak ada node -->
@if($countNode == 0)
  <!-- Form Tambah Bagan Organisasi -->
  <form action="{{ route('bagan.store') }}" method="POST" enctype="multipart/form-data"
    class="bg-white p-6 rounded shadow-md">
    @csrf

    <!-- Input Nama -->
    <div class="mb-4">
    <label for="name" class="block text-gray-700 font-medium">Nama</label>
    <input type="text" name="name" id="name"
      class="w-full border-gray-300 rounded p-2 @error('name') border-red-500 @enderror" required>
    @error('name')
    <p class="text-red-500 text-sm">{{ $message }}</p>
  @enderror
    </div>

    <!-- Input Jabatan -->
    <div class="mb-4">
    <label for="title" class="block text-gray-700 font-medium">Jabatan</label>
    <input type="text" name="title" id="title"
      class="w-full border-gray-300 rounded p-2 @error('title') border-red-500 @enderror" required>
    @error('title')
    <p class="text-red-500 text-sm">{{ $message }}</p>
  @enderror
    </div>

    <!-- Input Gambar (File Upload) -->
    <div class="mb-4">
    <label for="img_file" class="block text-gray-700 font-medium">Unggah Gambar (opsional)</label>
    <input type="file" name="img_file" id="img_file"
      class="w-full border-gray-300 rounded p-2 @error('img_file') border-red-500 @enderror" accept="image/*">
    @error('img_file')
    <p class="text-red-500 text-sm">{{ $message }}</p>
  @enderror
    </div>

    <!-- Tombol Submit -->
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
  </form>

@else
  <!-- Div untuk menampilkan bagan jika ada node -->
  <div id="tree"></div>
  @include('dashboard.tentangKami.modalHapus')
  @include('dashboard.tentangKami.modalInsert')
  @include('dashboard.tentangKami.modalUpdate')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://balkan.app/js/OrgChart.js"></script>
  <script>
    OrgChart.templates.olivia.nodeCircleMenuButton = {
    radius: 18,
    x: 250,
    y: 60,
    color: '#fff',
    stroke: '#aeaeae'
    };

    var chart = new OrgChart(document.getElementById("tree"), {
    mouseScrool: OrgChart.action.none,
    template: "olivia",
    onNodeClick: OrgChart.action.none,  // Menonaktifkan card menu saat mengklik node
    nodeCircleMenu: {
      addNode: {
      icon: OrgChart.icon.add(24, 24, '#aeaeae'),
      text: "Add node",
      color: "white"
      },
      editNode: {
      icon: OrgChart.icon.edit(24, 24, '#aeaeae'),
      text: "Edit node",
      color: "white"
      },
      deleteNode: {
      icon: OrgChart.icon.remove(24, 24, '#aeaeae'),
      text: "Delete node",
      color: "white"
      }
    },
    nodeMenu: null,  // Menonaktifkan nodeMenu
    nodeBinding: {
      field_0: "name",
      field_1: "title",
      img_0: "img"
    }
    });


    function addNode(parentId) {
    document.getElementById('parentId').value = parentId;
    openModal('addNodeDialog');
    }

    document.getElementById('saveNodeButton').addEventListener('click', function () {
    const newNodeName = document.getElementById('nodeName').value;
    const newNodeTitle = document.getElementById('nodeTitle').value;
    const parentId = document.getElementById('parentId').value;

    if (newNodeName && newNodeTitle) {
      const formData = new FormData();
      formData.append('name', newNodeName);
      formData.append('title', newNodeTitle);
      formData.append('parent_id', parentId);
      formData.append('_token', '{{ csrf_token() }}');

      // Jika ada input file gambar, tambahkan ke formData
      const imgFile = document.getElementById('img_file').files[0];
      if (imgFile) {
      formData.append('img_file', imgFile);
      }

      $.ajax({
      url: "{{ route('bagan.store', '') }}", // Pastikan path sesuai dengan rute `bagan.store`
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        // Tutup modal dan tampilkan SweetAlert jika berhasil
        closeModal('addNodeDialog');
        Swal.fire({
        title: 'Berhasil!',
        text: response.message,
        icon: 'success',
        timer: 1500,
        showConfirmButton: false
        }).then(() => {
        // Redirect ke halaman yang diinginkan
        window.location.href = "{{ route('dashboard.tentangKami.layoutTentangKami') }}";
        });
      },
      error: function (error) {
        // Tampilkan pesan error jika gagal
        Swal.fire({
        title: 'Gagal!',
        text: error.responseJSON ? error.responseJSON.message : 'Error tidak dikenal',
        icon: 'error'
        });
        closeModal('addNodeDialog');
      }
      });
    } else {
      alert("Nama dan Jabatan harus diisi.");
    }
    });


    // Variabel global untuk menyimpan ID node yang ingin dihapus
    let currentNodeId = null;

    function deleteNode(nodeId) {
    currentNodeId = nodeId; // Simpan nodeId yang akan dihapus
    openModal('deleteNodeDialog'); // Buka modal konfirmasi dengan animasi  
    }

    // Event listener untuk tombol konfirmasi di modal
    document.addEventListener("DOMContentLoaded", function () {
    const confirmDeleteButton = document.getElementById('confirmDeleteButton');
    if (confirmDeleteButton) {
      confirmDeleteButton.addEventListener('click', function () {
      if (currentNodeId) {
        $.ajax({
        url: "{{ route('bagan.destroy', '') }}/" + currentNodeId,
        type: "DELETE",
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function (response) {
          // Hapus node dari chart dan tutup modal
          chart.removeNode(currentNodeId);
          closeModal('deleteNodeDialog');

          // Tampilkan SweetAlert setelah penghapusan berhasil
          Swal.fire({
          title: 'Berhasil!',
          text: response.message,
          icon: 'success',
          timer: 1500,  // 1.5 detik
          showConfirmButton: false
          }).then(() => {
          // Redirect ke halaman yang ditentukan dalam respons JSON
          if (response.redirect) {
            window.location.href = response.redirect;
          }
          });
        },
        error: function (error) {
          // Tampilkan SweetAlert untuk error
          Swal.fire({
          title: 'Gagal!',
          text: error.responseJSON ? error.responseJSON.message : 'Error tidak dikenal',
          icon: 'error'
          });
          closeModal('deleteNodeDialog'); // Tutup modal jika terjadi kesalahan
        }
        });
      }
      });
    }
    });


    function editNode(nodeId) {
    currentEditNodeId = nodeId;
    const nodeData = chart.get(nodeId);

    if (nodeData) {
      // Isi nilai input dengan data node
      document.getElementById('editNodeName').value = nodeData.name;
      document.getElementById('editNodeTitle').value = nodeData.title;
      openModal('editNodeDialog');
    } else {
      console.error("Data node tidak ditemukan atau tidak lengkap.");
    }
    }

    // Event listener untuk tombol simpan di modal edit
    document.addEventListener("DOMContentLoaded", function () {
    const confirmEditButton = document.getElementById('confirmEditButton');

    if (confirmEditButton) {
      confirmEditButton.addEventListener('click', function () {
      const updatedName = document.getElementById('editNodeName').value;
      const updatedTitle = document.getElementById('editNodeTitle').value;
      const imgFile = document.getElementById('editNodeImage').files[0];

      if (updatedName && updatedTitle && currentEditNodeId) {
        const formData = new FormData();
        formData.append('name', updatedName);
        formData.append('title', updatedTitle);
        formData.append('_token', '{{ csrf_token() }} ');
        formData.append('_method', 'PUT'); // Tambahkan ini
        // Tambahkan gambar jika ada
        if (imgFile) {
        formData.append('img_file', imgFile);
        }

        $.ajax({
        url: "{{ route('bagan.update', '') }}/" + currentEditNodeId,
        type: "POST",
        data: formData,
        processData: false,  // Agar jQuery tidak memproses data
        contentType: false,  // Agar jQuery tidak mengatur jenis konten
        success: function (response) {
          chart.updateNode({ id: currentEditNodeId, name: updatedName, title: updatedTitle });
          closeModal('editNodeDialog');
          Swal.fire({
          title: 'Berhasil!',
          text: response.message,
          icon: 'success',
          timer: 1500,
          showConfirmButton: false
          }).then(() => {
          if (response.redirect) {
            window.location.href = response.redirect;
          }
          });
        },
        error: function (error) {
          Swal.fire({
          title: 'Gagal!',
          text: error.responseJSON ? error.responseJSON.message : 'Error tidak dikenal',
          icon: 'error'
          });
          closeModal('editNodeDialog');
        }
        });
      } else {
        alert("Nama dan Jabatan harus diisi.");
      }
      });
    }
    });

    // Event handler untuk nodeCircleMenu
    chart.nodeCircleMenuUI.on('click', function (sender, args) {
    switch (args.menuItem.text) {
      case "Add node":
      addNode(args.nodeId);
      break;
      case "Edit node":
      editNode(args.nodeId);
      break;
      case "Delete node":
      deleteNode(args.nodeId);
      break;
      default:
      console.error("Unknown action in nodeCircleMenu");
    }
    });
    // Memuat data dari database
    chart.load({!! $nodes !!});
  </script>

@endif