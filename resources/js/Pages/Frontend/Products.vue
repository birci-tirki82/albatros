<script setup>

import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Link, useForm, usePage} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {computed, onMounted, reactive, ref} from "vue";
import BaseLevel from "@/components/BaseLevel.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import BaseButton from "@/components/BaseButton.vue";

import Tree from "@/components/Tree.vue";
import {remove} from "lodash";

import TableCheckboxCell from "@/components/TableCheckboxCell.vue";


// const User = computed(() => usePage().props.value.auth.user)
// let user = User.value;

// console.log(user)

const props = defineProps({
  products: Array,
  subCats: Array,
  writers: Array,
  publishers: Array,

})
const prods = ref(props.products);
// const form = useForm({
//   deneme: props.products
// })
// console.log(props.writers[0].id)
function assetsPath() {
  return "../../../assets/images/";
}

function productPath() {
  return "../../../storage/images/products/";
}


const items = computed(() => prods.value);
const perPage = ref(6);
const currentPage = ref(0);
const itemsPaginated = computed(() =>
  items.value.slice(
    perPage.value * currentPage.value,
    perPage.value * (currentPage.value + 1)
  )
);
const numPages = computed(() => Math.ceil(items.value.length / perPage.value));
const currentPageHuman = computed(() => currentPage.value + 1);
const pagesList = computed(() => {
  const pagesList = [];

  for (let i = 0; i < numPages.value; i++) {
    pagesList.push(i);
  }

  return pagesList;
});

const addCart = (id) => {
  // console.log(journalId)
  Inertia.get(route('sepete-ekle', id));
}

const birci = ref([]);
const trues = ref([]);
// const tur = ref('');


const checked = (isChecked) => {

  birci.value = [];
  if (isChecked.check === true) {
    trues.value.push(isChecked);

  } else if (isChecked.check === false) {
    let i = 0;
    trues.value.find((stack, index) => {
      if (stack.tur === isChecked.tur && stack.id === isChecked.id) {
        i = index;
      }
    });
    trues.value.splice(i, 1);
  }

  let isYazar = false;
  let isYayinci = false;

  trues.value.forEach((item, i) => {
    if (item.tur === 'yazar') {
      isYazar = true;
    }
    if (item.tur === 'yayinci') {
      isYayinci = true;
    }
  })

  let wid = [];
  let pid = [];
  trues.value.forEach((item, i) => {
    props.products.forEach((product, index) => {

      if (isYazar === true && isYayinci === false) {
        if (item.id === product.writer_id) {
          birci.value.push(product);
        }
      } else if (isYayinci === true && isYazar === false) {
        if (item.id === product.publisher_id) {
          birci.value.push(product);
        }
      } else if (isYazar === true && isYayinci === true) {

        if (item.tur === 'yazar' && item.id === product.writer_id) {

          if (!wid.includes(product.writer_id)) {
            wid.push(product.writer_id);
          }
        }
        if (item.tur === 'yayinci' && item.id === product.publisher_id) {
          if (!pid.includes(product.publisher_id)) {
            pid.push(product.publisher_id);
          }
        }
      }
    })
  });

  props.products.forEach((product, index) => {
    wid.forEach((w, wi) => {
      pid.forEach((p, pi) => {
        if (product.writer_id === w && product.publisher_id === p) {
          birci.value.push(product);
        }
      });
    });
  });

  if (isYazar === false && isYayinci === false) {
    birci.value = [];
    birci.value = props.products;
  }
  prods.value = birci.value;
};


</script>

<template>

  <FrontendLayout>

