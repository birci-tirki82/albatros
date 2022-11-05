<script setup>

import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Link, useForm, usePage} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {computed, reactive} from "vue";


const props = defineProps({
  user: Array,
  order: Array,
  orderDetails: Array,
  // totalPrice: String,
  // detail: Array,
  // type: String
})

// console.log(props.user)
function assetsPath() {
  return "../../../assets/images/";
}

function productPath() {
  return "../../../storage/images/products/";
}


const plusCart = (id) => {
  // console.log(journalId)
  Inertia.get(route('arttir', id));
}
const minusCart = (id) => {
  // console.log(journalId)
  Inertia.get(route('azalt', id));
}
const removeCart = (id) => {
  // console.log(journalId)
  Inertia.get(route('sil', id));
}


</script>

<template>

  <FrontendLayout>

    <!-- breadcrumb -->
    <div class="container py-4 flex items-center gap-3">
      <Link :href="route('/')" class="text-primary text-base">
        <i class="fa-solid fa-house"></i>
      </Link>
      <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
      <p class="text-gray-600 font-medium">Sepet</p>
    </div>
    <!-- ./breadcrumb -->

    <!-- wrapper -->
    <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16">


      <!-- sidebar -->
      <div v-if="user !== null && user.length !== 0" class="col-span-3">
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

            <Link :href="route('hesabim')" class="relative hover:text-primary block capitalize transition">
              Profil
            </Link>
            <Link :href="route('adres.index')" class="relative hover:text-primary block capitalize transition">
              Adreslerim
            </Link>
            <a href="#" class="relative hover:text-primary block capitalize transition">
              Şifre Değiştir
            </a>
          </div>

          <div class="space-y-1 pl-8 pt-4">
            <Link :href="route('siparis-gecmisi')"
                  class="relative hover:text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-solid fa-box-archive"></i>
                        </span>
              Sipariş Geçmişim
            </Link>
            <a href="#" class="relative hover:text-primary block capitalize transition">
              İadelerim
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
              İptal Edilen Siparişler
            </a>
          </div>

          <!--          <div class="space-y-1 pl-8 pt-4">-->
          <!--            <a href="#" class="relative hover:text-primary block font-medium capitalize transition">-->
          <!--                        <span class="absolute -left-8 top-0 text-base">-->
          <!--                            <i class="fa-regular fa-credit-card"></i>-->
          <!--                        </span>-->
          <!--              Payment methods-->
          <!--            </a>-->
          <!--            <a href="#" class="relative hover:text-primary block capitalize transition">-->
          <!--              voucher-->
          <!--            </a>-->
          <!--          </div>-->

          <div class="space-y-1 pl-8 pt-4">
            <Link :href="route('favori')" class="relative text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-regular fa-heart"></i>
                        </span>
              Favorilerim
            </Link>
          </div>

          <div class="space-y-1 pl-8 pt-4">
            <Link :href="route('logout')" method="post"
                  class="relative hover:text-primary block font-medium capitalize transition">
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
      <div class="col-span-9 space-y-4">


        <div v-if="orderDetails.length > 0">
          <div v-for="detail in orderDetails"
               class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
            <div class="w-28">
              <img :src="productPath() + detail.product.image" class="w-full">
            </div>


            <div class="w-1/3">
              <Link v-if="detail.product.tur === 'book'"
                    :href="route('urun', { slug: detail.product.slug, id:detail.product_id })">
                <h2 class="text-gray-800 text-xl font-medium ">{{ detail.product.name }}</h2>
              </Link>
              <Link v-else-if="detail.product.tur === 'journal'"
                    :href="route('urun', { slug: detail.product.slug, id:detail.product_id })">
                <h2 class="text-gray-800 text-xl font-medium ">{{ detail.product.name }}</h2>
              </Link>
            </div>


            <div class="size-selector">
              <label
                class="text-sm border border-gray-200 rounded-sm h-8 w-12 flex items-center justify-center shadow-sm text-gray-600">{{ detail.count }}</label>
            </div>


            <div v-if="detail.product.price !== null" class="text-sm font-bold">₺{{ detail.product.price }}</div>
            <div v-else class="text-sm font-bold">₺{{ detail.product.old_price }}</div>
          </div>
        </div>
        <div v-else class="col-span-9 space-y-4">
          <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
            Sipariş geçmişi boştur.
          </div>
        </div>



      </div>
      <!-- ./wishlist -->


    </div>
    <!-- ./wrapper -->


  </FrontendLayout>


</template>
