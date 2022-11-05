<script setup>

import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Link, useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {reactive} from "vue";

const props = defineProps({
  user: Array,
  sessions: Array,
  favorites: Array,
  // detail: Array,
  // type: String
})

function assetsPath() {
  return "../../../assets/images/";
}

function productPath() {
  return "../../../storage/images/products/";
}


// const plusCart = (id) => {
//   // console.log(journalId)
//   Inertia.get(route('arttir', id));
// }
// const minusCart = (id) => {
//   // console.log(journalId)
//   Inertia.get(route('azalt', id));
// }
const addCart = (id) => {
  // console.log(journalId)
  Inertia.get(route('sepete-ekle',id));
}

const removeFavorite = (id) => {
  // console.log(journalId)
  Inertia.get(route('favoriden-sil', id));
}


</script>

<template>

  <FrontendLayout >

    <div class="mx-3">
      <!-- breadcrumb -->
      <div class="container py-4 flex items-center gap-3 mx-auto">
        <Link :href="route('/')" class="text-red-500 text-base">
          <i class="fa-solid fa-house"></i>
        </Link>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p class="text-gray-600 font-medium">Favoriler</p>
      </div>
      <!-- ./breadcrumb -->

      <!-- wrapper -->
      <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16 mx-auto">

        <!-- sidebar -->
        <div v-if="user !== null && user.length !== 0" class="sm:col-span-12 md:col-span-6 lg:col-span-3 col-span-11">
          <div class="px-4 py-3 shadow flex items-center gap-4">
            <div class="flex-shrink-0">
              <img :src="assetsPath() + 'user-icon2.jpg'" alt="profile"
                   class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
            </div>
            <div class="flex-grow">
              <p class="text-gray-600">Merhaba,</p>
              <h4 class="text-gray-800 font-medium">{{ user.name + ' ' + user.surname }}</h4>
            </div>
          </div>

          <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
            <div class="space-y-1 pl-8">

              <Link :href="route('hesabim')" class="relative hover:text-red-500 block capitalize transition">
                Profil
              </Link>
              <Link :href="route('adres.index')" class="relative hover:text-red-500 block capitalize transition">
                Adreslerim
              </Link>
              <a href="#" class="relative hover:text-red-500 block capitalize transition">
                Şifre Değiştir
              </a>

            </div>

            <div class="space-y-1 pl-8 pt-4">
              <Link :href="route('siparis-gecmisi')" class="relative hover:text-red-500 block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-solid fa-box-archive"></i>
                        </span>
                Sipariş Geçmişim
              </Link>
              <a href="#" class="relative hover:text-red-500 block capitalize transition">
                İadelerim
              </a>
              <a href="#" class="relative hover:text-red-500 block capitalize transition">
                İptal Edilen Siparişler
              </a>
            </div>

            <!--          <div class="space-y-1 pl-8 pt-4">-->
            <!--            <a href="#" class="relative hover:text-red-500 block font-medium capitalize transition">-->
            <!--                        <span class="absolute -left-8 top-0 text-base">-->
            <!--                            <i class="fa-regular fa-credit-card"></i>-->
            <!--                        </span>-->
            <!--              Payment methods-->
            <!--            </a>-->
            <!--            <a href="#" class="relative hover:text-red-500 block capitalize transition">-->
            <!--              voucher-->
            <!--            </a>-->
            <!--          </div>-->

            <div class="space-y-1 pl-8 pt-4">
              <Link :href="route('favori')" class="relative text-red-500 block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-regular fa-heart"></i>
                        </span>
                Favorilerim
              </Link>
            </div>

            <div class="space-y-1 pl-8 pt-4">
              <Link :href="route('logout')" method="post" class="relative hover:text-red-500 block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </span>
                Çıkış
              </Link>
            </div>
          </div>
        </div>
        <!-- ./sidebar -->



        <!-- wishlist -->
        <div v-if="user !== null && user.length !== 0" class="col-span-9 space-y-4">

          <div v-if="favorites.length !== 0">

            <div v-for="favorite in favorites" class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
              <div class="w-28">
                <img :src="productPath() + favorite.product.image" alt="product 6" class="w-full">
              </div>
              <div class="w-1/3">
                <Link :href="route('urun', { slug: favorite.product.slug, id:favorite.product_id })">
                  <h2 class="text-gray-800 text-xl font-medium">{{ favorite.product.name }}</h2>
                </Link>
                <p v-if="favorite.product.stok > 0" class="text-gray-500 text-sm">STOK: <span
                  class="text-red-600">{{ favorite.product.stok }}</span></p>
                <p v-else class="text-gray-500 text-sm">STOK: <span class="text-red-600">Stokta yoktur!</span></p>
              </div>
              <div v-if="favorite.product.price !== null" class="text-red-500 text-lg font-semibold">₺{{ favorite.product.price }}</div>
              <div v-else class="text-red-500 text-lg font-semibold">₺{{ favorite.product.old_price }}</div>
              <Link @click="addCart(favorite.product.id)"
                    class="px-6 py-2 text-center text-sm text-white bg-red-500 border border-red-500 rounded hover:bg-transparent hover:text-red-500 transition uppercase font-roboto font-medium">
                Sepete Ekle</Link>

              <div @click="removeFavorite(favorite.id)" class="text-gray-600 cursor-pointer hover:text-red-500">
                <i class="fa-solid fa-trash"></i>
              </div>
            </div>

          </div>

          <div v-else class="col-span-9 space-y-4">
            <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
              Favorileriniz boştur.
            </div>
          </div>

        </div>




        <!-- ./wishlist -->

      </div>
      <!-- ./wrapper -->
    </div>

  </FrontendLayout>


</template>