<div class="mx-3">
    <!-- breadcrumb -->
    <div class="container py-4 flex items-center gap-3 mx-auto">
      <Link :href="route('/')" class="text-red-500 text-base">
        <i class="fa-solid fa-house"></i>
      </Link>
      <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
      <p class="text-gray-600 font-medium">Ürünler</p>
    </div>
    <!-- ./breadcrumb -->


    <!-- shop wrapper -->
    <div class="container mx-auto grid grid-cols-4 gap-6 pt-4 pb-16 items-start">
      <!-- sidebar -->
      <div class="sm:col-span-2 md:col-span-1 lg:col-span-1 col-span-4  bg-white px-4 pb-6 shadow rounded overflow-hidden">
        <div class="divide-y divide-gray-200 space-y-5">
          <div>
            <h3 class="text-xl text-gray-800 mb-3 font-medium"><strong>Alt Kategoriler</strong></h3>
            <div class="space-y-2 ">

              <!--              <div v-for="category in subCats" class="flex items-center">-->
              <!--                <input type="checkbox" name="cat-1" id="cat-1"-->
              <!--                       class="text-primary focus:ring-0 rounded-sm cursor-pointer">-->
              <!--                <label for="cat-1" class="text-gray-600 ml-3 cusror-pointer">{{ category.name }}</label>-->
              <!--&lt;!&ndash;                <div class="ml-auto text-gray-600 text-sm">({{ products.length }})</div>&ndash;&gt;-->
              <!--&lt;!&ndash;                <div v-else class="ml-auto text-gray-600 text-sm">(2)</div>&ndash;&gt;-->
              <!--              </div>-->

              <div class="flex items-center">
                <tree class="text-gray-600 ml-3 cusror-pointer" :tree-data="subCats"></tree>
              </div>

            </div>
          </div>

          <div v-if="writers" class="pt-4 leading-none">
            <h3 class="text-xl text-gray-800 mb-3 font-medium"><strong>Yazarlar</strong></h3>
            <div class="space-y-2 leading-3">

              <div v-for="writer in writers" class="flex items-center ">
                <TableCheckboxCell
                  @checked="checked({id: writer.id, check: $event, tur: 'yazar'})"
                />
                <label class="text-gray-600 ml-3 cusror-pointer">{{ writer.name + ' ' + writer.lastname }}</label>
                <!--                <input type="checkbox" :id="writer.id" :value="writer.name" id="yazar" @checked="checked($event, writer)"-->
                <!--                       class="text-primary focus:ring-0 rounded-sm cursor-pointer">-->
                <!--                <label for="yazar" class="text-gray-600 ml-3 cusror-pointer">{{ writer.name + ' ' + writer.lastname }}</label>-->
              </div>


            </div>
          </div>

          <div class="pt-4 leading-none">
            <h3 class="text-xl text-gray-800 mb-3 font-medium"><strong>Yayıncılar</strong></h3>
            <div class="space-y-2 leading-none">

              <div v-for="publisher in publishers" class="flex items-center">
                <TableCheckboxCell
                  @checked="checked({id: publisher.id, check: $event, tur: 'yayinci'})"
                />
                <label class="text-gray-600 ml-3 cusror-pointer">{{ publisher.name }}</label>
                <!--                <input type="checkbox" name="publisher" id="publisher"-->
                <!--                       class="text-primary focus:ring-0 rounded-sm cursor-pointer">-->
                <!--                <label for="publisher" class="text-gray-600 ml-3 cusror-pointer">{{ publisher.name }}</label>-->
                <!--                <div class="ml-auto text-gray-600 text-sm">(15)</div>-->
              </div>

            </div>
          </div>

          <div class="pt-4">
            <h3 class="text-xl text-gray-800 mb-3 font-medium"><strong>Fiyat Aralığı</strong></h3>
            <div class="mt-4 flex items-center">
              <input type="text" name="min" id="min"
                     class="w-full border-gray-300 focus:border-red-500 rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                     placeholder="min">
              <span class="mx-3 text-gray-500">-</span>
              <input type="text" name="max" id="max"
                     class="w-full border-gray-300 focus:border-red-500 rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                     placeholder="max">
            </div>
          </div>

          <!--          <div class="pt-4">-->
          <!--            <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">size</h3>-->
          <!--            <div class="flex items-center gap-2">-->
          <!--              <div class="size-selector">-->
          <!--                <input type="radio" name="size" id="size-xs" class="hidden">-->
          <!--                <label for="size-xs"-->
          <!--                       class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">XS</label>-->
          <!--              </div>-->
          <!--              <div class="size-selector">-->
          <!--                <input type="radio" name="size" id="size-sm" class="hidden">-->
          <!--                <label for="size-sm"-->
          <!--                       class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">S</label>-->
          <!--              </div>-->
          <!--              <div class="size-selector">-->
          <!--                <input type="radio" name="size" id="size-m" class="hidden">-->
          <!--                <label for="size-m"-->
          <!--                       class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">M</label>-->
          <!--              </div>-->
          <!--              <div class="size-selector">-->
          <!--                <input type="radio" name="size" id="size-l" class="hidden">-->
          <!--                <label for="size-l"-->
          <!--                       class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">L</label>-->
          <!--              </div>-->
          <!--              <div class="size-selector">-->
          <!--                <input type="radio" name="size" id="size-xl" class="hidden">-->
          <!--                <label for="size-xl"-->
          <!--                       class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">XL</label>-->
          <!--              </div>-->
          <!--            </div>-->
          <!--          </div>-->

          <!--          <div class="pt-4">-->
          <!--            <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Color</h3>-->
          <!--            <div class="flex items-center gap-2">-->
          <!--              <div class="color-selector">-->
          <!--                <input type="radio" name="color" id="red" class="hidden">-->
          <!--                <label for="red"-->
          <!--                       class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"-->
          <!--                       style="background-color: #fc3d57;"></label>-->
          <!--              </div>-->
          <!--              <div class="color-selector">-->
          <!--                <input type="radio" name="color" id="black" class="hidden">-->
          <!--                <label for="black"-->
          <!--                       class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"-->
          <!--                       style="background-color: #000;"></label>-->
          <!--              </div>-->
          <!--              <div class="color-selector">-->
          <!--                <input type="radio" name="color" id="white" class="hidden">-->
          <!--                <label for="white"-->
          <!--                       class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"-->
          <!--                       style="background-color: #fff;"></label>-->
          <!--              </div>-->

          <!--            </div>-->
          <!--          </div>-->

        </div>
      </div>
      <!-- ./sidebar -->

      <!-- products -->


      <div class="col-span-4 lg:col-span-3 md:col-span-3 sm:col-span-2">
        <div class="flex items-center mb-4">
          <select name="sort" id="sort"
                  class="w-44 text-sm text-gray-600 py-3 px-4 border-gray-300 shadow-sm rounded focus:ring-red-500 focus:border-red-500">
            <option value="">Sırala</option>
            <option value="price-low-to-high">En Düşük Fiyat</option>
            <option value="price-high-to-low">En Yüksek Fiyat</option>
            <option value="latest">Çok Satanlar</option>
            <option value="latest">En Favoriler</option>
            <option value="latest">En Çok Değerlendirilen</option>
          </select>

          <div class="flex gap-2 ml-auto">
            <div
              class="border border-red-500 w-10 h-9 flex items-center justify-center text-white bg-red-500 rounded cursor-pointer">
              <i class="fa-solid fa-grip-vertical"></i>
            </div>
            <div
              class="border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 rounded cursor-pointer">
              <i class="fa-solid fa-list"></i>
            </div>
          </div>
        </div>


        <div class="grid grid-cols-3 gap-6 mx-auto">

          <div v-for="prod in itemsPaginated" class="bg-white shadow rounded overflow-hidden group lg:col-span-1 md:col-span-1 sm:col-span-3 col-span-3">


            <div class="relative">
              <img :src="productPath() + prod.product.image" alt="product 1" class="w-full">
              <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center
                        justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                <!--                <a href="#"-->
                <!--                   class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"-->
                <!--                   title="view product">-->
                <!--                  <i class="fa-solid fa-magnifying-glass"></i>-->
                <!--                </a>-->
                <!--                <a href="#"-->
                <!--                   class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"-->
                <!--                   title="add to wishlist">-->
                <!--                  <i class="fa-solid fa-heart"></i>-->
                <!--                </a>-->
              </div>
            </div>

            <div class="pt-4 pb-3 px-4">

              <Link v-if="prod.product.tur === 'book'"
                    :href="route('urun', { slug: prod.product.slug, id:prod.product_id })">
                <h4 class=" font-medium text-x mb-2 text-gray-800 hover:text-red-500 transition">{{ prod.product.name }}</h4>

              </Link>
              <Link v-else-if="prod.product.tur === 'journal'"
                    :href="route('urun', { slug: prod.product.slug, id:prod.product_id })">
                <h4 class=" font-medium text-x mb-2 text-gray-800 hover:text-red-500 transition">
                  {{ prod.product.name }}</h4>
              </Link>

              <div v-if="writers" class="text-sm my-2">
                <p>{{ prod.writer.name + ' ' + prod.writer.lastname }}</p>
              </div>
              <div class="text-xs my-2 text-red-600">
                -{{ prod.publisher.name }}-
              </div>

              <div class="flex items-baseline mb-1 space-x-2">


                <p v-if="prod.product.price !== null" class="text-xl font-bold">
                  ₺{{ prod.product.price }}</p>

                <p v-else class="text-xl font-bold">₺{{ prod.product.old_price }}</p>

                <p v-if="prod.product.price !== prod.product.old_price && prod.product.price !== null"
                   class="text-base text-gray-400 line-through">₺{{ prod.product.old_price }}</p>


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
            <Link @click="addCart(prod.product.id)"
                  class="block w-full py-1 text-center text-white bg-red-500 border border-red-500 rounded-b hover:bg-transparent hover:text-red-500 transition">
              Sepete Ekle
            </Link>
          </div>

        </div>
      </div>
    </div>


    <div class="rounded-md flex items-center justify-center p-4 lg:px-6 border-t border-gray-500 dark:border-slate-800 mx-auto">
      <BaseLevel>
        <BaseButtons>
          <BaseButton
            v-for="page in pagesList"
            :key="page"
            :active="page === currentPage"
            :label="page + 1"
            :color="page === currentPage ? 'lightDark' : 'whiteDark'"
            small
            @click="currentPage = page"
          />
        </BaseButtons>
        <small class="tracking-wide "> Sayfa  {{ currentPageHuman }} / {{ numPages }}</small>
      </BaseLevel>
    </div>
    <!-- ./shop wrapper -->
</div>
  </FrontendLayout>


</template>
