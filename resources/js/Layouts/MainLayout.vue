<script setup>
import AppHeader from "../Components/AppHeader.vue";
import AppFooter from "../Components/AppFooter.vue";
</script>

<template>
  <AppHeader />
  <slot />
  <AppFooter />
</template>