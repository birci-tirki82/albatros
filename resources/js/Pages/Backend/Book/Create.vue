<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import {Head} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import SectionMain from "@/components/SectionMain.vue";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import {reactive, ref} from "vue";
import {
  mdiBallotOutline, mdiAccount, mdiMail, mdiPlaySpeed, mdiRenameBox,
  mdiLabel,
  mdiNumeric,
  mdiLanguageC,
  mdiSignLanguage,
  mdiPageFirst,
  mdiTypewriter,
  mdiLanguageTypescript,
  mdiNumeric1,
} from "@mdi/js";
import FormFilePicker from "@/components/FormFilePicker.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseDivider from "@/components/BaseDivider.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import FormValidationErrors from '@/components/FormValidationErrors.vue';
import FormCheckRadioGroup from "@/components/FormCheckRadioGroup.vue";




const props = defineProps({
  // books: Array,
  writers: Array,
  publishers: Array,
  categories: Array,
});


let writer_list = [];
let publisher_list = [];
let category_list = [];

props.writers.forEach((writer, index) => {
  writer_list.push({
    id: writer.id, label: writer.name + ' ' + writer.lastname,
  });
});
props.publishers.forEach((publisher, index) => {
  publisher_list.push({
    id: publisher.id, label: publisher.name,
  });
});
props.categories.forEach((category, index) => {
  if (category.tur === 'book'){
  category_list.push({
    id: category.id, label: category.name,
  });
  }
});

// props.books.forEach((book, index) => {
//   writer_list.push({
//     id: book.writer.id, label: book.writer.name,
//   });
//   publisher_list.push({
//     id: book.publisher.id, label: book.publisher.name,
//   });
//   category_list.push({
//     id: book.category.id, label: book.category.name,
//   });
// });


const form = reactive({
  writer_id: "",
  publisher_id: "",
  category_id: "",
  name: "",
  // slug: "",
  description: "",
  publish_date: "",
  isbn: "",
  language: "",
  pages: "",
  type: "",
  paper_type: "",
  dimensions: "",
  feature: "",
  price: "",
  old_price: "",
  stok: "",
  image: "",
  is_active: 1,
});


function submit() {
  Inertia.post(route('book.store'), form)
}

const formStatusWithHeader = ref(true);

const formStatusCurrent = ref(0);

const formStatusOptions = ["info", "success", "danger", "warning"];

const formStatusSubmit = () => {
  formStatusCurrent.value = formStatusOptions[formStatusCurrent.value + 1]
    ? formStatusCurrent.value + 1
    : 0;
};


</script>

<template>
  <Head title="BookCreate"/>

  <LayoutAuthenticated>
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiBallotOutline"
        title="Kitap Ekle"
        main
      >
        <BaseButton
          :href="route('book.index')"
          :icon="mdiPlaySpeed"
          label="Kitaplar"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>

<!--      <form class="block w-96 bg-white shadow-lg p-8 rounded-xl">-->
<!--        <h3 class="text-base mb-4">Payment</h3>-->

<!--        <div class="relative z-0 w-full mb-5">-->
<!--          <input type="text" name="cc" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 border-gray-200 font-sans" />-->
<!--          <label for="cc" class="absolute duration-200 top-3 -z-1 origin-0 text-gray-500 text-base">Card number</label>-->
<!--        </div>-->

<!--        <div class="grid grid-cols-2 gap-4">-->
<!--          <div class="relative z-0 w-full mb-5">-->
<!--            <input type="text" name="dd" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 border-gray-200 font-sans" />-->
<!--            <label for="dd" class="absolute duration-200 top-3 -z-1 origin-0 text-gray-500 text-base">DD</label>-->
<!--          </div>-->
<!--          <div class="relative z-0 w-full mb-5">-->
<!--            <input type="text" name="mm" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 border-gray-200 font-sans" />-->
<!--            <label for="mm" class="absolute duration-200 top-3 -z-1 origin-0 text-gray-500 text-base">MM</label>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="relative z-0 w-full mb-5">-->
<!--          <input type="text" name="cvv" placeholder=" " class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 border-gray-200 font-sans" />-->
<!--          <label for="cvv" class="absolute duration-200 top-3 -z-1 origin-0 text-gray-500 text-base">CVV</label>-->
<!--        </div>-->

<!--        <button class="rounded-xl bg-indigo-600 mt-8 block text-center text-white px-4 py-2 text-sm">Pay now ($1,243)</button>-->
<!--      </form>-->



      <form @submit.prevent="submit">
        <CardBox>

          <FormValidationErrors />

          <FormField label="Kitap Fotoğraf">
            <FormFilePicker v-model="form.image" label="Dosya Seç"/>
          </FormField>
          <BaseDivider/>

          <FormField label="Kitap İsim">
            <FormControl v-model="form.name" type="text" :icon="mdiRenameBox" placeholder="Kitap veya Dergi ismi giriniz.."/>
          </FormField>

