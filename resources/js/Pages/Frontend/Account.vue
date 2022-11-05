<script setup>

import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Link, useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {reactive} from "vue";

const props = defineProps({
  user: Array,
  // sessions: Array,
  // carts: Array,
  // detail: Array,
  // type: String
})

const form = useForm({
  id: props.user.id,
  name: props.user.name,
  surname: props.user.surname,
  email: props.user.email,
});

function submit() {
  Inertia.post(route('profil-guncelle'), form)
}
// console.log(props.user)
function assetsPath() {
  return "../../../assets/images/";
}

// function productPath() {
//   return "../../../storage/images/products/";
// }


// const plusCart = (id) => {
//   // console.log(journalId)
//   Inertia.get(route('arttir', id));
// }
// const minusCart = (id) => {
//   // console.log(journalId)
//   Inertia.get(route('azalt', id));
// }
// const removeCart = (id) => {
//   // console.log(journalId)
//   Inertia.get(route('sil', id));
// }


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
        <p class="text-gray-600 font-medium">Profil</p>
      </div>
      <!-- ./breadcrumb -->

      <!-- wrapper -->
      <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16 mx-auto">


        <!-- sidebar -->
        <div v-if="user !== null && user.length !== 0" class="sm:col-span-12 md:col-span-8 lg:col-span-3 col-span-11">
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



        <form class="sm:col-span-12 md:col-span-8 lg:col-span-3 col-span-6 "  @submit.prevent="submit" autocomplete="off">
          <div class="space-y-2 ">

            <div class="">
              <label for="name" class="text-gray-600 mb-2 block">İsim</label>
              <input type="text" v-model="form.name" id="name"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"
                     placeholder="E-mail adresiniz..">
            </div>
            <div>
              <label for="surname" class="text-gray-600 mb-2 block">Soyisim</label>
              <input type="text" v-model="form.surname" id="surname"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"
                     placeholder="E-mail adresiniz..">
            </div>
            <div>
              <label for="email" class="text-gray-600 mb-2 block">Email Adres</label>
              <input type="email" disabled v-model="form.email" id="email"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"
                     placeholder="E-mail adresiniz..">
            </div>

            <div class="mt-4">
              <button type="submit" class="mt-4 block w-full py-2 text-center text-white bg-red-500 border border-red-500 rounded hover:bg-transparent hover:text-red-500 transition uppercase font-roboto font-medium">
                Güncelle
              </button>
            </div>

          </div>
        </form>


      </div>
      <!-- ./wrapper -->
    </div>




  </FrontendLayout>


</template>
