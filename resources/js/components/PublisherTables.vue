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
  publishers: {
    type: Array,
    default: null,
  },
  yol: {
    type: String,
    default: null
  },
  catid: {
    type: Number,
    default: null
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




let mode = null;
const omer = (mode) => {
  selami.value = mode;
}
const selami = () => {}


const destroy = () => {
    Inertia.delete(route('publisher.destroy',selami.value));
  }
const update = () => {
  // console.log(selami.value)
    Inertia.get(route('publisher.edit',selami.value));
  }


</script>

<template>

  <CardBoxModal
    v-model="isModalActive"
    title="G??ncelle"
    @update:modelValue="update"
  >
    <p>Se??ilen <b>yay??n evi'ni</b>
    d??zenleme </p><p>ekran??na y??nlendirileceksiniz!!</p>
  </CardBoxModal>

  <CardBoxModal
    v-model="isModalDangerActive"
    title="Uyar??!!"
    button="danger"
    @Onayla="destroy"
    has-cancel
  >
    <p>Se??ilen <b>yay??n evini</b>
    silmek</p> <p>istedi??inize emin misiniz??</p>
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
      <th>Yay??n Evi ??sim</th>
<!--      <th>Aktif/Pasif</th>-->
      <th>????lemler</th>
    </tr>
    </thead>
    <tbody>
    <tr v-if="publishers.length>0" v-for="publisher in publishers" :key="publisher.id">
      <TableCheckboxCell
        v-if="checkable"
        @checked="checked($event, publisher)"
      />
      <td class="border-b-0 lg:w-6 before:hidden">
        <UserAvatar
          :username="publisher.name"
          class="w-24 h-24 mx-auto lg:w-6 lg:h-6"
        />
      </td>
      <td data-label="Name">
        {{ publisher.name }}
      </td>
<!--      <td data-label="Aktif/Pasif">-->
<!--        {{ publisher.is_active ? 'Aktif' : 'Pasif' }}-->
<!--      </td>-->



<!--      <td data-label="Progress" class="lg:w-32">-->
<!--        <progress-->
<!--          class="flex w-2/5 self-center lg:w-full"-->
<!--          max="100"-->
<!--          :value="publisher.id"-->
<!--        >-->
<!--          {{ publisher.id }}-->
<!--        </progress>-->
<!--      </td>-->

<!--      <td data-label="Created" class="lg:w-1 whitespace-nowrap">-->
<!--        <small-->
<!--          class="text-gray-500 dark:text-slate-400"-->
<!--          :title="publisher.created"-->
<!--        >{{ publisher.name }}</small-->
<!--        >-->
<!--      </td>-->

      <td class="before:hidden lg:w-1 whitespace-nowrap">
        <BaseButtons type="justify-start lg:justify-end" no-wrap>
          <BaseButton
            color="info"
            :icon="mdiGreasePencil"
            small
            @click="isModalActive = true; omer(publisher.id)"
          />
          <BaseButton
            color="danger"
            :icon="mdiTrashCan"
            small
            @click="isModalDangerActive = true; omer(publisher.id)"
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
