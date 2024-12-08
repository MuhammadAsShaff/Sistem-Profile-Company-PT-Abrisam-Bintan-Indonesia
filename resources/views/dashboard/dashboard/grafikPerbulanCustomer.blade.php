<h2 class="mt-8 text-xl font-bold">Grafik Customer Perbulan</h2>
<div class="w-full bg-white rounded-lg shadow mb-8 p-4 md:p-6 flex flex-col justify-between">
  <div class="flex justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
    
    <div>
      <p class="text-gray-600">Keterangan Dari Customer Perbulan</p>
    </div>  
  </div>

  <div id="column-chart" class="flex-grow mt-4"></div>

  <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-5">
    <div class="flex justify-between items-center pt-5">
       <a href="{{route('dashboard.dataPelanggan.dataPelanggan')}}"
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
  const options = {
    colors: ["#D10A3C"],
    series: [
      { name: "Jumlah Customer", data: @json($dataCustomer) }
    ],
    chart: {
      type: "bar",
      height: 220,
      fontFamily: "Inter, sans-serif",
      toolbar: { show: false },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "70%",
        borderRadiusApplication: "end",
        borderRadius: 8,
      },
    },
    tooltip: {
      shared: true,
      intersect: false,
      style: { fontFamily: "Inter, sans-serif" },
    },
    stroke: { show: true, width: 0, colors: ["transparent"] },
    grid: { show: false, strokeDashArray: 4, padding: { left: 2, right: 2, top: 0 } },
    dataLabels: { enabled: false },
    legend: { show: false },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], // Nama bulan
      labels: { show: true, style: { cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400' } },
      axisBorder: { show: false },
      axisTicks: { show: false },
    },
    yaxis: { show: true },
    fill: { opacity: 1 },
  };

  if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("column-chart"), options);
    chart.render();
  }
</script>