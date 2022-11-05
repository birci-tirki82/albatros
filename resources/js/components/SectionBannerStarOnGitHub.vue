<script setup>
import { mdiGithub, mdiBook } from "@mdi/js";
import BaseButton from "@/components/BaseButton.vue";
import SectionBanner from "@/components/SectionBanner.vue";
import { gradientBgPinkRed } from "@/colors";
</script>

<template>
  <SectionBanner :class="gradientBgPinkRed">
    <h1 class="text-3xl text-white mb-6">
      Albatros Kitap Evi internet sitesine gidebilirsiniz..
    </h1>
    <div>
      <BaseButton
        href="/"
        :icon="mdiBook"
        label="albatros"
        target="_blank"
        rounded-full
      />
    </div>
  </SectionBanner>
</template>
