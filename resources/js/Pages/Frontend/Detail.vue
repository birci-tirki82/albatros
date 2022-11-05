<script setup>

import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Link, Head, useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {reactive} from "vue";

const props = defineProps({
  user: Array,
  favorites: Array,
  // journal: Array,
  // product: Array,
  detail: Array,
  type: String
})
// console.log(props.user);
const form = useForm({
  user_id: 0,
});


// console.log(props.user)

function productPath() {
  return "../../../storage/images/products/";
}

function assetsPath() {
  return "../../../assets/images/";
}

// function count() {
//   // form.count++;
//   Inertia.post(route('cart.plus'), form)
// }

const addCart = (id) => {
  // console.log(journalId)
  Inertia.get(route('sepete-ekle', id));
}
const addFavorite = (id) => {
  // console.log(journalId)
  Inertia.get(route('favorilere-ekle', id));
}

const title = props.detail.product.name;
const description = props.detail.product.name;
// console.log(title)
</script>

<template>

  <FrontendLayout>
    <Head>
      <title>{{ title }}</title>
      <meta type="description" :content=description head-key="description">
    </Head>

    <div class="container lg:mx-auto mx-3">
      <!-- breadcrumb -->
      <div class="container py-4 flex items-center gap-3 mx-auto">
        <!--      <a href="../index.html" class="text-red-500 text-base">-->
        <!--        <i class="fa-solid fa-house"></i>-->
        <!--      </a>-->
        <Link :href="route('/')" class="text-red-500 text-base"><i class="fa-solid fa-house"></i></Link>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p v-if="type === 'dergi' " class="text-gray-600 font-medium">Dergi</p>
        <p v-else class="text-gray-600 font-medium">Kitap</p>
      </div>
      <!-- ./breadcrumb -->

      <!-- product-detail -->
      <div class="container grid grid-cols-12">
        <div class="lg:col-span-6 col-span-12">
          <img :src="productPath() + detail.product.images[0].large" alt="product" class="w-full">
          <div v-for="detailImage in detail.product.images" class=" grid grid-cols-4 gap-4 mt-4">
            <img :src="productPath() + detailImage.small" alt="product2"
                 class=" w-full cursor-pointer border border-red-200">
          </div>
        </div>

        <div class="lg:col-span-6 col-span-12">
          <h2 class="text-3xl font-medium mb-2">{{ detail.product.name }}</h2>
          <div class="flex items-center mb-4">
            <div class="flex gap-1 text-sm text-yellow-400">
              <span><i class="fa-solid fa-star"></i></span>
              <span><i class="fa-solid fa-star"></i></span>
              <span><i class="fa-solid fa-star"></i></span>
              <span><i class="fa-solid fa-star"></i></span>
              <span><i class="fa-solid fa-star"></i></span>
            </div>
            <div class="text-xs text-gray-500 ml-3">(150 Reviews)</div>
          </div>

          <div class="space-y-2">
            <p class="text-gray-800 font-semibold space-x-2">
              <span>Stok: </span>
              <span v-if="detail.product.stok > 0" class="text-green-600">Stokta {{ detail.product.stok }} adet</span>
            </p>
            <!--          <p class="space-x-2">-->
            <!--            <span class="text-gray-800 font-semibold">Brand: </span>-->
            <!--            <span class="text-gray-600">Apex</span>-->
            <!--          </p>-->
            <p class="space-x-2">
              <span class="text-gray-800 font-semibold">Kategori: </span>
              <!--              <span v-if="type === 'dergi'" class="text-gray-600">{{ detail.product.category.name }}</span>-->
              <!--              <span v-else class="text-gray-600">{{ detail.product.category.name }}</span>-->
              <Link :href="route('kategori',{ cat: detail.product.category.slug })"><span class="text-gray-600">{{ detail.product.category.name }}</span></Link>

            </p>
            <p class="space-x-2">
              <span class="text-gray-800 font-semibold">İSBN: </span>
              <span class="text-gray-600">{{ detail.isbn }}</span>
            </p>
            <p class="space-x-2">
              <span class="text-gray-800 font-semibold">Yayım Tarihi: </span>
              <span class="text-gray-600">{{ detail.publish_date }}</span>
            </p>
          </div>

          <div class="flex items-baseline mb-1 space-x-2 font-roboto mt-4">
            <p v-if="detail.product.price !== null" class="text-xl text-red-500 font-semibold">₺{{ detail.product.price }}</p>
            <p v-else class="text-xl text-red-500 font-semibold">₺{{ detail.product.old_price }}</p>
            <p v-if="detail.product.price !== detail.product.old_price && detail.product.price !== null"
               class="text-base text-gray-400 line-through">₺{{ detail.product.old_price }}</p>
          </div>

          <table class="container table-auto border-collapse w-full text-left text-gray-600 text-sm mt-6">
            <tr class="grid grid-cols-12">
              <th scope="col" class="col-span-2 py-2 px-4 border border-gray-300 font-medium">Dil</th>
              <th scope="col" class="col-span-10 py-2 px-4 border border-gray-300 font-medium w-full">{{ detail.language }}</th>
            </tr>
            <tr class="grid grid-cols-12">
              <th scope="col" class="col-span-2 py-2 px-4 border border-gray-300 font-medium">Kağıt Cinsi</th>
              <th scope="col" class="col-span-10  py-2 px-4 border border-gray-300  w-full">{{ detail.paper_type }}</th>
            </tr>
            <tr class="grid grid-cols-12">
              <th scope="col" class="col-span-2 py-2 px-4 border border-gray-300 font-medium">Cilt Tipi</th>
              <th scope="col" class="col-span-10 py-2 px-4 border border-gray-300 w-full">{{ detail.type }}</th>
            </tr>
            <tr class="grid grid-cols-12">
              <th scope="col" class="col-span-2 py-2 px-4 border border-gray-300 font-medium">Sayfa</th>
              <th scope="col" class="col-span-10 py-2 px-4 border border-gray-300  w-full">{{ detail.pages }} sayfa</th>
            </tr>
          </table>


