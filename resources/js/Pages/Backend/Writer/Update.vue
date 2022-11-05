<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import {Head, useForm} from '@inertiajs/inertia-vue3';
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
import FormValidationErrors from '@/components/FormValidationErrors.vue'
import FormCheckRadioGroup from '@/components/FormCheckRadioGroup.vue'

const props = defineProps({
  writer: Array,
});

const form = useForm({
  name: props.writer.name,
  lastname: props.writer.lastname,
  info: props.writer.info,
  image: props.writer.image,
  old_image: props.writer.image,
  // is_active: props.writer.is_active,
});


function submit() {
  Inertia.post(route('writer.update', props.writer.id), {
    _method: 'put',
    image: form.image,
    name: form.name,
    lastname: form.lastname,
    info: form.info,
    old_image: form.old_image,
    // is_active: form.is_active,
  });
}
function path() {
  return "../../../storage/images/writers/";
}

</script>

<template>
  <Head title="AdminPanel"/>

  <LayoutAuthenticated>
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiBallotOutline"
        title="Yazar Güncelle"
        main
      >
        <BaseButton
          :href="route('writer.index')"
          :icon="mdiPlaySpeed"
          label="Yazarlar"
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
            <FormFilePicker v-model="form.image" label="Dosya Seç"/>
          </FormField>

          <FormField label="Yazar Ad">
            <FormControl v-model="form.name" type="text" :icon="mdiRenameBox" placeholder="Ad"/>
          </FormField>

          <FormField label="Yazar Soyad">
            <FormControl v-model="form.lastname" type="text" :icon="mdiRenameBox" placeholder="Soyad"/>
          </FormField>

          <BaseDivider/>

          <FormField label="Yazar Hakkında Bilgi" help="Kısaca yazarın biyografisinden bahsedebilirisiniz..">
            <FormControl
              v-model="form.info"
              type="textarea"
              placeholder="Yazar hakkında bilgi giriniz.."
            />
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
              <BaseButton type="reset" color="info" outline label="Temizle"/>
            </BaseButtons>
          </template>
        </CardBox>
      </form>


    </SectionMain>
  </LayoutAuthenticated>
</template>
