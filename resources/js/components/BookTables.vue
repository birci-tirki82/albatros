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


const props = defineProps({
  books: {
    type: Array,
    default: null,
  },
  writer: {
    type: Array,
  },
  category: {
    type: Array,
  },
  publisher: {
    type: Array,
  },
  checkable: Boolean,
},
);

const mainStore = useMainStore();


const items = computed(() => mainStore.clients);

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


// let mode = null;
const omer = (mode) => {
  selami.value = mode;
}
const selami = () => {}


const destroy = () => {
    Inertia.delete(route('book.destroy',selami.value));
  }
const update = () => {
    Inertia.get(route('book.edit',selami.value));
  }

</script>

<template>

  <div v-if="$page.props.flash.message" class="alert">
    {{ $page.props.flash.message }}
  </div>

  <CardBoxModal
    v-model="isModalActive"
    title="Güncelle"
    @update:modelValue="update"
  >
    <p>Seçilen <b>kitab'ı</b>
    düzenleme </p><p>ekranına yönlendirileceksiniz!!</p>
  </CardBoxModal>

  <CardBoxModal
    v-model="isModalDangerActive"
    title="Uyarı!!"
    button="danger"
    @Onayla="destroy"
    has-cancel
  >
    <p>Seçilen <b>kitab'ı</b>
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
      <th>Kitap Adı</th>
      <th>Yazar Adı</th>
      <th>Yayın Evi Adı</th>
      <th>Kategori</th>
      <th>Tür(Type)</th>
      <th>Fiyat</th>
      <th>İndirimli Fiyat</th>
      <th>Stok</th>
      <th>İşlemler</th>
    </tr>
    </thead>
    <tbody>
    <tr v-if="books.length > 0" v-for="book in books" :key="book.id">

      <td data-label="Kitap Adı">
        {{ book.product.name }}
      </td>

      <td v-if="book.writer" data-label="Yazar Adı">
        {{ book.writer.name + ' ' + book.writer.lastname }}
      </td>
      <td v-else data-label="Yazar Adı">
        Dergi
      </td>

      <td data-label="Yayın Evi Adı">
        {{ book.publisher.name }}
      </td>

      <td data-label="Kategori">
        {{ book.product.category.name }}
      </td>

      <td data-label="Kitap tipi">
        {{ book.type }}
      </td>

      <td data-label="Fiyat">
        ₺{{ book.product.old_price }}
      </td>

      <td v-if="book.product.price === null" data-label="İndirimli Fiyat">
        -
      </td>

      <td v-else data-label="İndirimli Fiyat">
        ₺{{ book.product.price }}
      </td>

      <td data-label="Stok">
        {{ book.product.stok }}
      </td>


      <td class="before:hidden lg:w-1 whitespace-nowrap">
        <BaseButtons type="justify-start lg:justify-end" no-wrap>
          <BaseButton
            color="info"
            :icon="mdiGreasePencil"
            small
            @click="isModalActive = true; omer(book.id)"
          />
          <BaseButton
            color="danger"
            :icon="mdiTrashCan"
            small
            @click="isModalDangerActive = true; omer(book.id)"
          />
        </BaseButtons>
      </td>


    </tr>
    <tr v-else>
      <td class="col-span-full h-4 bg-teal-400">Herhangi bir veri yok.</td>
    </tr>
    </tbody>
  </table>
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
      <small>Page {{ currentPageHuman }} of {{ numPages }}</small>
    </BaseLevel>
  </div>
</template>
