<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import { Head } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import {
  mdiMonitorCellphone,
  mdiTableBorder,
  mdiTableOff,
  mdiGithub,
  mdiPlus,
  mdiEmail,
  mdiDeathStar,
  mdiFormTextboxPassword,
  mdiOnepassword,
  mdiAccountStar,
  mdiCalendarStar,
} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import NotificationBar from "@/components/NotificationBar.vue";
import UserTable from "@/components/UserTables.vue";
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
  users: Array,
  roles: Array
});

let list = [];

props.roles.forEach((value, index) => {
  list.push({
    id: value.id, label: value.name,
  });
});


const form = reactive({
  name: "",
  surname: "",
  email: "",
  password: "",
  password_confirmation: "",
  is_active: 1,
  role_id: list[0]
});


function submit() {
  Inertia.post(route('user.store'), form)
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
  <Head title="UserCreate" />

  <LayoutAuthenticated>
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiBallotOutline"
        title="Kullanıcı Ekle"
        main
      >
        <BaseButton
          :href="route('user.index')"
          :icon="mdiPlaySpeed"
          label="Kullanıcılar"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <form @submit.prevent="submit" enctype="multipart/form-data">
        <CardBox>

          <FormValidationErrors />

          <FormField label="Ad">
            <FormControl v-model="form.name" type="text" :icon="mdiRenameBox" placeholder="Ad Giriniz.."/>
          </FormField>

          <FormField label="Soyad">
            <FormControl v-model="form.surname" type="text" :icon="mdiRenameBox" placeholder="Soyad Giriniz.." />
          </FormField>
          <BaseDivider />

          <FormField label="E-mail">
            <FormControl v-model="form.email" type="email" :icon="mdiEmail" placeholder="E-mail giriniz.."/>
          </FormField>

          <FormField label="Şifre">
            <FormControl v-model="form.password" type="password" :icon="mdiDeathStar" placeholder="Şifre giriniz.."/>
          </FormField>
          <FormField label="Şifre Tekrarı">
            <FormControl v-model="form.password_confirmation" type="password" :icon="mdiDeathStar" placeholder="Şifre giriniz.."/>
          </FormField>

          <FormField label="Aktif/Pasif" help="Kategoriyi aktif veya pasif etmek için seçim yapınız.." wrap-body>
            <FormCheckRadioGroup
              v-model="form.is_active"
              name="sample-radio"
              type="radio"
              :options="{  0: 'Pasif', 1: 'Aktif' }"
            />
          </FormField>

<!--          <FormField label="Aktif/Pasif" help="Kullanıcı aktif etmek için tik koyunuz..">-->
<!--            <FormControl-->
<!--              v-model="form.is_active"-->
<!--              type="checkbox"-->
<!--              placeholder="Is Active"-->
<!--            />-->
<!--          </FormField>-->

          <FormField label="Kullanıcı Rolü Seçiniz">
            <FormControl v-model="form.role_id"  :options="list" />
          </FormField>

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