<!--          <FormField label="Kitap/Dergi">-->
<!--            <div class="lg:col-span-8">-->
<!--              <div class="flex justify-start flex-wrap mb-3">-->
<!--                <label class="radio check-radio-warning mr-6 mb-3 last:mr-0">-->
<!--                  <input checked type="radio" v-model="form.secim" :value="1">-->
<!--                  <span class="check"></span>-->
<!--                  <span class="pl-2">Kitap</span>-->
<!--                </label>-->
<!--                <label class="radio check-radio-warning mr-6 mb-3 last:mr-0">-->
<!--                  <input type="radio" v-model="form.secim" :value="2">-->
<!--                  <span class="check"></span>-->
<!--                  <span class="pl-2">Dergi</span>-->
<!--                </label>-->
<!--              </div>-->
<!--            </div>-->
<!--          </FormField>-->


<!--          <FormField label="Kitap mı Dergimi Seçiniz">-->
<!--            <FormControl v-model="form.secim" :options="secim_list"/>-->
<!--          </FormField>-->

          <FormField label="Yazar Seçiniz">
            <FormControl v-model="form.writer_id" :options="writer_list"/>
          </FormField>


          <FormField label="Yayın Evi Seçiniz">
            <FormControl v-model="form.publisher_id" :options="publisher_list"/>
          </FormField>

          <FormField label="Kategori Seçiniz">
            <FormControl v-model="form.category_id" :options="category_list"/>
          </FormField>

<!--          <FormField label="Slug">-->
<!--            <FormControl v-model="form.slug" type="text" :icon="mdiLabel" placeholder="Slug ismi giriniz.."/>-->
<!--          </FormField>-->

          <BaseDivider/>

          <FormField label="Kitap Hakkında Açıklama" help="Kitap hakkında bilgi veriniz..">
            <FormControl
              v-model="form.description"
              type="textarea"
              placeholder="Kitap hakkında bilgi giriniz.."
            />
          </FormField>


          <FormField label="Yayım Tarihi">
            <div class="lg:col-span-4">
              <div class="">
                <div class="relative border-gray-700 dark:bg-slate-800 border-t border-b rounded border-l border-r">
                  <input type="date"
                         v-model="form.publish_date"
                         class="px-3 py-2 max-w-full focus:ring focus:outline-none dark:placeholder-gray-400 w-full h-12 border-0 border-gray-700 dark:bg-slate-800 rounded">
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Tarih Seçiniz..</div>
              </div>
            </div>
          </FormField>

          <FormField label="ISBN">
            <FormControl v-model="form.isbn" type="text" :icon="mdiNumeric" placeholder="ISBN giriniz.."/>
          </FormField>

          <FormField label="Dil">
            <FormControl v-model="form.language" type="text" :icon="mdiSignLanguage"
                         placeholder="Hangi dilde olduğunu yazınız.."/>
          </FormField>

          <FormField label="Sayfa Sayısı">
            <FormControl v-model="form.pages" type="number" :icon="mdiPageFirst"
                         placeholder="Kaç sayfadan oluştuğunu yazınız.."/>
          </FormField>

          <FormField label="Cilt Tipi">
            <FormControl v-model="form.type" type="text" :icon="mdiTypewriter" placeholder="Cilt tipini giriniz.."/>
          </FormField>

          <FormField label="Kağıt(sayfa) Cinsi">
            <FormControl v-model="form.paper_type" type="text" :icon="mdiLanguageTypescript"
                         placeholder="Kağıt cinsi.."/>
          </FormField>

          <FormField label="Kitap Boyutları">
            <FormControl v-model="form.dimensions" type="text" :icon="mdiNumeric"
                         placeholder="Kitap boyutlarını yazınız.."/>
          </FormField>

          <FormField label="Kitap Özellikleri">
            <FormControl v-model="form.feature" type="text" :icon="mdiLabel"
                         placeholder="Kitap özelliklerini yazınız.."/>
          </FormField>

          <FormField label="İndirimli Fiyat">
            <FormControl v-model="form.price" type="text"  :icon="mdiNumeric"
                         placeholder="İnidirimli fiyat bilgisi giriniz.."/>
          </FormField>

          <FormField label="Fiyat">
            <FormControl v-model="form.old_price" type="text" :icon="mdiNumeric"
                         placeholder="Fiyat bilgisi giriniz.."/>
          </FormField>

          <FormField label="Stok">
            <FormControl v-model="form.stok" type="number" :icon="mdiNumeric" placeholder="Kitap stoğunu giriniz.."/>
          </FormField>

          <FormField label="Aktif/Pasif" help="Ürünü aktif veya pasif etmek için seçim yapınız.." wrap-body>
            <FormCheckRadioGroup
              v-model="form.is_active"
              name=""
              type="radio"
              :options="{  0: 'Pasif', 1: 'Aktif' }"
            />
          </FormField>


          <template #footer>
            <BaseButtons>
              <BaseButton type="submit" color="info" label="Kaydet"/>
              <BaseButton type="reset" color="info" outline label="Temizle"/>
            </BaseButtons>
          </template>
        </CardBox>
      </form>


    </SectionMain>
  </LayoutAuthenticated>
</template>
