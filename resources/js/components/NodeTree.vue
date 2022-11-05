<!--<script setup>-->
<!--// import NavBarItem from "@/components/NavBarItem.vue";-->

<!--const props = defineProps({-->
<!--  name: "node",-->
<!--  node: Object-->
<!--})-->
<!--console.log(props.node)-->
<!--</script>-->

<template>

    <li>
      <Link :href="route('kategori',{  cat: slug?slug:'kitap' })"><span class="label">{{ isim }}</span></Link>
      <ul v-for="nod in node">
        <node  v-if="nod.children && nod.children.length" :node="nod.children" :isim="nod.name" :slug="nod.slug"></node>
        <node  v-else :node="nod.children" :isim="nod.name" :slug="nod.slug"></node>
      </ul>
    </li>

</template>

<script>
import {Link, useForm, usePage} from "@inertiajs/inertia-vue3";
export default {
  components: {
    Link
  },
  name: "node",
  props: {
    node: Array,
    isim: String,
    slug: String
  }
};

// console.log(this.node)
</script>
