<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import { Head } from '@inertiajs/inertia-vue3';
import {
  mdiMonitorCellphone,
  mdiTableBorder,
  mdiPlus,
  mdiTypewriter,
  mdiHomeVariantOutline
} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import NotificationBar from "@/components/NotificationBar.vue";
import PublisherTable from "@/components/PublisherTables.vue";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import CardBoxComponentEmpty from "@/components/CardBoxComponentEmpty.vue";


const props = defineProps({
  publishers: Array,
});

</script>

<template>
  <Head title="Publishers" />

  <LayoutAuthenticated>


    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiHomeVariantOutline" title="Yayın Evleri" main>
        <BaseButton
          :href="route('publisher.create')"
          :icon="mdiPlus"
          label="Yayın Evi Ekle"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar>

      <CardBox class="mb-6" has-table>
        <PublisherTable checkable :publishers="publishers" />
      </CardBox>



    </SectionMain>


  </LayoutAuthenticated>
</template>
