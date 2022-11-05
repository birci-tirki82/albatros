<script setup>
import {Link, usePage} from "@inertiajs/inertia-vue3";
import {computed} from "vue";

// const props = defineProps({
//   user: Array,
// })
const User = computed(() => usePage().props.value.auth.user)
let user = User.value;
const getqty = computed(() => usePage().props.value.cart.qty)
let qty = getqty.value;
const favgetqty = computed(() => usePage().props.value.favorite.favqty)
let favqty = favgetqty.value;
// console.log(qty)
function logoPath() {
  return "../../../assets/images/";
}
// console.log(props.user)


</script>

<template>


  <!-- header -->
  <header class="py-4 shadow-sm bg-white">
    <div class="mx-auto flex container items-center justify-between lg:text-lg md:text-sm sm:text-xs text-lg">

      <Link :href="route('/')">
        <img :src="logoPath() + 'albatroslogo.png'" alt="Logo" class="w-32">
      </Link>

      <div class="w-full max-w-xl relative flex ml-4">
<!--                <span class="absolute left-4 top-3 text-lg text-gray-400">-->
<!--                    <i class="fa-solid fa-magnifying-glass"></i>-->
<!--                </span>-->
        <input type="text" name="search" id="search"
               class="w-full border border-gray-500 border-r-0  rounded-l-md focus:outline-none"
               placeholder="Ara...">
        <button
          class=" hover:bg-gray-50 bg-red-500 border border-red-500 text-white lg:px-8 md:px-4 sm:px-4 px-2 rounded-r-md hover:bg-transparent hover:text-red-500 transition">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>

      <div class=" ml-4 flex items-center lg:space-x-10 sm:space-x-4 space-x-2 lg:text-lg md:text-sm sm:text-xs text-xs">


        <Link v-if="user !== null && user.length !== 0" :href="route('favori')" class="text-center text-gray-700  transition relative">
          <div class="text-2xl">
            <i class="text-xl lg:text-2xl md:text-2xl sm:text-xl  text-black hover:text-red-600/80 fa-regular fa-heart"></i>
          </div>

<!--          <div class="text-xs leading-3">Favoriler</div>-->

          <div class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-red-500 text-white text-xs">
            {{favqty}}
          </div>
<!--          <div v-else-->
<!--            class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">-->
<!--            0-->
<!--          </div>-->
        </Link>

        <Link v-else :href="route('user-login')" class="text-center text-gray-700 transition relative">
          <div class="text-2xl">
            <i class="text-xl lg:text-2xl md:text-2xl sm:text-xl  text-black hover:text-red-600/80 fa-regular fa-heart"></i>
          </div>
<!--          <div class="text-xs leading-3">Favoriler</div>-->
          <div class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-red-500 text-white text-xs">
            0
          </div>
        </Link>


        <Link :href="route('sepet')" class="text-center text-gray-700 hover:text-primary transition relative">
          <div class="text-2xl">
            <i class="text-xl lg:text-2xl md:text-2xl sm:text-xl  text-black hover:text-red-600/80 fa-solid fa-bag-shopping"></i>
          </div>

<!--          <div class="text-xs leading-3">Sepet</div>-->
          <div v-if="qty > 0"
            class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-red-500 text-white text-xs">
            {{qty}}
          </div>
          <div v-else
            class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-red-500 text-white text-xs">
            0
          </div>
        </Link>


        <Link :href="route('hesabim')"  v-if="user !== null && user.length !== 0 " class="text-center text-gray-700 hover:text-primary transition relative">
          <div class="text-2xl">
            <i class="text-xl lg:text-2xl md:text-2xl sm:text-xl  text-black hover:text-red-600/80  fa-regular fa-user"></i>
          </div>
          <div class="text-xs leading-3">Hesabım</div>
        </Link>
        <Link  :href="route('user-login')"  v-else class="text-center text-gray-700 hover:text-primary transition relative">
          <div class="text-2xl">
            <i class="text-xl lg:text-2xl md:text-2xl sm:text-xl  text-black hover:text-red-600/80 fa-regular fa-user"></i>
          </div>
          <div class="text-xs leading-3">Giriş</div>
        </Link>

      </div>
    </div>
  </header>
  <!-- ./header -->


</template>
