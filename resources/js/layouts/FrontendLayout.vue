<script setup>
import Header from "@/components/Frontend/Header.vue";
import Navbar from "@/components/Frontend/Navbar.vue";
import Footer from "@/components/Frontend/Footer.vue";

const props = defineProps({
  // user: Array,
  // cats: Array,
  // mainCats: Array,
})
// console.log(props.mainCats)

import { mdiForwardburger, mdiBackburger, mdiMenu } from "@mdi/js";
// import { useRouter } from "vue-router";
import menuAside from "@/menuAside.js";
import menuNavBar from "@/menuNavBar.js";
import { useMainStore } from "@/stores/main.js";
import { useLayoutStore } from "@/stores/layout.js";
import { useStyleStore } from "@/stores/style.js";
import BaseIcon from "@/components/BaseIcon.vue";
import FormControl from "@/components/FormControl.vue";
import NavBar from "@/components/NavBar.vue";
import NavBarItemPlain from "@/components/NavBarItemPlain.vue";
import AsideMenu from "@/components/AsideMenu.vue";
import FooterBar from "@/components/FooterBar.vue";
import { Inertia } from '@inertiajs/inertia'

// Inertia.on('navigate', () => {
//     layoutStore.isAsideMobileExpanded = false
//     layoutStore.isAsideLgActive = false
// })
//
// useMainStore().setUser({
//   name: "John Doe",
//   email: "john@example.com",
//   avatar:
//     "https://avatars.dicebear.com/api/avataaars/example.svg?options[top][]=shortHair&options[accessoriesChance]=93",
// });
//
// const layoutAsidePadding = "xl:pl-60";
//
// const styleStore = useStyleStore();
//
// const layoutStore = useLayoutStore();
//
// const menuClick = (event, item) => {
//   if (item.isToggleLightDark) {
//     styleStore.setDarkMode();
//   }
//
//   if (item.isLogout) {
//       Inertia.post(route('logout'))
//   }
// };
</script>

<template>
  <Header />
  <Navbar />

  <slot />

  <Footer />
</template>
