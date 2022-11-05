<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import {Head, useForm} from '@inertiajs/inertia-vue3';
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
import FormFilePicker from "@/components/FormFilePicker.vue";
import BaseDivider from "@/components/BaseDivider.vue";
import FormValidationErrors from '@/components/FormValidationErrors.vue';
import FormCheckRadioGroup from "@/components/FormCheckRadioGroup.vue";

const props = defineProps({
  publisher: Array,
});

const form = reactive({
  name: props.publisher.name,
  image: props.publisher.image,
  old_image: props.publisher.image,
  // is_active: props.publisher.is_active,
});


// function submit() {
//   Inertia.put(route('publisher.update', props.publisher.id), form);
// }

function submit() {
  Inertia.post(route('publisher.update', props.publisher.id), {
    _method: 'put',
    image: form.image,
    name: form.name,
    old_image: form.old_image,
    // is_active: form.is_active
  });
}

function path() {
  return "../../../storage/images/publishers/";
}

</script>

<template>
  <Head title="AdminPanel"/>

  <LayoutAuthenticated>
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiBallotOutline"
        title="Yayın Evi Güncelle"
        main
      >
        <BaseButton
          :href="route('publisher.index')"
          :icon="mdiPlaySpeed"
          label="Yayın Evleri"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <form @submit.prevent="submit()" enctype="multipart/form-data">

        <CardBox>

          <FormValidationErrors />

          <FormField label="Eski Fotoğraf">
            <img v-if="form.image === form.old_image" :src="path() + form.image" class="object-cover h-40 w-48">
            <img v-else :src="path() + form.old_image" class="object-cover h-40 w-48">
          </FormField>

          <FormField label="Yeni Fotoğraf">
            <FormFilePicker v-model="form.image" @input="form.image = $event.target.files[0]" label="Dosya Seç"/>
          </FormField>

          <BaseDivider/>

          <FormField label="Yayın Evi Ad">
            <FormControl v-model="form.name" type="text" :icon="mdiRenameBox" placeholder="Ad"/>
          </FormField>

<!--          <FormField label="Aktif/Pasif" help="Yazarı aktif veya pasif etmek için seçim yapınız.." wrap-body>-->
<!--            <FormCheckRadioGroup-->
<!--              v-model="form.is_active"-->
<!--              name=""-->
<!--              type="radio"-->
<!--              :options="{  0: 'Pasif', 1: 'Aktif' }"-->
<!--            />-->
<!--          </FormField>-->


          <template #footer>
            <BaseButtons>
              <BaseButton type="submit" color="success" label="Güncelle"/>
              <BaseButton type="reset" color="info" outline label="Reset"/>
            </BaseButtons>
          </template>
        </CardBox>
      </form>


    </SectionMain>
  </LayoutAuthenticated>
</template>
