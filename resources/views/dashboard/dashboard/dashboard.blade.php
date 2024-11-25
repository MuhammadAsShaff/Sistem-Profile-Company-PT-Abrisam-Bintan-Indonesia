@extends('dashboard.layoutDashboard')
@section('report') 

<div class="px-4 mx-auto mt-8">
  @include('dashboard.dashboard.cardWelcome')
</div>

<div class="flex flex-wrap lg:flex-nowrap px-4 mx-auto mt-8 gap-4">
  <div class="w-full lg:w-1/5">
    @include('dashboard.dashboard.cardCustomerBulanIni')
  </div>

  <div class="w-full lg:w-1/5">
    @include('dashboard.dashboard.adminOnline')
  </div>

  <div class="w-full lg:w-1/5">
    @include('dashboard.dashboard.jumlahBlog')
  </div>

  <div class="w-full lg:w-1/5">
    @include('dashboard.dashboard.jumlahInventoriMasuk')
  </div>

  <div class="w-full lg:w-1/5">
    @include('dashboard.dashboard.jumlahInventoriKeluar')
  </div>
</div>

<div class="flex flex-wrap lg:flex-nowrap justify-start gap-8 px-4 mx-auto overflow-hidden">
  <div class="w-full md:w-1/2 lg:w-1/2">
    @include('dashboard.dashboard.chartPerbulanCustomer')
  </div>

  <div class="w-full md:w-1/2 lg:w-1/2">
    @include('dashboard.dashboard.grafikProdukTerbanyak')
  </div>
</div>


<div class="flex flex-wrap lg:flex-nowrap justify-start gap-8 px-4  overflow-hidden">
  <div class="w-full md:w-1/2 lg:w-1/2">
    <!-- Tabel Jumlah Produk -->
    @include('dashboard.dashboard.tabelJumlahProduk')
  </div>

  <div class="w-full md:w-1/2 lg:w-1/2">
    <!-- Tabel Status Customer -->
    @include('dashboard.dashboard.tabelStatusCustomer')
  </div>
</div>
@endsection