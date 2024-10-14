<div class="min-h-screen bg-gray-100 flex items-center justify-center">
  <div class="container mx-auto p-5">
    <div class="flex flex-col md:flex-row items-center">
      <div class="md:w-1/3 flex flex-col items-center text-center mt-[-240px]">
        <img src="{{ asset('images/FaQ.png') }}" alt="Animasi" class="w-120 h-auto " />
        <h2 class="font-bold text-xl mt-4">Pertanyaan Umum</h2>
      </div>

      <div class="md:w-2/3 mt-6 md:mt-0 md:ml-6">
        @foreach($faqs as $index => $faq)
        <div id="faq-{{ $index }}" class="bg-white shadow-md p-4 mb-4 rounded-lg cursor-pointer"
        onclick="toggleFaq({{ $index }})">
        <div class="flex justify-between items-center">
        <h6 class="font-semibold">{{ $faq->judul_faq }}</h6>
        <span class="text-xl" id="toggle-icon-{{ $index }}">+</span>
        </div>
        <div class="hidden mt-2 text-gray-700" id="faq-body-{{ $index }}">
        <p class="text-justify">{{ $faq->isi_faq }}</p>
        </div>
        </div>
    @endforeach
      </div>
    </div>
  </div>
</div>

<script>
  function toggleFaq(index) {
    const faqBody = document.getElementById(`faq-body-${index}`);
    const icon = document.getElementById(`toggle-icon-${index}`);
    const isHidden = faqBody.classList.contains('hidden');

    // Close all FAQ bodies and reset icons
    document.querySelectorAll('[id^="faq-body-"]').forEach(body => body.classList.add('hidden'));
    document.querySelectorAll('[id^="toggle-icon-"]').forEach(i => i.textContent = '+');

    // Toggle the clicked FAQ body
    if (isHidden) {
      faqBody.classList.remove('hidden');
      icon.textContent = '−';
    }
  }
</script>