<!--          <div class="overflow-x-auto relative">-->
<!--            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">-->
<!--              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">-->
<!--              <tr>-->
<!--                <th scope="col" class="py-3 px-6">-->
<!--                  Product name-->
<!--                </th>-->
<!--                <th scope="col" class="py-3 px-6">-->
<!--                  Color-->
<!--                </th>-->
<!--                <th scope="col" class="py-3 px-6">-->
<!--                  Category-->
<!--                </th>-->
<!--                <th scope="col" class="py-3 px-6">-->
<!--                  Price-->
<!--                </th>-->
<!--              </tr>-->
<!--              </thead>-->
<!--              <tbody>-->
<!--              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">-->
<!--                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">-->
<!--                  Apple MacBook Pro 17"-->
<!--                </th>-->
<!--                <td class="py-4 px-6">-->
<!--                  Sliver-->
<!--                </td>-->
<!--                <td class="py-4 px-6">-->
<!--                  Laptop-->
<!--                </td>-->
<!--                <td class="py-4 px-6">-->
<!--                  $2999-->
<!--                </td>-->
<!--              </tr>-->
<!--              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">-->
<!--                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">-->
<!--                  Microsoft Surface Pro-->
<!--                </th>-->
<!--                <td class="py-4 px-6">-->
<!--                  White-->
<!--                </td>-->
<!--                <td class="py-4 px-6">-->
<!--                  Laptop PC-->
<!--                </td>-->
<!--                <td class="py-4 px-6">-->
<!--                  $1999-->
<!--                </td>-->
<!--              </tr>-->
<!--              <tr class="bg-white dark:bg-gray-800">-->
<!--                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">-->
<!--                  Magic Mouse 2-->
<!--                </th>-->
<!--                <td class="py-4 px-6">-->
<!--                  Black-->
<!--                </td>-->
<!--                <td class="py-4 px-6">-->
<!--                  Accessories-->
<!--                </td>-->
<!--                <td class="py-4 px-6">-->
<!--                  $99-->
<!--                </td>-->
<!--              </tr>-->
<!--              </tbody>-->
<!--            </table>-->
<!--          </div>-->


          <div class="pt-4">
            <h3 class="text-sm text-gray-800 uppercase mb-1 font-semibold">Boyutlar</h3>
            <div class="flex items-center gap-2">
              <div class="size-selector">
                <label
                  class="text-sm border border-gray-200 rounded-sm h-12 w-12 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">{{ detail.dimensions }}</label>
              </div>

              <!--            <div class="size-selector">-->
              <!--              <input type="radio" name="size" id="size-xs" class="hidden">-->
              <!--              <label for="size-xs"-->
              <!--                     class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">XS</label>-->
              <!--            </div>-->
              <!--            <div class="size-selector">-->
              <!--              <input type="radio" name="size" id="size-sm" class="hidden">-->
              <!--              <label for="size-sm"-->
              <!--                     class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">S</label>-->
              <!--            </div>-->
              <!--            <div class="size-selector">-->
              <!--              <input type="radio" name="size" id="size-m" class="hidden">-->
              <!--              <label for="size-m"-->
              <!--                     class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">M</label>-->
              <!--            </div>-->
              <!--            <div class="size-selector">-->
              <!--              <input type="radio" name="size" id="size-l" class="hidden">-->
              <!--              <label for="size-l"-->
              <!--                     class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">L</label>-->
              <!--            </div>-->
              <!--            <div class="size-selector">-->
              <!--              <input type="radio" name="size" id="size-xl" class="hidden">-->
              <!--              <label for="size-xl"-->
              <!--                     class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">XL</label>-->
              <!--            </div>-->

            </div>
          </div>


          <!--        <div class="pt-4">-->
          <!--          <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Color</h3>-->
          <!--          <div class="flex items-center gap-2">-->
          <!--            -->
          <!--            <div class="color-selector">-->
          <!--              <input type="radio" name="color" id="red" class="hidden">-->
          <!--              <label for="red"-->
          <!--                     class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"-->
          <!--                     style="background-color: #fc3d57;"></label>-->
          <!--            </div>-->
          <!--            <div class="color-selector">-->
          <!--              <input type="radio" name="color" id="black" class="hidden">-->
          <!--              <label for="black"-->
          <!--                     class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"-->
          <!--                     style="background-color: #000;"></label>-->
          <!--            </div>-->
          <!--            <div class="color-selector">-->
          <!--              <input type="radio" name="color" id="white" class="hidden">-->
          <!--              <label for="white"-->
          <!--                     class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"-->
          <!--                     style="background-color: #fff;"></label>-->
          <!--            </div>-->

          <!--          </div>-->
          <!--        </div>-->

          <!--        <div class="mt-4">-->
          <!--          <h3 class="text-sm text-gray-800 uppercase mb-1">Adet</h3>-->
          <!--          <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">-->
          <!--            <div class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">-</div>-->
          <!--            <div class="h-8 w-8 text-base flex items-center justify-center">4</div>-->
          <!--            <div class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">+</div>-->
          <!--          </div>-->
          <!--        </div>-->

          <div class="mt-6 flex gap-3 border-b border-gray-200 pb-5 pt-5">
            <Link @click="addCart(detail.product.id)"
                  class="bg-red-500 border border-red-500 text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-red-500 transition"
            >
              <i class="fa-solid fa-bag-shopping"></i>Sepete Ekle
            </Link>

            <Link v-if="user !== null && user.length !== 0" @click="addFavorite(detail.product.id)"
                  class="border border-gray-300 text-gray-600 px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:text-red-500 transition">

            <span v-if="favorites !== null">
              <span v-if="favorites.product_id === detail.product.id " class="text-red-600">
                <i class="fa-solid fa-heart" title="Favorilerden Kaldır"></i>
              </span>
            </span>

              <span v-else><i class="fa-solid fa-heart" title="Favorilere Ekle"></i></span>
            </Link>

            <Link v-else :href="route('user-login')"
                  class="border border-gray-300 text-gray-600 px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:text-red-500 transition">
              <i class="fa-solid fa-heart"></i>
            </Link>

            <!--          <Link v-if="user" @click="addFavorite(journal.product.id)"-->
            <!--                class="text-white text-lg w-9 h-8 rounded-full bg-red-500 flex items-center justify-center hover:bg-gray-800 transition"-->
            <!--                title="Favorilere Ekle">-->
            <!--            <i class="fa-solid fa-heart"></i>-->
            <!--          </Link>-->
            <!--          <Link v-else href="user-login"-->
            <!--                class="text-white text-lg w-9 h-8 rounded-full bg-red-500 flex items-center justify-center hover:bg-gray-800 transition"-->
            <!--                title="Favorilere Ekle">-->
            <!--            <i class="fa-solid fa-heart"></i>-->
            <!--          </Link>-->
          </div>

          <div class="flex gap-3 mt-4">
            <a href="#"
               class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="#"
               class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
              <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="#"
               class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
              <i class="fa-brands fa-instagram"></i>
            </a>
          </div>

        </div>
      </div>
      <!-- ./product-detail -->

      <!-- description -->
      <div class="container mt-6 pb-16 lg:mx-auto mx-3">
        <h3 class="border-b border-gray-200 font-roboto text-gray-800 pb-3 font-medium">Açıklama</h3>
        <div class="w-3/5 pt-6">
          <div class="text-gray-600">
            <p class="mt-4 text-gray-600">{{ detail.product.description }}</p>
          </div>

        </div>
      </div>
      <!-- ./description -->
    </div>


  </FrontendLayout>


</template>
