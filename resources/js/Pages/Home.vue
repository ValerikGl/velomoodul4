<script setup>
import HeroSection from "../components/HeroSection.vue";
import MissionSection from "../components/MissionSection.vue";
import FeaturedVehiclesSection from "../components/FeaturedVehiclesSection.vue";
import BlogNewsSection from "../components/BlogNewsSection.vue";
import OffersSection from "../components/OffersSection.vue";
import AppSection from "../components/AppSection.vue";
</script>

<template>
  <HeroSection v-reveal />
  <MissionSection v-reveal />
  <FeaturedVehiclesSection v-reveal />
  <BlogNewsSection v-reveal />
  <OffersSection v-reveal />
  <AppSection v-reveal />
  <AppFooter v-reveal />
</template>
