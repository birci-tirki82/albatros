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
import BookTable from "@/components/BookTables.vue";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import CardBoxComponentEmpty from "@/components/CardBoxComponentEmpty.vue";


const props = defineProps({
  books: Array,
  products: Array,
});

</script>

<template>
  <Head title="Books" />

  <LayoutAuthenticated>


    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiTableBorder" title="Kitaplar" main>
        <BaseButton
          :href="route('book.create')"
          :icon="mdiPlus"
          label="Kitap Ekle"
          color="info"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar>

      <CardBox class="mb-6" has-table>
        <BookTable checkable :books="books" :products="products" />
      </CardBox>



    </SectionMain>


  </LayoutAuthenticated>
</template>
