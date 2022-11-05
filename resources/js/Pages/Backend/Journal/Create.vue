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
  // journals: Array,
  // writers: Array,
  publishers: Array,
  categories: Array,
});


// let writer_list = [];
let publisher_list = [];
let category_list = [];
// let secim_list = [];

// props.writers.forEach((writer, index) => {
//   writer_list.push({
//     id: writer.id, label: writer.name,
//   });
// });

props.publishers.forEach((publisher, index) => {
  publisher_list.push({
    id: publisher.id, label: publisher.name,
  });
});
props.categories.forEach((category, index) => {
  if (category.tur === 'journal') {
    category_list.push({
      id: category.id, label: category.name,
    });
  }
});
// let secim = {id: 1, label: 'Dergi'};
// secim_list.push(
//   {id: 1, label: 'Dergi'},
//   {id: 2, label: 'Dergi'},
// );

// props.journals.forEach((journal, index) => {
//   writer_list.push({
//     id: journal.writer.id, label: journal.writer.name,
//   });
//   publisher_list.push({
//     id: journal.publisher.id, label: journal.publisher.name,
//   });
//   category_list.push({
//     id: journal.category.id, label: journal.category.name,
//   });
// });


const form = reactive({
  // writer_id: {id: 0},
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
  Inertia.post(route('journal.store'), form)
}

const formStatusWithHeader = ref(true);

const formStatusCurrent = ref(0);

const formStatusOptions = ["info", "success", "danger", "warning"];

const formStatusSubmit = () => {
  formStatusCurrent.value = formStatusOptions[formStatusCurrent.value + 1]
    ? formStatusCurrent.value + 1
    : 0;
};
// console.log(form.category_id)

</script>

<template>
  <Head title="JournalCreate"/>

  <LayoutAuthenticated>
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiBallotOutline"
        title="Dergi Ekle"
        main
      >
        <BaseButton
          :href="route('journal.index')"
          :icon="mdiPlaySpeed"
          label="Dergiler"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <form @submit.prevent="submit">
        <CardBox>

          <FormValidationErrors />

          <FormField label="Dergi Fotoğraf">
            <FormFilePicker v-model="form.image" label="Dosya Seç"/>
          </FormField>
          <BaseDivider/>

          <FormField label="Dergi İsim">
            <FormControl v-model="form.name" type="text" :icon="mdiRenameBox" placeholder="Dergi ismi giriniz.."/>
          </FormField>

<!--          <FormField label="Dergi/Dergi">-->
<!--            <div class="lg:col-span-8">-->
<!--              <div class="flex justify-start flex-wrap mb-3">-->
<!--                <label class="radio check-radio-warning mr-6 mb-3 last:mr-0">-->
<!--                  <input checked type="radio" v-model="form.secim" :value="1">-->
<!--                  <span class="check"></span>-->
<!--                  <span class="pl-2">Dergi</span>-->
<!--                </label>-->
<!--                <label class="radio check-radio-warning mr-6 mb-3 last:mr-0">-->
<!--                  <input type="radio" v-model="form.secim" :value="2">-->
<!--                  <span class="check"></span>-->
<!--                  <span class="pl-2">Dergi</span>-->
<!--                </label>-->
<!--              </div>-->
<!--            </div>-->
<!--          </FormField>-->


<!--          <FormField label="Dergi mı Dergimi Seçiniz">-->
<!--            <FormControl v-model="form.secim" :options="secim_list"/>-->
<!--          </FormField>-->

<!--          <FormField v-if="form.secim === 1" label="Yazar Seçiniz">-->
<!--            <FormControl aria-disabled="true" v-model="form.writer_id" :options="writer_list"/>-->
<!--          </FormField>-->


          <FormField label="Yayın Evi Seçiniz">
            <FormControl v-model="form.publisher_id" :options="publisher_list"/>
          </FormField>

          <FormField label="Dergi Kategori Seçiniz">
            <FormControl v-model="form.category_id" :options="category_list"/>
          </FormField>

<!--          <FormField label="Slug">-->
<!--            <FormControl v-model="form.slug" type="text" :icon="mdiLabel" placeholder="Slug ismi giriniz.."/>-->
<!--          </FormField>-->

<!--          <BaseDivider/>-->

          <FormField label="Dergi Hakkında Açıklama" help="Dergi hakkında bilgi veriniz..">
            <FormControl
              v-model="form.description"
              type="textarea"
              placeholder="Dergi hakkında bilgi giriniz.."
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

          <FormField label="Dergi Boyutları">
            <FormControl v-model="form.dimensions" type="text" :icon="mdiNumeric"
                         placeholder="Dergi boyutlarını yazınız.."/>
          </FormField>

          <FormField label="Dergi Özellikleri">
            <FormControl v-model="form.feature" type="text" :icon="mdiLabel"
                         placeholder="Dergi özelliklerini yazınız.."/>
          </FormField>

          <FormField label="İndirimli Fiyat">
            <FormControl v-model="form.price" type="text" :icon="mdiNumeric"
                         placeholder="İnidirimli fiyat bilgisi giriniz.."/>
          </FormField>

          <FormField label="Fiyat">
            <FormControl v-model="form.old_price" type="text" :icon="mdiNumeric"
                         placeholder="Fiyat bilgisi giriniz.."/>
          </FormField>

          <FormField label="Stok">
            <FormControl v-model="form.stok" type="number" :icon="mdiNumeric" placeholder="Dergi stoğunu giriniz.."/>
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
