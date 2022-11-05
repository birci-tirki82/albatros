<script setup>
import { computed, ref } from "vue";
import { useMainStore } from "@/stores/main";
import {  mdiTrashCan, mdiGreasePencil } from "@mdi/js";
import CardBoxModal from "@/components/CardBoxModal.vue";
import TableCheckboxCell from "@/components/TableCheckboxCell.vue";
import BaseLevel from "@/components/BaseLevel.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import BaseButton from "@/components/BaseButton.vue";
import UserAvatar from "@/components/UserAvatar.vue";
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";


// function destroy(category) {
//   if (confirm(category.name + " isimli kategori silinecek!!"))
//     Inertia.delete(route('category.destroy',category.id));
// }


const props = defineProps({
  categories: {
    type: Array,
    default: null,
  },
  // yol: {
  //   type: String,
  //   default: null
  // },
  // catid: {
  //   type: Number,
  //   default: null
  // },
  checkable: Boolean,
},
  // watch(() => props.modelValue, (newValue) => {
  //   console.log("newValue");
  // })
);
// console.log(props.categories.last_page)


// const mainStore = useMainStore();

const items = computed(() => props.categories);

const isModalActive = ref(false);

const isModalDangerActive = ref(false);

const perPage = ref(5);

const currentPage = ref(0);

const checkedRows = ref([]);

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

const remove = (arr, cb) => {
  const newArr = [];

  arr.forEach((item) => {
    if (!cb(item)) {
      newArr.push(item);
    }
  });

  return newArr;
};

const checked = (isChecked, client) => {
  if (isChecked) {
    checkedRows.value.push(client);
  } else {
    checkedRows.value = remove(
      checkedRows.value,
      (row) => row.id === client.id
    );
  }
};

// const aa = useForm({
//   katid: '',
// })
// const cemsit = "selami";
// let vada = null;
// const cemsit = (category_id) => {
//   vada = category_id
//   // console.log(vada)
// }
// const vada =0;
// let omer = "";
// function omerov(id){
//
//   // console.log(id);
//     omer = id;
//
//   }

let mode = null;
const omer = (mode) => {
  selami.value = mode;
}
const selami = () => {}
const destroy = () => {
    Inertia.delete(route('category.destroy',selami.value));
  }
const update = () => {
  // console.log(selami.value)
    Inertia.get(route('category.edit',selami.value));
  }
// setup(props) {
//   watch(() => props.modelValue, (newValue) => {
//     // do something
//   })
// }
// const yol = "category.destroy";
// const catid = "category.destroy";
//   console.log(aa.vada);
// function cemsit(category_id){
//   // return vada = category_id;
//
//   props.vada=category_id;
//   console.log(props.vada);
// }
// console.log(vada)
// function omer() {
//   // console.log(props.katid)
//   props.katid = 'hahaha'
//   // console.log("sss")
// }


// console.log(props.categories);

</script>

<template>

  <CardBoxModal
    v-model="isModalActive"
    title="Güncelle"
    @update:modelValue="update"
  >
    <p>Seçilen <b>kategori</b>
    düzenleme </p><p>ekranına yönlendirileceksiniz!!</p>
  </CardBoxModal>

  <CardBoxModal
    v-model="isModalDangerActive"
    title="Uyarı!!"
    button="danger"
    @Onayla="destroy"
    has-cancel
  >
    <p>Seçilen <b>kategoriyi</b>
    silmek</p> <p>istediğinize emin misiniz??</p>
  </CardBoxModal>

  <div v-if="checkedRows.length" class="p-3 bg-gray-100/50 dark:bg-slate-800">
                          <span
                            v-for="checkedRow in checkedRows"
                            :key="checkedRow.id"
                            class="inline-block px-2 py-1 rounded-sm mr-2 text-sm bg-gray-100 dark:bg-slate-700"
                          >
                            {{ checkedRow.name }}
                          </span>
  </div>



  <table>
    <thead>
    <tr>
      <th v-if="checkable" />
      <th />
      <th>Kategori Adı</th>
      <th>Tür</th>
<!--      <th>Slug</th>-->
      <th>Aktif/Pasif</th>
      <th>İşlemler</th>
    </tr>
    </thead>
    <tbody>
    <tr v-if="categories.length > 0" v-for="category in itemsPaginated" :key="category.id">
      <TableCheckboxCell
        v-if="checkable"
        @checked="checked($event, category)"
      />
      <td class="border-b-0 lg:w-6 before:hidden">
        <UserAvatar
          :username="category.name"
          class="w-24 h-24 mx-auto lg:w-6 lg:h-6"
        />
      </td>
      <td data-label="Kategori İsim">
        {{ category.name }}
        <ul v-for="value in categories" :key="value.id" >
          <li class="text-blue-400" v-if="category.id === value.parent_id">-> {{ value.name }}</li>
        </ul>
      </td>

      <td data-label="Slug">
        {{ category.tur === 'book' ? 'Kitap' : 'Dergi' }}
      </td>

<!--      <td data-label="Slug">-->
<!--        {{ category.slug }}-->
<!--      </td>-->

      <td data-label="Aktif/Pasif">
        {{ category.is_active ? 'Aktif' : 'Pasif' }}
      </td>

<!--      <td data-label="Progress" class="lg:w-32">-->
<!--        <progress-->
<!--          class="flex w-2/5 self-center lg:w-full"-->
<!--          max="100"-->
<!--          :value="category.id"-->
<!--        >-->
<!--          {{ category.id }}-->
<!--        </progress>-->
<!--      </td>-->

<!--      <td data-label="Created" class="lg:w-1 whitespace-nowrap">-->
<!--        <small-->
<!--          class="text-gray-500 dark:text-slate-400"-->
<!--          :title="category.created"-->
<!--        >{{ category.name }}</small-->
<!--        >-->
<!--      </td>-->

      <td class="before:hidden lg:w-1 whitespace-nowrap">
        <BaseButtons type="justify-start lg:justify-end" no-wrap>
          <BaseButton
            color="info"
            :icon="mdiGreasePencil"
            small
            @click="isModalActive = true; omer(category.id)"
          />
          <BaseButton
            color="danger"
            :icon="mdiTrashCan"
            small
            @click="isModalDangerActive = true; omer(category.id)"
          />
        </BaseButtons>
      </td>
    </tr>
    <tr v-else>
      <td class="col-span-full h-4 bg-teal-400">Herhangi bir veri yok.</td>
    </tr>
    </tbody>
  </table>


<!--  <div class="p-3 lg:px-6 border-t border-gray-100 dark:border-slate-800">-->
<!--    <BaseLevel>-->
<!--      <BaseButtons>-->
<!--        <BaseButton-->
<!--          v-for="page in pagesList"-->
<!--          :key="page"-->
<!--          :active="page === currentPage"-->
<!--          :label="page + 1"-->
<!--          :color="page === currentPage ? 'lightDark' : 'whiteDark'"-->
<!--          small-->
<!--          @click="currentPage = page"-->
<!--        />-->
<!--      </BaseButtons>-->
<!--      <small>Page {{ currentPageHuman }} of {{ numPages }}</small>-->
<!--    </BaseLevel>-->
<!--  </div>-->

  <div class="p-3 lg:px-6 border-t border-gray-100 dark:border-slate-800">
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
      <small>Sayfa {{ currentPageHuman }} / {{ numPages }}</small>
    </BaseLevel>
  </div>



</template>
