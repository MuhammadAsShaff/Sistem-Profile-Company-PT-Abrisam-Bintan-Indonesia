<div class="flex justify-center items-center mt-6 mb-6">
  <h2 class="text-3xl font-telkomsel font-bold text-gray-800">Produk Yang Ada Di PT Abrisam Bintan Indonesia</h2>
</div>

<div id="kategori-carousel" class="relative max-w-4xl mx-auto">
  @foreach($kategori as $index => $item)
  <div
  class="carousel-item {{ $index == 0 ? 'block' : 'hidden' }} bg-white rounded-lg shadow-lg p-6 flex items-center space-x-8 min-h-[300px]">
  <div class="flex-shrink-0">
    <img alt="{{ $item->nama_kategori }}" class="w-24 h-24 object-cover" height="150"
    src="{{ asset('uploads/kategori/' . $item->gambar_kategori) }}" width="150" />
  </div>
  <div class="flex flex-col justify-between h-full flex-grow">
    <div>
    <h2 class="text-xl font-bold font-telkomsel text-red-600 mb-2">
    {{ $item->nama_kategori }}
    </h2>
    <p class="text-gray-600 mb-4">
    {{ $item->deskripsi }}
    </p>

    @php
  $syaratKetentuan = is_string($item->syarat_ketentuan)
  ? json_decode($item->syarat_ketentuan, true)
  : $item->syarat_ketentuan;
  @endphp

    @if(!empty($syaratKetentuan) && is_array($syaratKetentuan))
    <div>
    <h3 class="font-bold font-telkomsel mb-2">Syarat dan Ketentuan:</h3>
    <ul class="list-disc pl-5 space-y-1">
    @foreach(array_slice($syaratKetentuan, 0, 2) as $syarat)
    <li class="text-reguler text-gray-700">{{ $syarat }}</li>
  @endforeach

    @if(count($syaratKetentuan) > 2)
    <li class="text-reguler text-red-600 mt-4 font-telkomsel">
   Selengkapnya
    </li>
  @endif
    </ul>
    </div>
  @endif
    </div>
  </div>
  </div>
  @endforeach

  <div class="flex justify-center items-center space-x-6 mt-4">
    <button id="prevBtn" class="bg-white rounded-full p-2 w-10 h-10 shadow-md">
      <i class="fas fa-arrow-left text-blue-900"></i>
    </button>
    <div id="carousel-dots" class="flex space-x-2">
      @foreach($kategori as $index => $item)
      <span class="w-2 h-2 {{ $index == 0 ? 'bg-blue-900' : 'bg-gray-300' }} rounded-full cursor-pointer"
      data-index="{{ $index }}"></span>
    @endforeach
    </div>
    <button id="nextBtn" class="bg-white rounded-full w-10 h-10 p-2 shadow-md">
      <i class="fas fa-arrow-right text-blue-900"></i>
    </button>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.getElementById('kategori-carousel');
    const items = carousel.querySelectorAll('.carousel-item');
    const dots = carousel.querySelectorAll('#carousel-dots span');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let currentIndex = 0;
    const totalItems = items.length;

    function showItem(index) {
      // Hide all items
      items.forEach(item => {
        item.classList.add('hidden');
        item.classList.remove('block');
      });

      // Show selected item
      items[index].classList.remove('hidden');
      items[index].classList.add('block');

      // Update dots
      dots.forEach((dot, i) => {
        if (i === index) {
          dot.classList.remove('bg-gray-300');
          dot.classList.add('bg-blue-900');
        } else {
          dot.classList.remove('bg-blue-900');
          dot.classList.add('bg-gray-300');
        }
      });
    }

    // Next button
    nextBtn.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % totalItems;
      showItem(currentIndex);
    });

    // Previous button
    prevBtn.addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + totalItems) % totalItems;
      showItem(currentIndex);
    });

    // Dot navigation
    dots.forEach(dot => {
      dot.addEventListener('click', () => {
        currentIndex = parseInt(dot.getAttribute('data-index'));
        showItem(currentIndex);
      });
    });
  });
</script>