<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import { Head } from '@inertiajs/inertia-vue3';
import {
  mdiMonitorCellphone,
  mdiTableBorder,
  mdiPlus,
  mdiAccountCircle,
  mdiTypewriter,
  mdiHomeVariantOutline
} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import NotificationBar from "@/components/NotificationBar.vue";
import UserTable from "@/components/UserTables.vue";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import CardBoxComponentEmpty from "@/components/CardBoxComponentEmpty.vue";


const props = defineProps({
  users: Array,
});

</script>

<template>
  <Head title="UserCreate" />

  <LayoutAuthenticated>


    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiAccountCircle" title="Kullanıcılar" main>
        <BaseButton
          :href="route('user.create')"
          :icon="mdiPlus"
          label="Kullanıcı Ekle"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar>

      <CardBox class="mb-6" has-table>
        <UserTable checkable :users="users" />
      </CardBox>



    </SectionMain>


  </LayoutAuthenticated>
</template>
