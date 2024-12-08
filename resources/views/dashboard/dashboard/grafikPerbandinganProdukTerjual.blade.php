<h2 class="mt-8  text-xl font-bold">Grafik Perbandingan Produk Terjual</h2>
<div class="w-full bg-white rounded-lg  mb-8 shadow dark:bg-gray-800 p-4 md:p-6 flex flex-col justify-between">
  <div class="flex justify-between pb-4 border-b border-gray-200 dark:border-gray-700">

    <div>
      <p class="text-gray-600">Keterangan Dari Produk Yang Terjual</p>
    </div>
  </div>

  <!-- Line Chart -->
  <div class="py-6" id="pie-chart"></div>

  <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
    <div class="flex justify-between items-center pt-5">
      <!-- Button -->
      <a href="{{route('dashboard.dataProduk.dataProduk')}}"
        class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-red-600 hover:text-red-700  hover:bg-gray-100  px-3 py-2">
        Selengkapnya
        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 9 4-4-4-4" />
        </svg>
      </a>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
  const produkData = @json($kategoriDataChart);

  const getChartOptions = () => {
    const labels = produkData.map(item => item.label); // Ambil nama produk
    const series = produkData.map(item => item.count); // Ambil jumlah pelanggan

    return {
      series: series,
      colors: [
        "#EF4444", // Merah
        "#F87117", // Oranye
        "#FBBF24", // Kuning
        "#F59E0B", // Oranye Kuning
        "#FB923C", // Oranye Muda
        "#FCD34D", // Kuning Muda
        "#FDBA74", // Kuning Oranye
        "#FDE047"  // Kuning Terang
      ],
      chart: {
        height: 220,
        width: "100%",
        type: "pie",
      },
      stroke: {
        colors: ["white"],
        lineCap: "",
      },
      plotOptions: {
        pie: {
          labels: {
            show: true,
          },
          size: "100%",
          dataLabels: {
            offset: -25
          }
        },
      },
      labels: labels, // Nama produk sebagai label
      dataLabels: {
        enabled: true,
        style: {
          fontFamily: "Inter, sans-serif",
        },
      },
      legend: {
        position: "bottom",
        fontFamily: "Inter, sans-serif",
      },
      yaxis: {
        labels: {
          formatter: function (value) {
            return value + " Produk"
          },
        },
      },
      xaxis: {
        labels: {
          formatter: function (value) {
            return value + " Produk"
          },
        },
        axisTicks: {
          show: false,
        },
        axisBorder: {
          show: false,
        },
      },
    }
  }

  if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
    chart.render();
  }
</script>