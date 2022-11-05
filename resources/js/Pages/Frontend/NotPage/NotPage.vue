<script setup>

import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Link, useForm} from "@inertiajs/inertia-vue3";

</script>

<template>

  <FrontendLayout >

    <div class="contain py-16 mx-auto">
      <div class="text-center max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">

        <span class="text-6xl text-red-500">404</span>
        <p class="mt-12 text-2xl md:text-3xl font-light leading-normal"
        >Üzgünüz, bu sayfayı bulamadık... </p>
        <p class="mt-4 mb-8">Ama merak etmeyin, ana sayfamızda daha pek çok şey bulabilirsiniz..</p>

        <Link :href="route('/')" type="submit" class="mt-4 block w-full py-2 text-center text-white bg-red-500 border border-red-500 rounded hover:bg-transparent hover:text-red-500 transition uppercase font-roboto font-medium">
          Anasayfa
        </Link>
      </div>
    </div>


  </FrontendLayout>


</template>
