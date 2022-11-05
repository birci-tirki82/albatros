<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import {Head, useForm} from '@inertiajs/inertia-vue3';
import {reactive, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import SectionMain from "@/components/SectionMain.vue";
import {mdiBallotOutline, mdiAccount, mdiMail, mdiPlaySpeed, mdiRenameBox, mdiEmail,} from "@mdi/js";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import FormFilePicker from "@/components/FormFilePicker.vue";
import BaseDivider from "@/components/BaseDivider.vue";
import FormCheckRadioGroup from '@/components/FormCheckRadioGroup.vue'
import FormValidationErrors from '@/components/FormValidationErrors.vue'

const props = defineProps({
  user: Array,
  roles: Array
});

let list = [];
let userIndex = 1;

props.roles.forEach((value, index) => {
  list.push({
    id: value.id, label: value.name,
  });
  // console.log(props.user.roles[0].id);
  if (props.user.roles[0].id === value.id) {
    userIndex = index;
  }
});
// console.log(props.user.roles[0].id)

const form = useForm({
  name: props.user.name,
  surname: props.user.surname,
  email: props.user.email,
  is_active: props.user.is_active,
  role_id: list[userIndex]
});


function submit() {
  Inertia.put(route('user.update', props.user.id), form);
}

</script>

<template>
  <Head title="AdminPanel"/>

  <LayoutAuthenticated>
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiBallotOutline"
        title="Kullanıcı Güncelle"
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
      <form @submit.prevent="submit()" enctype="multipart/form-data">

        <CardBox>

          <FormValidationErrors />

          <FormField label="Ad">
            <FormControl v-model="form.name" type="text" :icon="mdiRenameBox" />
          </FormField>

          <FormField label="Soyad">
            <FormControl v-model="form.surname" type="text" :icon="mdiRenameBox" />
          </FormField>
          <BaseDivider />

          <FormField label="E-mail">
            <FormControl v-model="form.email" type="email" :icon="mdiEmail"/>
          </FormField>

          <FormField label="Aktif/Pasif" help="Kategoriyi aktif veya pasif etmek için seçim yapınız.." wrap-body>
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

          <FormField label="Kullanıcı Rolü Seçiniz">
            <FormControl v-model="form.role_id" :value="form.role_id" :options="list" />
          </FormField>


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
