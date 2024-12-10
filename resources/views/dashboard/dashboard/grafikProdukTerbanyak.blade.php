<h2 class="mt-8 mb-2 text-xl font-bold">Grafik Inventori Masuk Dan Keluar</h2>
<div class="w-full bg-white rounded-lg  mb-8 shadow-md shadow dark:bg-gray-800 p-4 md:p-6 flex flex-col justify-between">
  <div class="flex justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
   
     <p class="text-gray-600">Keterangan Inventori Masuk Dan Keluar</p>
  </div>

  <div id="data-series-chart" class="flex-grow mt-4"></div>

  <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-5">
    <div class="flex justify-between items-center pt-5">
      <a href="{{route('inventoryMasuk')}}"
        class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-red-600 hover:text-red-700  hover:bg-gray-100  px-3 py-2">
        Selengkapnya
        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
        </svg>
      </a>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
  const inventoryMasukData = @json($inventoryMasukData); // Data dari controller
  const inventoryKeluarData = @json($inventoryKeluarData); // Data dari controller

  const salesChartOptions = {
    series: [
      {
        name: "Inventory Masuk",
        data: inventoryMasukData,
        color: "#D10A3C",
      },
      {
        name: "Inventory Keluar",
        data: inventoryKeluarData,
        color: "#FFFF00",
      },
    ],
    chart: {
      height: 220,
      width: '100%',
      type: "area",
      fontFamily: "Inter, sans-serif",
      toolbar: {
        show: false,
      },
    },
    tooltip: {
      enabled: true,
      x: {
        show: false,
      },
    },
    legend: {
      show: false
    },
    fill: {
      type: "gradient",
      gradient: {
        opacityFrom: 0.55,
        opacityTo: 0,
        shade: "#1C64F2",
        gradientToColors: ["#1C64F2"],
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 6,
    },
    grid: {
      show: false,
      padding: {
        left: 2,
        right: 2,
        top: 2
      },
    },
    xaxis: {
      categories: [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
      ],
      labels: {
        show: true,
      },
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    yaxis: {
      show: false,
      labels: {
        formatter: function (value) {
          return value;
        }
      }
    },
  };

  if (document.getElementById("data-series-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("data-series-chart"), salesChartOptions);
    chart.render();
  }
</script>