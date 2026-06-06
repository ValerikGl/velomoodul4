<script setup>
import HeroSection from "../Components/HeroSection.vue";
import MissionSection from "../Components/MissionSection.vue";
import FeaturedVehiclesSection from "../Components/FeaturedVehiclesSection.vue";
import BlogNewsSection from "../Components/BlogNewsSection.vue";
import OffersSection from "../Components/OffersSection.vue";
import AppSection from "../Components/AppSection.vue";
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
