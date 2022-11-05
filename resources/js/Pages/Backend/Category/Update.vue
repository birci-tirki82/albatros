<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import {Head} from '@inertiajs/inertia-vue3';
import {reactive, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import SectionMain from "@/components/SectionMain.vue";
import {mdiBallotOutline, mdiAccount, mdiMail, mdiPlaySpeed, mdiRenameBox} from "@mdi/js";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import BaseDivider from "@/components/BaseDivider.vue";
import FormCheckRadioGroup from '@/components/FormCheckRadioGroup.vue'
import FormValidationErrors from '@/components/FormValidationErrors.vue'

const props = defineProps({
  category: Array,
  categories: Array,
});


let list = [];
let catIndex= 0;

list.push({
  id: 0, label: "Ana Kategori",
})
props.categories.forEach((value, index) => {
    list.push({
      id: value.id, label: value.name,
    });
  if (props.category.parent_id === value.id) {
    // console.log(index)
    catIndex = value.id;
  }
});

const form = reactive({
  name: props.category.name,
  // slug: props.category.slug,
  is_active: props.category.is_active,
  parent_id: list[catIndex],
});
// console.log(catIndex);




// let category_list = [];
// let brand_list = [];
// let catIndex= "";
// let brandIndex= "";
// props.categories.forEach((category, index) => {
//   category_list.push({
//     id: category.id, label: category.name,
//   });
//   if (props.product.category_id === category.id) {
//     catIndex = index;
//   }
// });
// category: category_list[catIndex],






function submit(id) {
  Inertia.put(route('category.update', id), form);
}


</script>

<template>
  <Head title="Dashboard"/>

  <LayoutAuthenticated>
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiBallotOutline"
        title="Kategori Güncelle"
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
      <form @submit.prevent="submit(category.id)">
        <CardBox>

          <FormValidationErrors />

          <FormField label="Kategori İsim Ve Slug">
            <FormControl v-model="form.name" type="text" :icon="mdiRenameBox"/>
<!--            <FormControl v-model="form.slug" type="text" :icon="mdiRenameBox"/>-->
          </FormField>

          <BaseDivider/>

          <FormField label="Üst Kategori Seçiniz">
            <FormControl v-model="form.parent_id" :options="list"/>
          </FormField>

          <BaseDivider/>


          <FormField label="Radio" help="Kategoriyi aktif veya pasif etmek için seçim yapınız.." wrap-body>
            <FormCheckRadioGroup
              v-model="form.is_active"
              name="sample-radio"
              type="radio"
              :options="{  0: 'Pasif', 1: 'Aktif' }"
            />
          </FormField>

<!--          <FormField v-if="form.is_active" label="Aktif" help="Kategoriyi PASİF etmek için tiki kaldırınız..">-->
<!--            <FormControl-->
<!--              v-model="form.is_active"-->
<!--              :value="form.is_active"-->
<!--              type="checkbox"-->
<!--            />-->
<!--          </FormField>-->

<!--          <FormField v-else label="Pasif" help="Kategoriyi AKTİF etmek için tik koyunuz..">-->
<!--            <FormControl-->
<!--              v-model="form.is_active"-->
<!--              :value="form.is_active"-->
<!--              type="checkbox"-->
<!--            />-->
<!--          </FormField>-->

          <template #footer>
            <BaseButtons>
              <BaseButton type="submit" color="success" label="Güncelle"/>
<!--                          <BaseButton type="reset" color="info" outline label="Temizle" />-->
            </BaseButtons>
          </template>
        </CardBox>
      </form>


    </SectionMain>
  </LayoutAuthenticated>
</template>
