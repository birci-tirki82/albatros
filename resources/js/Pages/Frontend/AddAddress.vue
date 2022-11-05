<script setup>

import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Link, useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {reactive} from "vue";
import FormValidationErrors from '@/components/FormValidationErrors.vue';

const props = defineProps({
  user: Array,
  // addresses: Array,
  // sessions: Array,
  // carts: Array,
  // detail: Array,
  // type: String
})

const form = useForm({
  user_id: props.user.id,
  name: "",
  surname: "",
  country: "",
  city: "", //il
  district: "", //ilçe
  phone: "",
  // email: "",
  address: "",
  zipcode: "",
});

function submit() {
  Inertia.post(route('adres.store'), form)
}

// const form = useForm({
//   id: props.user.id,
//   name: props.user.name,
//   surname: props.user.surname,
//   email: props.user.email,
// });

// function submit() {
//   Inertia.get(route('profil-guncelle'), form)
// }
// console.log(props.user)
function assetsPath() {
  return "../../../assets/images/";
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
        <p class="text-gray-600 font-medium">Profil</p>
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
        <!--./sidebar -->


        <form class="sm:col-span-12 md:col-span-6 lg:col-span-8 col-span-10 " @submit.prevent="submit">

          <FormValidationErrors/>

          <div class=" grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div>
              <label for="first-name" class="text-gray-600 block">İsim <span
                class="text-red-500">*</span></label>
              <input type="text" v-model="form.name" id="first-name" placeholder="İsim Giriniz.." class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
            </div>
            <div>
              <label for="last-name" class="text-gray-600 block">Soyisim <span
                class="text-red-500">*</span></label>
              <input type="text" v-model="form.surname" id="last-name" placeholder="Soyisim Giriniz.." class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
            </div>
          </div>


<!--          <div class="">-->
<!--            <label for="name" class="text-gray-600 mb-2 block">İsim</label>-->
<!--            <input type="text" v-model="form.name" id="name"-->
<!--                   class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"-->
<!--                   placeholder="E-mail adresiniz..">-->
<!--          </div>-->



          <div class="mt-4">
            <label for="company" class="text-gray-600 block">Ülke</label>
            <input type="text" v-model="form.country" id="company" placeholder="Ülke Giriniz.." class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
          </div>

          <div class="mt-4">
            <label for="city" class="text-gray-600 block">İl</label>
            <input type="text" v-model="form.city" id="city" placeholder="İl Giriniz.." class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
          </div>

          <div class="mt-4">
            <label for="district" class="text-gray-600 block">İlçe</label>
            <input type="text" v-model="form.district" id="district" placeholder="İlçe Giriniz.." class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
          </div>

          <div class="mt-4">
            <label for="address" class="text-gray-600 block">Adres</label>
            <input type="text" v-model="form.address" id="address" placeholder="Adres Giriniz.." class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
          </div>

          <div class="mt-4">
            <label for="phone" class="text-gray-600 block">Telefon</label>
            <input type="tel" v-model="form.phone" id="phone" placeholder="Telefon Giriniz.." class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
          </div>

          <div class="mt-4">
            <label for="zipcode" class="text-gray-600 block">Zipkod</label>
            <input type="text" v-model="form.zipcode" id="zipcode" placeholder="Zipkod Giriniz.." class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
          </div>

          <button type="submit" class="block w-full py-2 mt-8 text-center text-white bg-red-500 border border-red-500 rounded hover:bg-transparent hover:text-red-500 transition uppercase font-roboto font-medium">
            Ekle
          </button>

        </form>


      </div>
      <!-- ./wrapper -->
    </div>


  </FrontendLayout>


</template>
