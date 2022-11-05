<script setup>

import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Link, useForm, usePage} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {computed, reactive} from "vue";


const props = defineProps({
  user: Array,
  sessions: Array,
  carts: Array,
  totalPrice: String,
  session_total_price: Number,
  // detail: Array,
  // type: String
})
console.log(props.session_total_price)

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

const title = 'Sepet';
const description = 'sepet';
</script>

<template>

  <FrontendLayout>
    <Head>
      <title>{{ title }}</title>
      <meta type="description" :content=description head-key="description">
    </Head>

    <div class="lg:mx-auto mx-3">
      <!-- breadcrumb -->
      <div class="container py-4 flex items-center gap-3 mx-auto">
        <Link :href="route('/')" class="text-red-500 text-base">
          <i class="fa-solid fa-house"></i>
        </Link>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p class="text-gray-600 font-medium">Sepet</p>
      </div>
      <!-- ./breadcrumb -->

      <!-- wrapper -->
      <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16 mx-auto">


        <!-- sidebar -->
        <div v-if="user !== null && user.length !== 0" class="lg:col-span-3 col-span-12">
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
              <Link :href="route('siparis-gecmisi')"
                    class="relative hover:text-red-500 block font-medium capitalize transition">
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
              <Link :href="route('logout')" method="post"
                    class="relative hover:text-red-500 block font-medium capitalize transition">
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
        <div v-if=" user !== null &&  user.length !== 0" class="lg:col-span-9 col-span-12 space-y-4">

          <div v-if="carts.length !== 0">

            <div class="border p-4 border-gray-200 rounded">
              <div v-for="cart in carts" class="flex flex-row items-center justify-between gap-2">
                <div class="lg:w-28">
                  <img :src="productPath() + cart.product.image" class="w-full">
                </div>

                <div class="">
                  <Link :href="route('urun', { slug: cart.product.slug, id:cart.product_id })">
                    <h2 class="text-gray-800 text-xs">{{ cart.product.name }}</h2>
                  </Link>
                  <p v-if="cart.product.stok > 0" class="text-gray-500 text-xs">Stok: <span
                    class="text-red-600 text-xs">{{ cart.product.stok }}</span></p>
                  <p v-else class="text-gray-500 text-xs">Stok: <span class="text-red-700">Stokta yoktur!</span></p>
                </div>

                <!--                <div class="flex flex-row items-center justify-between gap-2">-->
                <Link @click="plusCart(cart.id)"
                      class="lg:px-6 lg:py-2 lg:text-xs text-center text-white bg-red-400 border border-red-400 rounded transition uppercase font-roboto">
                  <i class="fa-solid fa-plus p-1"></i>
                </Link>
                <div class="size-selector">
                  <label
                    class="text-xs border border-gray-200 rounded-sm h-8 w-8 lg:w-12 flex items-center justify-center shadow-sm text-gray-600">{{ cart.count }}</label>
                </div>

                <Link @click="minusCart(cart.id)"
                      class="lg:px-6 lg:py-2 lg:text-xs text-center text-white bg-red-400 border border-red-400 rounded transition uppercase font-roboto font-medium">
                  <i class="fa-solid fa-minus p-1"></i>
                </Link>

                <div v-if="cart.product.price !== null" class="text-sm font-bold">₺{{ cart.product.price }}</div>
                <div v-else class="text-sm font-bold">₺{{ cart.product.old_price }}</div>


                <div class="text-sm font-bold">₺{{ cart.sum_prod }}</div>


                <div @click="removeCart(cart.id)" class="text-gray-600 cursor-pointer hover:text-red-500y">
                  <i class="fa-solid fa-trash"></i>
                </div>
                <!--                </div>-->

              </div>
            </div>

            <div class="col-span-9 space-y-4 mt-6">
              <div class="text-sm font-bold">Toplam : ₺{{ totalPrice }}</div>
              <br>
              <Link :href="route('odeme')"
                    class="px-6 py-2 text-center text-sm text-white bg-red-400 border border-red-400 rounded transition uppercase font-roboto font-medium">
                Ödeme Yap
              </Link>
            </div>
          </div>

          <div v-else class="col-span-9 space-y-4">
            <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
              Sepetiniz boştur.
            </div>
          </div>


        </div>
        <!-- ./wishlist -->

        <!-- wishlist -->
        <div v-else class="col-span-9 space-y-4">

          <div v-if="sessions !== null && sessions.length !== 0">
            <div v-for="session in sessions"
                 class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
              <div class="w-28">
                <img :src="productPath() + session.image" alt="product 6" class="w-full">
              </div>
              <div class="w-1/3">
                <Link :href="route('urun', { slug: session.slug, id:session.id })">
                  <h2 class="text-gray-800 text-sm font-medium">{{ session.name }}</h2>
                </Link>
                <p v-if="session.stok > 0" class="text-gray-500 text-sm">STOK: <span
                  class="text-red-600">{{ session.stok }}</span></p>
                <p v-else class="text-gray-500 text-sm">STOK: <span class="text-red-600">Stokta yoktur!</span></p>
              </div>


              <Link @click="plusCart(session.id)"
                    class="px-6 py-2 text-center text-xs text-white bg-red-400 border border-red-400 rounded transition uppercase font-roboto font-medium">
                <i class="fa-solid fa-plus"></i>

              </Link>
              <div class="size-selector">
                <label
                  class="text-sm border border-gray-200 rounded-sm h-8 w-12 flex items-center justify-center shadow-sm text-gray-600">{{ session.qty }}</label>
              </div>
              <Link @click="minusCart(session.id)"
                    class="px-6 py-2 text-center text-xs text-white bg-red-400 border border-red-400 rounded transition uppercase font-roboto font-medium">
                <i class="fa-solid fa-minus"></i>
              </Link>

              <div v-if="session.price !== null" class=" text-sm font-bold">₺{{ session.price }}</div>
              <div v-else class=" text-sm font-bold">₺{{ session.old_price }}</div>

              <div class="text-sm font-bold">₺{{ session.total_price }}</div>


              <div @click="removeCart(session.id)" class="text-gray-600 cursor-pointer hover:text-red-500y">
                <i class="fa-solid fa-trash"></i>
              </div>
            </div>


            <div class="col-span-9 space-y-4 mt-6">
              <div v-if="session_total_price !== 0" class="text-sm font-bold">Toplam : ₺{{ session_total_price }}</div>
              <br>
              <Link :href="route('user-login')"
                    class="px-6 py-2 text-center text-sm text-white bg-red-400 border border-red-400 rounded transition uppercase font-roboto font-medium">
                Ödeme Yap
              </Link>
            </div>
          </div>

          <div v-else class="col-span-9 space-y-4">
            <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
              Sepetiniz boştur.
            </div>
          </div>

        </div>
        <!-- ./wishlist -->


      </div>
      <!-- ./wrapper -->
    </div>


  </FrontendLayout>


</template>
