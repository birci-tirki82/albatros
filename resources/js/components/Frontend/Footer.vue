<script setup>
function logoPath() {
  return "../../../assets/images/";
}

</script>

<template>


  <!-- footer -->
  <footer class="  bg-white pt-16 pb-12 border-t border-gray-200 text-center">
    <div class="container mx-auto grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-2">
      <div class="lg:col-span-1 sm:col-span-2 col-span-2 space-y-8 mb-12">

        <div class="mr-2">
          <img :src="logoPath() + 'albatroslogo.png'" alt="logo" class="w-30 mx-auto">
          <p class="text-gray-500">
            Albatros Kitabevi kalite ve popülaritesi ile hizmetinizde.
          </p>
        </div>
        <div class="text-2xl container mx-auto  space-x-6">
          <a href="#" class=" text-[#4267B2] hover:text-[#4267B2]/90">
            <i class=" fa-brands fa-facebook"></i></a>
          <a href="#" class="text-[#E1306C] hover:text-[#E1306C]/90">
            <i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="text-[#1DA1F2] hover:text-[#1DA1F2]/90">
            <i class="fa-brands fa-twitter"></i></a>
          <a href="#" class="text-[#171515] hover:text-[#171515]/90">
            <i class="fa-brands fa-github"></i>
          </a>
        </div>
      </div>
      <div class="col-span-2 grid lg:grid-cols-2 sm:-grid-cols-4 gap-8">
        <div class="grid grid-cols-2 gap-8 mb-10">
          <div>
            <h3 class="text-m font-semibold text-gray-400 tracking-wider">Kategoriler</h3>
            <div class="mt-4 space-y-2">
              <a href="#" class="text-sm  text-gray-500 hover:text-gray-900 block">Kitap</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Dergi</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Şiir</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Roman</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Edebiyat</a>
            </div>
          </div>

          <div>
            <h3 class="text-m font-semibold text-gray-400 tracking-wider">Bilgiler</h3>
            <div class="mt-4 space-y-2">
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Kullanım Koşulları</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Gizlilik Ve Güvenlik</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">İade Ve Değişim</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Sipariş Bilgisi Ve Teslimat</a>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-8  ">
          <div>
            <h3 class="text-m font-semibold text-gray-400 tracking-wider">Sözleşmeler</h3>
            <div class="mt-4 space-y-2">
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Üyelik Sözleşmesi</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Cayma Hakkı</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Tüketici Yasası</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Mesafeli Satış Sözleşmesi</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Kişisel Verilerin Korunması</a>
            </div>
          </div>

          <div>
            <h3 class="text-m font-semibold text-gray-400 tracking-wider">Kurumsal</h3>
            <div class="mt-4 space-y-2">
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Hakkımızda</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">Mağazalarımız</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">İletişim</a>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-900 block">İnsan Kaynakları</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- ./footer -->

  <!-- copyright -->
  <div class=" bg-gray-800 py-4">
    <div class="container mx-auto flex items-center justify-between">
      <p class="text-white">&copy; VM Bilişim - Bütün hakları saklıdır.</p>
      <div>
        <img :src="logoPath() + 'albatroslogo.png'" alt="methods" class="h-5">
      </div>
    </div>
  </div>


</template>
