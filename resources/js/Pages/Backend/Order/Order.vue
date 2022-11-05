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
import OrderTable from "@/components/OrderTables.vue";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import CardBoxComponentEmpty from "@/components/CardBoxComponentEmpty.vue";


const props = defineProps({
  orders: Array,
  products: Array,
});

</script>

<template>
  <Head title="Books" />

  <LayoutAuthenticated>


    <SectionMain>
<!--      <SectionTitleLineWithButton :icon="mdiTableBorder" title="Kitaplar" main>-->
<!--&lt;!&ndash;        <BaseButton&ndash;&gt;-->
<!--&lt;!&ndash;          :href="route('book.create')"&ndash;&gt;-->
<!--&lt;!&ndash;          :icon="mdiPlus"&ndash;&gt;-->
<!--&lt;!&ndash;          label="Kitap Ekle"&ndash;&gt;-->
<!--&lt;!&ndash;          color="info"&ndash;&gt;-->
<!--&lt;!&ndash;          rounded-full&ndash;&gt;-->
<!--&lt;!&ndash;          small&ndash;&gt;-->
<!--&lt;!&ndash;        />&ndash;&gt;-->
<!--      </SectionTitleLineWithButton>-->
      <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar>

      <CardBox class="mb-6" has-table>
        <OrderTable checkable :orders="orders" :products="products" />
      </CardBox>



    </SectionMain>


  </LayoutAuthenticated>
</template>
