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
import CategoryTable from "@/components/CategoryTables.vue";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import CardBoxComponentEmpty from "@/components/CardBoxComponentEmpty.vue";


const props = defineProps({
  categories: Array,
  // category: {
  //   type: String,
  //   default: null,
  // },
});

</script>

<template>
  <Head title="Categories" />

  <LayoutAuthenticated>


    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiTableBorder" title="Kategoriler" main>
        <BaseButton
          :href="route('category.create')"
          :icon="mdiPlus"
          label="Kategori Ekle"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar>

      <CardBox class="mb-6" has-table>
        <CategoryTable checkable :categories="categories" />
      </CardBox>



    </SectionMain>


  </LayoutAuthenticated>
</template>
