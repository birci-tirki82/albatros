<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import {Head} from '@inertiajs/inertia-vue3';
import {reactive, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import SectionMain from "@/components/SectionMain.vue";
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
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import FormFilePicker from "@/components/FormFilePicker.vue";
import BaseDivider from "@/components/BaseDivider.vue";
import FormValidationErrors from '@/components/FormValidationErrors.vue'
import FormCheckRadioGroup from '@/components/FormCheckRadioGroup.vue'

const props = defineProps({
  journal: Array,
  publishers: Array,
  categories: Array,
});



let list = [];
let categoryIndex = 0;
let publisherIndex = null;
list.push({
  id: 0, label: "Ana Kategori",
})
let publisher_list = [];
let category_list = [];

props.publishers.forEach((publisher, index) => {
  publisher_list.push({
    id: publisher.id, label: publisher.name,
  });
  if (props.journal.publisher_id === publisher.id) {
    publisherIndex = index;
  }
});
props.categories.forEach((category, index) => {
  // if (category.tur === 'journal') {
    category_list.push({
      id: category.id, label: category.name,
    });
  // }
  if (props.journal.product.category_id === category.id) {
    categoryIndex = index;
  }
});

// console.log(writer_list)

const form = reactive({
  publisher_id: publisher_list[publisherIndex],
  category_id: category_list[categoryIndex],
  name: props.journal.product.name,
  // slug: props.journal.product.slug,
  description: props.journal.product.description,
  publish_date: props.journal.publish_date,
  isbn: props.journal.isbn,
  language: props.journal.language,
  pages: props.journal.pages,
  type: props.journal.type,
  paper_type: props.journal.paper_type,
  dimensions: props.journal.dimensions,
  feature: props.journal.feature,
  price: props.journal.product.price,
  old_price: props.journal.product.old_price,
  stok: props.journal.product.stok,
  image: props.journal.product.image,
  old_image: props.journal.product.image,
  is_active: props.journal.product.is_active,

});


function submit() {
  Inertia.post(route('journal.update', props.journal.product.id), {
    _method: 'put',
    product_id: props.journal.product.id,
    publisher_id: form.publisher_id,
    category_id: form.category_id,
    name: form.name,
    // slug: form.slug,
    description: form.description,
    publish_date: form.publish_date,
    isbn: form.isbn,
    language: form.language,
    pages: form.pages,
    type: form.type,
    paper_type: form.paper_type,
    dimensions: form.dimensions,
    feature: form.feature,
    price: form.price,
    old_price: form.old_price,
    stok: form.stok,
    image: form.image,
    old_image: form.old_image,
    is_active: form.is_active

  });
}

function path() {
  return "../../../storage/images/products/";
}


</script>

<template>
  <Head title="Dashboard"/>

  <LayoutAuthenticated>
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiBallotOutline"
        title="Dergi Güncelle"
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
      <form @submit.prevent="submit()">
        <CardBox>

          <FormValidationErrors />

          <FormField label="Eski Fotoğraf">
            <img v-if="form.image === form.old_image" :src="path() + form.image" class="object-cover h-40 w-48">
            <img v-else :src="path() + form.old_image" class="object-cover h-40 w-48">
          </FormField>

          <FormField label="Dergi Fotoğraf">
            <FormFilePicker v-model="form.image" label="Dosya Seç"/>
          </FormField>
          <BaseDivider/>

          <FormField label="Dergi İsim">
            <FormControl v-model="form.name" type="text" :icon="mdiRenameBox"/>
          </FormField>

          <FormField label="Yayın Evi Seçiniz">
            <FormControl v-model="form.publisher_id" :options="publisher_list"/>
          </FormField>

          <FormField label="Kategori Seçiniz">
            <FormControl v-model="form.category_id" :options="category_list"/>
          </FormField>

<!--          <FormField label="Slug">-->
<!--            <FormControl v-model="form.slug" type="text" :icon="mdiLabel"/>-->
<!--          </FormField>-->

<!--          <BaseDivider/>-->

          <FormField label="Dergi Hakkında Açıklama" help="Dergi hakkında bilgi veriniz..">
            <FormControl
              v-model="form.description"
              type="textarea"
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
            <FormControl v-model="form.isbn" type="text" :icon="mdiNumeric"/>
          </FormField>

          <FormField label="Dil">
            <FormControl v-model="form.language" type="text" :icon="mdiSignLanguage"/>
          </FormField>

          <FormField label="Sayfa Sayısı">
            <FormControl v-model="form.pages" type="number" :icon="mdiPageFirst"/>
          </FormField>

          <FormField label="Tip">
            <FormControl v-model="form.type" type="text" :icon="mdiTypewriter"/>
          </FormField>

          <FormField label="Kağıt(sayfa) Tipi">
            <FormControl v-model="form.paper_type" type="text" :icon="mdiLanguageTypescript"/>
          </FormField>

          <FormField label="Dergi Boyutları">
            <FormControl v-model="form.dimensions" type="text" :icon="mdiNumeric"/>
          </FormField>

          <FormField label="Dergi Özellikleri">
            <FormControl v-model="form.feature" type="text" :icon="mdiLabel"/>
          </FormField>

          <FormField label="İndirimli Fiyat">
            <FormControl v-model="form.price" type="text" :icon="mdiNumeric"/>
          </FormField>

          <FormField label="Fiyat">
            <FormControl v-model="form.old_price" type="text" :icon="mdiNumeric"/>
          </FormField>

          <FormField label="Stok">
            <FormControl v-model="form.stok" type="number" :icon="mdiNumeric"/>
          </FormField>

          <FormField label="Radio" help="Ürünü aktif veya pasif etmek için seçim yapınız.." wrap-body>
            <FormCheckRadioGroup
              v-model="form.is_active"
              name="sample-radio"
              type="radio"
              :options="{  0: 'Pasif', 1: 'Aktif' }"
            />
          </FormField>

          <template #footer>
            <BaseButtons>
              <BaseButton type="submit" color="success" label="Güncelle"/>
              <BaseButton type="reset" color="info" outline label="Temizle"/>
            </BaseButtons>
          </template>
        </CardBox>
      </form>


    </SectionMain>
  </LayoutAuthenticated>
</template>
