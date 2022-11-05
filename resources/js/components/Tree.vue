<!--<script setup>-->
<!--// import NavBarItem from "@/components/NavBarItem.vue";-->
<!--import NodeTree from "@/components/NodeTree.vue";-->

<!--const props = defineProps({-->
<!--  treeData: Object-->
<!--})-->
<!--// console.log(props.treeData);-->
<!--</script>-->

<template>
  <div class="tree">
    <ul class="tree-list">
      <node-tree :node="treeData"></node-tree>
    </ul>
  </div>
</template>

<script>
import NodeTree from "@/components/NodeTree.vue";

export default {
  props: {
    treeData: Object
  },
  components: {
    NodeTree
  }
};
</script>

<style>
.tree-list ul {
  padding-left: 8px;
  margin: 3px 0;
}
</style>
