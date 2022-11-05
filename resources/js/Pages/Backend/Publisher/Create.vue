<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import { Head } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import {
  mdiMonitorCellphone,
  mdiTableBorder,
  mdiTableOff,
  mdiGithub,
  mdiPlus
} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import NotificationBar from "@/components/NotificationBar.vue";
import PublisherTable from "@/components/PublisherTables.vue";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import CardBoxComponentEmpty from "@/components/CardBoxComponentEmpty.vue";


import { reactive, ref } from "vue";
import { mdiBallotOutline, mdiAccount, mdiMail, mdiPlaySpeed, mdiRenameBox } from "@mdi/js";
import FormCheckRadioGroup from "@/components/FormCheckRadioGroup.vue";
import FormFilePicker from "@/components/FormFilePicker.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseDivider from "@/components/BaseDivider.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import FormValidationErrors from '@/components/FormValidationErrors.vue'
import SectionTitle from "@/components/SectionTitle.vue";
import NotificationBarInCard from "@/components/NotificationBarInCard.vue";
import {forEach} from "lodash/collection";


const props = defineProps({
  publishers: Array,
});


const form = reactive({
  name: "",
  image: "",
  // is_active: 1,
});

// const customElementsForm = reactive({
//   checkbox: ["lorem"],
//   radio: "one",
//   switch: ["one"],
//   file: null,
// });

function submit() {
  Inertia.post(route('publisher.store'), form)
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
    <Head title="PublisherCreate" />

  <LayoutAuthenticated>
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiBallotOutline"
        title="Yayın Evi Ekle"
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
      <form @submit.prevent="submit" enctype="multipart/form-data">
      <CardBox>

        <FormValidationErrors />

        <FormField label="Yayın Evi Fotoğraf">
          <FormFilePicker v-model="form.image" label="Dosya Seç" />
        </FormField>

        <BaseDivider />

        <FormField label="Yayın Evi Ad">
          <FormControl v-model="form.name" type="text" :icon="mdiRenameBox" placeholder="Ad"/>
        </FormField>

<!--        <FormField label="Aktif/Pasif" help="Yazarı aktif veya pasif etmek için seçim yapınız.." wrap-body>-->
<!--          <FormCheckRadioGroup-->
<!--            v-model="form.is_active"-->
<!--            name=""-->
<!--            type="radio"-->
<!--            :options="{  0: 'Pasif', 1: 'Aktif' }"-->
<!--          />-->
<!--        </FormField>-->

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
