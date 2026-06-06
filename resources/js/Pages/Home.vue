<script setup>
import HeroSection from "../components/HeroSection.vue";
import MissionSection from "../components/MissionSection.vue";
import FeaturedVehiclesSection from "../components/FeaturedVehiclesSection.vue";
import BlogNewsSection from "../components/BlogNewsSection.vue";
import OffersSection from "../components/OffersSection.vue";
import AppSection from "../components/AppSection.vue";
import MainLayout from "../Layouts/MainLayout.vue";

defineOptions({
    layout: MainLayout,
});

defineProps({
    vehicles: {
        type: Array,
        default: () => [],
    },
    posts: {
        type: Array,
        default: () => [],
    },

    offers: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <HeroSection v-reveal />
    <MissionSection v-reveal />
    <FeaturedVehiclesSection v-reveal :vehicles="vehicles" />
    <BlogNewsSection v-reveal :posts="posts" />
    <OffersSection v-reveal :offers="offers" />
    <AppSection v-reveal />
</template>
