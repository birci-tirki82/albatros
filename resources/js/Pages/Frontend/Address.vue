<script setup>

import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Link, useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {reactive} from "vue";

const props = defineProps({
  user: Array,
  addresses: Array,
  // sessions: Array,
  // carts: Array,
  // detail: Array,
  // type: String
})

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

function removeAddress (id) {
  Inertia.get(route('adres-sil',id));
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
const title = 'Adresler';
const description = 'adresler';

</script>

<template>

  <FrontendLayout >
    <Head>
      <title>{{ title }}</title>
      <meta type="description" :content=description head-key="description">
    </Head>

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
        <!-- ./sidebar -->


        <!-- info -->



        <div class="sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3 col-span-9 grid grid-cols-1 gap-4">
          <!--        w-10/12 grid sm:grid-cols-1  lg:grid-cols-3 gap-6 mx-auto justify-center-->

          <div v-for="address in addresses" class="shadow rounded bg-white px-4 pt-6 pb-4">
            <div class="flex items-center justify-between mb-4">
              <h3 class="font-medium text-gray-800 text-lg">{{address.name }} {{address.surname}}</h3>
              <a href="#" class="text-red-500">Düzenle</a>
<!--                          <Link @click="removeAddress(address.id)" class="text-red-500">Sil</Link>-->
                          <Link :href="route('adres.destroy', address.id)" method="delete" class="text-red-500">Sil</Link>
            </div>
            <div class="space-y-1">
              <h4 class="text-gray-700 font-medium">{{address.address }}</h4>
              <p class="text-gray-800">{{ user.email }}</p>
              <p class="text-gray-800">{{ address.phone }}</p>
            </div>
          </div>

          <div class="mt-4">
            <Link :href="route('adres.create')"
                  class="block w-full py-1 text-center text-white bg-red-500 border border-red-500 rounded-b hover:bg-transparent hover:text-red-500 transition">
              Adres Ekle
            </Link>

          </div>

        </div>

        <!-- ./info -->


      </div>
      <!-- ./wrapper -->
    </div>




  </FrontendLayout>


</template>
