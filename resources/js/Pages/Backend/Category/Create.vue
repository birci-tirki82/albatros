<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import { Head } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import SectionMain from "@/components/SectionMain.vue";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import {computed, reactive, ref, watch} from "vue";
import { mdiBallotOutline, mdiAccount, mdiMail, mdiPlaySpeed, mdiRenameBox } from "@mdi/js";
import FormCheckRadioGroup from "@/components/FormCheckRadioGroup.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import FormValidationErrors from '@/components/FormValidationErrors.vue'


const props = defineProps({
  categories: Array,
  books: Array,
  journals: Array,
  // list: Array,
});




// nebati('book');




// const getSlug = {
//   getslug:
// }


let list = [];
list.push({
  id: 0, label: "Ana Kategori"});
// console.log(list[0].label)


// let books = [];
// let journals = [];
let bookcategory = [];
let journalcategory = [];

bookcategory.push({
  id: 0, label: "Ana Kategori"});
props.books.forEach((value, index) => {
  bookcategory.push({
    id : value.id, label: value.name})
});

journalcategory.push({
  id: 0, label: "Ana Kategori"});
props.journals.forEach((value, index) => {
  journalcategory.push({
    id: value.id, label: value.name})
});
// console.log(journalcategory)
// function neocat() {
//   // console.log(form.tur)
//
//
//
//   props.categories.forEach((value, index) => {
//     if (value.tur === 'book'){
//       books.push(value);
//     }else if (value.tur === 'journal'){
//       journals.push(value);
//     }
//   });
//
//   list = [];
//   list.push({
//     id: 0, label: "Ana Kategori",
//   });
//
//   if (form.tur === "book") {
//     books.forEach((value, index) => {
//       list.push({
//         id: value.id, label: value.name,
//       });
//       // console.log(list);
//
//     });
//
//   }
//   else if (form.tur === "journal") {
//     journals.forEach((value, index) => {
//       list.push({
//         id: value.id, label: value.name,
//       });
//       // console.log(list);
//
//     });
//
//   }
//   // console.log(books);
//
//   // console.log(this.list);
// }

const form = reactive({
  name: "",
  tur: "book",
  // slug: "",
  is_active: 1,
  parent_id: list[0],
});
// console.log(form.tur);


// console.log(books);
// console.log(journals);

// neocat();

// watch:{
//   'form.parent_id': function() {
//     neocat();
//   }
// };





// const customElementsForm = reactive({
//   checkbox: ["lorem"],
//   radio: "one",
//   switch: ["one"],
//   file: null,
// });

function submit() {
  Inertia.post(route('category.store'), form)
}

const formStatusWithHeader = ref(true);

const formStatusCurrent = ref(0);

const formStatusOptions = ["info", "success", "danger", "warning"];

const formStatusSubmit = () => {
  formStatusCurrent.value = formStatusOptions[formStatusCurrent.value + 1]
    ? formStatusCurrent.value + 1
    : 0;
};

// function changevalue($event){
//   // return list;
// }



</script>

<template>
    <Head title="CategoryCreate" />

  <LayoutAuthenticated>

<!--    <form class="block w-96 bg-white shadow-lg p-8 rounded-xl">-->
<!--      <h3 class="text-base mb-4">Payment</h3>-->

<!--      <div class="relative z-0 w-full mb-5">-->
<!--        <input type="text" name="cc" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 border-gray-200 font-sans" />-->
<!--        <label for="cc" class="absolute duration-200 top-3 -z-1 origin-0 text-gray-500 text-base">Card number</label>-->
<!--      </div>-->

<!--      <div class="grid grid-cols-2 gap-4">-->
<!--        <div class="relative z-0 w-full mb-5">-->
<!--          <input type="text" name="dd" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 border-gray-200 font-sans" />-->
<!--          <label for="dd" class="absolute duration-200 top-3 -z-1 origin-0 text-gray-500 text-base">DD</label>-->
<!--        </div>-->
<!--        <div class="relative z-0 w-full mb-5">-->
<!--          <input type="text" name="mm" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 border-gray-200 font-sans" />-->
<!--          <label for="mm" class="absolute duration-200 top-3 -z-1 origin-0 text-gray-500 text-base">MM</label>-->
<!--        </div>-->
<!--      </div>-->

<!--      <div class="relative z-0 w-full mb-5">-->
<!--        <input type="text" name="cvv" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 border-gray-200 font-sans" />-->
<!--        <label for="cvv" class="absolute duration-200 top-3 -z-1 origin-0 text-gray-500 text-base">CVV</label>-->
<!--      </div>-->

<!--      <button class="rounded-xl bg-indigo-600 mt-8 block text-center text-white px-4 py-2 text-sm">Pay now ($1,243)</button>-->
<!--    </form>-->


    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiBallotOutline"
        title="Kategori Ekle"
        main
      >
        <BaseButton
          :href="route('category.index')"
          :icon="mdiPlaySpeed"
          label="Kategoriler"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <form @submit.prevent="submit">
      <CardBox>

        <FormValidationErrors />

        <FormField label="Tür" help="Tür seçiniz.." wrap-body>
          <FormCheckRadioGroup
            v-model="form.tur"
            :value="form.tur"
            type="radio"
            :options="{  book: 'Kitap', journal: 'Dergi' }"
          />
        </FormField>


        <FormField label="Kategori İsim Ve Slug">
          <FormControl v-model="form.name" type="text" :icon="mdiRenameBox" placeholder="Kategori İsim"/>
        </FormField>




        <FormField label="Aktif/Pasif" help="Kategoriyi aktif veya pasif etmek için seçim yapınız.." wrap-body>
          <FormCheckRadioGroup
            v-model="form.is_active"
            name=""
            type="radio"
            :options="{  0: 'Pasif', 1: 'Aktif' }"
          />
        </FormField>


        <FormField v-if="form.tur === 'journal'" label="Üst Kategori Seçiniz">
          <FormControl v-model="form.parent_id"  :options="journalcategory" />
        </FormField>
        <FormField v-else label="Üst Kategori Seçiniz">
          <FormControl v-model="form.parent_id"  :options="bookcategory" />
        </FormField>


<!--        <BaseDivider />-->


        <template #footer>
          <BaseButtons>
            <BaseButton type="submit" color="info" label="Kaydet" />
            <BaseButton type="reset" color="info" outline label="Temizle" />
          </BaseButtons>
        </template>
      </CardBox>
      </form>

    </SectionMain>
  </LayoutAuthenticated>
</template>
