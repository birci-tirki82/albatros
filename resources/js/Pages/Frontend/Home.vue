<script setup>

import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Head, Link} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
  user: Array,
  // products: Array,
  journals: Array,
  books: Array,
  cats: Array,
});

// const newjournal =
// console.log(props.user)

function Path() {
  return "../../../storage/images/products/";
}

function categoryPath() {
  return "../../../assets/images/category/";
}


const addCart = (id) => {
  Inertia.get(route('sepete-ekle', id));
}

const title = 'Anasayfa';

</script>

<template>

  <FrontendLayout :cats="cats">

    <Head>
      <title>{{ title }}</title>
      <meta type="description" content="deneme" head-key="description">
    </Head>

    <!-- banner -->
    <div class="bg-cover bg-no-repeat bg-center py-36" style="background-image: url('assets/images/slide2.png');">

      <div class="container">
        <h1 class="lg:text-6xl md:text-5xl sm:text-4xl text-2xl  text-gray-700 font-medium mb-4 capitalize ml-12">
          Kitaplarla buluşmanın <br> en kolay ve keyifli adresi...
        </h1>
        <p class="lg:text-xl md:text-base sm:text-sm text-xs text-gray-800  py-3 ml-12">Sitemizden istediğiniz ürüne
          kolayca
          sahip olabilirsiniz. <br>
          Aradığınız tüm kitaplar ve dergiler bi tık yakınınızda..</p>
        <div class="mt-12 transition ease-in-out  hover:-translate-y-1  duration-300">
          <Link :href="route('kategori',{ cat: 'kitap'})" class=" hover:bg-red-600 bg-red-500 text-white px-8 py-3 font-medium
                    rounded-md ml-12">Alışverişe Başla
          </Link>
        </div>
      </div>

    </div>
    <!-- ./banner -->

    <!-- features -->
    <div class="container mx-auto py-16 justify-items-center">
      <div class="w-10/12 grid sm:grid-cols-1  lg:grid-cols-3 gap-6 mx-auto justify-center">

        <div
          class="transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110 hover:bg-gray-50 duration-300 grid-cols-1 border border-red-500 rounded-md px-3 py-6 flex justify-center items-center gap-5">
          <img src="assets/images/icons/delivery-van.svg" alt="Delivery"
               class="sm:inline-block w-12 h-12 object-contain">
          <div>
            <h4 class="font-medium capitalize text-lg">Hızlı Kargo</h4>
            <p class="text-gray-500 text-sm">Hızlı ve güvenilir kargo</p>
          </div>
        </div>

        <div
          class="transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110 hover:bg-gray-50 duration-300 grid-cols-1 border border-red-500 rounded-md px-3 py-6 flex justify-center items-center gap-5">
          <img src="assets/images/icons/money-back.svg" alt="Delivery" class="w-12 h-12 object-contain">
          <div>
            <h4 class="font-medium capitalize text-lg">Para İadesi</h4>
            <p class="text-gray-500 text-sm">30 gün içinde para iadesi</p>
          </div>
        </div>

        <div
          class="transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110 hover:bg-gray-50 duration-300 grid-cols-1 border border-red-500 rounded-md px-3 py-6 flex justify-center items-center gap-5">
          <img src="assets/images/icons/service-hours.svg" alt="Delivery" class="w-12 h-12 object-contain">
          <div>
            <h4 class="font-medium capitalize text-lg">Ücretsiz
              İade ve Değişim</h4>
            <p class="text-gray-500 text-sm">Günün her saati sipariş ver</p>
          </div>
        </div>
      </div>
    </div>
    <!-- ./features -->


    <!-- categories -->
    <div class="container mx-auto py-16">
      <h2 class="text-2xl font-medium text-gray-800 mb-6 text-center">Popüler Kategoriler</h2>
      <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 grid-cols-1 gap-3">

        <div class="relative rounded-sm overflow-hidden group">
          <img :src="categoryPath() + 'klasik.jpg'" alt="category 1" class="bg-cover w-full">
          <Link :href="route('kategori',{ cat: 'klasik'})"
                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-10 transition"></Link>
        </div>

        <div class="relative rounded-md overflow-hidden group">
          <img :src="categoryPath() + 'edebiyat.jpg'" alt="category 1" class="w-full">
          <Link :href="route('kategori',{ cat: 'edebiyat'})"
                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-10 transition"></Link>
        </div>
        <div class="relative rounded-md overflow-hidden group">
          <img :src="categoryPath() + 'romantik.jpg'" alt="category 1" class="w-full">
          <Link :href="route('kategori',{ cat: 'romantik'})"
                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-10 transition">
          </Link>
        </div>
        <div class="relative rounded-md overflow-hidden group">
          <img :src="categoryPath() + 'siir.jpg'" alt="category 1" class="w-full">
          <Link :href="route('kategori',{ cat: 'siir'})"
                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-10 transition"></Link>
        </div>
        <div class="relative rounded-md overflow-hidden group">
          <img :src="categoryPath() + 'astroloji.jpg'" alt="category 1" class="w-full">
          <Link :href="route('kategori',{ cat: 'astroloji'})"
                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-10 transition"></Link>
        </div>
        <div class="relative rounded-md overflow-hidden group">
          <img :src="categoryPath() + 'klasik.jpg'" alt="category 1" class="w-full">
          <Link :href="route('kategori',{ cat: 'klasik'})"
                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-10 transition"></Link>
        </div>

      </div>
    </div>
    <!-- ./categories -->


    <!-- new arrival -->
    <div v-if="journals.length > 0" class="container mx-auto pb-16 text-center">

      <h2 class="text-2xl font-mono text-gray-600 mb-6 py-12">Çok Satan Dergiler</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4">

        <div v-for="journal in journals" class="rounded-md flex items-center justify-center">

          <div class="bg-white shadow rounded overflow-hidden group col-span-4">
            <div class="relative">


              <img :src="Path() + journal.product.image" class="w-full">

              <!--            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center-->
              <!--                    justify-center gap-2 opacity-0 group-hover:opacity-100 transition">-->
              <!--              <a href="#"-->
              <!--                 class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"-->
              <!--                 title="Ürün Detayı">-->
              <!--                <i class="fa-solid fa-magnifying-glass"></i>-->
              <!--              </a>-->
              <!--              <Link v-if="user" @click="addFavorite(journal.product.id)"-->
              <!--                 class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"-->
              <!--                 title="Favorilere Ekle">-->
              <!--                <i class="fa-solid fa-heart"></i>-->
              <!--              </Link>-->
              <!--              <Link v-else href="user-login"-->
              <!--                 class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"-->
              <!--                 title="Favorilere Ekle">-->
              <!--                <i class="fa-solid fa-heart"></i>-->
              <!--              </Link>-->
              <!--            </div>-->
            </div>

            <div class="pt-4 pb-3 px-4">
              <Link :href="route('urun', { slug:journal.product.slug, id:journal.product_id })">
                <h4 class="font-medium text-x mb-2 text-gray-800 hover:text-red-500 transition">
                  {{ journal.product.name }}</h4>
              </Link>

              <div class="flex items-baseline mb-1 space-x-2">
                <p v-if="journal.product.price !== null" class="text-xl  font-bold">₺{{ journal.product.price }}</p>
                <p v-else class="text-xl  font-bold">₺{{ journal.product.old_price }}</p>
                <p v-if="journal.product.price !== journal.product.old_price && journal.product.price !== null"
                   class="text-sm text-gray-400 line-through">₺{{ journal.product.old_price }}</p>
              </div>

              <div class="flex items-center">
                <div class="flex gap-1 text-sm text-yellow-400">
                  <span><i class="fa-solid fa-star"></i></span>
                  <span><i class="fa-solid fa-star"></i></span>
                  <span><i class="fa-solid fa-star"></i></span>
                  <span><i class="fa-solid fa-star"></i></span>
                  <span><i class="fa-solid fa-star"></i></span>
                </div>
                <div class="text-xs text-gray-500 ml-3">(150)</div>
              </div>
            </div>
            <Link @click="addCart(journal.product.id)"
                  class="block w-full py-1 text-center text-white bg-red-500 border border-red-500 rounded-b hover:bg-transparent hover:text-red-500 transition">
              Sepete Ekle
            </Link>
          </div>
        </div>

      </div>
    </div>
    <!-- ./new arrival -->
    <!-- ads -->
    <div class="container mx-auto pb-16">
      <!--      <a href="#">-->
      <img src="assets/images/orta.png" alt="ads" class="w-full">
      <!--      </a>-->
    </div>
    <!-- ./ads -->
    <!-- product -->
    <div v-if="books.length > 0" class="container mx-auto pb-16 text-center">
      <h2 class="text-2xl font-mono text-gray-600 mb-6 py-12">Çok Satan Kitaplar</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4 ">

        <!--        <div v-for="book in books" class="grid sm:grid-cols-4  md:grid-cols-8 lg:grid-cols-12  gap-14">-->
        <div v-for="book in books" class="rounded-md flex items-center justify-center">

          <div class="bg-white shadow rounded overflow-hidden group col-span-4">
            <div class="relative">
              <img :src="Path() + book.product.image" alt="product 1" class="w-full bg-cover">
              <!--              <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center-->
              <!--                        justify-center gap-2 opacity-0 group-hover:opacity-100 transition">-->
              <!--                &lt;!&ndash;                <a href="product.html" class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition" title="view product">&ndash;&gt;-->
              <!--                &lt;!&ndash;                  <i class="fa-solid fa-magnifying-glass"></i>&ndash;&gt;-->
              <!--                &lt;!&ndash;                </a>&ndash;&gt;-->
              <!--                &lt;!&ndash;                <a href="wishlist.html" class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition" title="add to wishlist">&ndash;&gt;-->
              <!--                &lt;!&ndash;                  <i class="fa-solid fa-heart"></i>&ndash;&gt;-->
              <!--                &lt;!&ndash;                </a>&ndash;&gt;-->
              <!--              </div>-->
            </div>
            <div class="pt-4 pb-3 px-4">
              <Link :href="route('urun', { slug:book.product.slug, id:book.product_id })">
                <h4 class="font-medium text-lg mb-2 text-gray-800 hover:text-red-500 transition">
                  {{ book.product.name }}</h4>

                <div class="text-sm my-2">
                  <p>{{ book.writer.name + ' ' + book.writer.lastname }}</p>
                </div>
              </Link>
              <div class="flex items-baseline mb-1 mt-1 space-x-2">
                <p v-if="book.product.price !== null" class="text-xl  font-bold">₺{{ book.product.price }}</p>
                <p v-else class="text-xl  font-bold">₺{{ book.product.old_price }}</p>
                <p v-if="book.product.price !== book.product.old_price && book.product.price !== null"
                   class="text-sm text-gray-400 line-through">₺{{ book.product.old_price }}</p>
              </div>
              <div class="flex items-center">
                <div class="flex gap-1 text-sm text-yellow-400">
                  <span><i class="fa-solid fa-star"></i></span>
                  <span><i class="fa-solid fa-star"></i></span>
                  <span><i class="fa-solid fa-star"></i></span>
                  <span><i class="fa-solid fa-star"></i></span>
                  <span><i class="fa-solid fa-star"></i></span>
                </div>
                <div class="text-xs text-gray-500 ml-3">(150)</div>
              </div>
            </div>
            <Link @click="addCart(book.product.id)"
                  class="block w-full py-1 text-center text-white bg-red-500 border border-red-500 rounded-b hover:bg-transparent hover:text-red-500 transition">
              Sepete Ekle
            </Link>
          </div>

        </div>

      </div>
    </div>
    <!-- ./product -->
  </FrontendLayout>


</template>
