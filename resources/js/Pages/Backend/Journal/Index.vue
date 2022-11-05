<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import { Head } from '@inertiajs/inertia-vue3';
import {
  mdiMonitorCellphone,
  mdiTableBorder,
  mdiTableOff,
  mdiGithub,
  mdiPlus
} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import NotificationBar from "@/components/NotificationBar.vue";
import JournalTable from "@/components/JournalTables.vue";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import CardBoxComponentEmpty from "@/components/CardBoxComponentEmpty.vue";


const props = defineProps({
  journals: Array,
});

</script>

<template>
  <Head title="Journals" />

  <LayoutAuthenticated>


    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiTableBorder" title="Dergiler" main>
        <BaseButton
          :href="route('journal.create')"
          :icon="mdiPlus"
          label="Dergi Ekle"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar>

      <CardBox class="mb-6" has-table>
        <JournalTable checkable :journals="journals" />
      </CardBox>



    </SectionMain>


  </LayoutAuthenticated>
</template>
