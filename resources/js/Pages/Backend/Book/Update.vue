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
  book: Array,
  writers: Array,
  publishers: Array,
  categories: Array,
});
// console.log(props.book)

let list = [];
let categoryIndex = 0;
let writerIndex = null;
let publisherIndex = null;
list.push({
  id: 0, label: "Ana Kategori",
})
let writer_list = [];
let publisher_list = [];
let category_list = [];

props.writers.forEach((writer, index) => {
  writer_list.push({
    id: writer.id, label: writer.name + ' ' + writer.lastname,
  });
  if (props.book.writer_id === writer.id) {
    writerIndex = index;
  }
});
props.publishers.forEach((publisher, index) => {
  publisher_list.push({
    id: publisher.id, label: publisher.name,
  });
  if (props.book.publisher_id === publisher.id) {
    publisherIndex = index;
  }
});
props.categories.forEach((category, index) => {
  // if (category.tur === 'book') {
    category_list.push({
      id: category.id, label: category.name,
    });
    if (props.book.product.category_id === category.id) {
      // console.log(index)
      categoryIndex = index;
    }
  // }

});
// console.log(category_list)


const form = reactive({
  writer_id: writer_list[writerIndex],
  publisher_id: publisher_list[publisherIndex],
  category_id: category_list[categoryIndex],
  name: props.book.product.name,
  // slug: props.book.product.slug,
  description: props.book.product.description,
  publish_date: props.book.publish_date,
  isbn: props.book.isbn,
  language: props.book.language,
  pages: props.book.pages,
  type: props.book.type,
  paper_type: props.book.paper_type,
  dimensions: props.book.dimensions,
  feature: props.book.feature,
  price: props.book.product.price,
  old_price: props.book.product.old_price,
  stok: props.book.product.stok,
  image: props.book.product.image,
  old_image: props.book.product.image,
  is_active: props.book.product.is_active,
});

function submit() {
  Inertia.post(route('book.update', props.book.product.id), {
    _method: 'put',
    product_id: props.book.product.id,
    writer_id: form.writer_id,
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

// console.log(writer_list);
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
        title="Kitap Güncelle"
        main
      >
        <BaseButton
          :href="route('book.index')"
          :icon="mdiPlaySpeed"
          label="Kitapler"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <form @submit.prevent="submit()">
        <CardBox>

          <FormValidationErrors/>

          <FormField label="Eski Fotoğraf">
            <img v-if="form.image === form.old_image" :src="path() + form.image" class="object-cover h-40 w-48">
            <img v-else :src="path() + form.old_image" class="object-cover h-40 w-48">
          </FormField>

          <FormField label="Kitap Fotoğraf">
            <FormFilePicker v-model="form.image" label="Dosya Seç"/>
          </FormField>
          <BaseDivider/>

          <FormField label="Kitap İsim">
            <FormControl v-model="form.name" type="text" :icon="mdiRenameBox"/>
          </FormField>

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
<!--            <FormControl v-model="form.slug" type="text" :icon="mdiLabel"/>-->
<!--          </FormField>-->

<!--          <BaseDivider/>-->

          <FormField label="Kitap Hakkında Açıklama" help="Kitap hakkında bilgi veriniz..">
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

          <FormField label="Kitap Boyutları">
            <FormControl v-model="form.dimensions" type="text" :icon="mdiNumeric"/>
          </FormField>

          <FormField label="Kitap Özellikleri">
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
