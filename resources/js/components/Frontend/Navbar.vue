<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import {Inertia} from "@inertiajs/inertia";
import {computed} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";

const props = defineProps({
  // user: Array,
  // cats: Array
})

// const User = computed(() => usePage().props.value.auth.user)

const user = computed(() => usePage().props.value.auth.user).value;
// let user = User.value;
const menucats = computed(() => usePage().props.value.menucats.menucats).value
// let user = User.value;
// console.log(props.cats);
// function submit() {
//   Inertia.post()
// }

</script>

<template>


  <!-- navbar -->
  <nav class="bg-gray-800">
    <div class="container mx-auto flex lg:text-base md:text-base sm:text-sm text-xs ">
      <div class="mx-auto flex items-center justify-center flex-grow ">
        <div class="px-8 py-4 bg-primary flex items-center cursor-pointer relative group">

                <span class="text-white lg:hover:text-white sm:hover:text-red-500 hover:text-red-400">
                    <i class="fa-solid fa-bars hover:text-red-500"></i>
                </span>
          <span
            class="lg:inline-block sm:hidden hidden capitalize ml-2 text-white hover:text-red-500">Tüm Kategoriler</span>

          <!-- dropdown -->
          <div
            class="z-50 w-40 absolute text-center top-full bg-white shadow-md divide-y divide-gray-300 divide-red-500 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
            <div v-for="cat in menucats">
              <Link :href="route('kategori',{ cat: cat.slug })"
                    class=" flex text-center items-center  hover:bg-gray-100 hover:text-red-400 text-black transition">
                <!--            <img src="assets/images/icons/sofa.svg" alt="sofa" class="w-5 h-5 object-contain">-->
                <span class="m-4 hover:text-red-400  ml-6 text-gray-600 text-sm">{{ cat.name }}</span>
              </Link>
            </div>
          </div>
        </div>

        <!--        <div class="flex items-center justify-between flex-grow pl-12">-->
        <div class="flex items-center space-x-10 capitalize">

          <Link :href="route('/')" class="text-gray-200 hover:text-red-500 transition">Anasayfa</Link>
          <Link :href="route('kategori',{ cat: 'kitap'})" class="text-gray-200 hover:text-red-500 transition">Kitaplar
          </Link>
          <Link :href="route('kategori',{ cat: 'dergi'})" class="text-gray-200 hover:text-red-500 transition">Dergiler
          </Link>
          <!--          <a href="#" class="text-gray-200 hover:text-white transition">Hakkımızda</a>-->
          <!--          <a href="#" class="text-gray-200 hover:text-white transition">İletişim</a>-->

          <Link
            v-if="user !== null && user.length !== 0"
            :href="route('logout')"
            class="text-sm text-gray-200 dark:text-gray-500 hover:text-red-500"
            method="post"
            as="button"
          >
            Çıkış
          </Link>

        </div>


        <!--        </div>-->
      </div>
    </div>
  </nav>
  <!-- ./navbar -->


</template>
