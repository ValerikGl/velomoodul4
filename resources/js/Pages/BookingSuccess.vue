<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { CheckCircle, Calendar, Clock, MapPin, Bike, CreditCard } from "lucide-vue-next";
import MainLayout from "../Layouts/MainLayout.vue";

defineOptions({
  layout: MainLayout,
});

const props = defineProps({
  booking: Object,
});

const formattedDate = computed(() => {
  return new Date(props.booking.booking_date).toLocaleDateString("et-EE");
});
</script>

<template>
  <main class="bg-[#F8FAFC] px-5 py-20">
    <div class="mx-auto max-w-3xl">
      <div
        class="rounded-3xl bg-white p-10 text-center shadow-[0_20px_60px_rgba(15,23,42,0.08)]"
      >
        <div
          class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-[#EDE4FF]"
        >
          <CheckCircle :size="54" class="text-[#6D28D9]" />
        </div>

        <h1 class="mt-8 text-5xl font-extrabold text-[#0F172A]">
          Aitäh, {{ booking.name }}!
        </h1>

        <p class="mt-4 text-xl font-semibold text-slate-600">
          Sinu broneering on edukalt kinnitatud.
        </p>

        <div class="mt-10 rounded-2xl bg-[#F8FAFC] p-6 text-left">
          <div class="space-y-4">
            <div class="flex items-center gap-3">
              <Calendar class="text-[#6D28D9]" :size="22" />
              <span>{{ formattedDate }}</span>
            </div>

            <div class="flex items-center gap-3">
              <Clock class="text-[#6D28D9]" :size="22" />
              <span>{{ booking.start_time }}</span>
            </div>

            <div class="flex items-center gap-3">
              <MapPin class="text-[#6D28D9]" :size="22" />
              <span>{{ booking.vehicle.location }}</span>
            </div>

            <div class="flex items-center gap-3">
              <Bike class="text-[#6D28D9]" :size="22" />
              <span>{{ booking.vehicle.name }}</span>
            </div>

            <div class="flex items-center gap-3">
              <CreditCard class="text-[#6D28D9]" :size="22" />
              <span>{{ booking.total_price }} €</span>
            </div>
          </div>
        </div>

        <p class="mt-8 text-lg text-slate-600">
          Ootame sind
          <strong>{{ formattedDate }}</strong>
          kell
          <strong>{{ booking.start_time }}</strong>
          asukohas
          <strong>{{ booking.vehicle.location }}</strong>.
        </p>

        <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:justify-center">
          <Link
            href="/vehicles"
            class="rounded-xl border border-[#6D28D9] px-8 py-4 font-bold text-[#6D28D9] transition hover:bg-[#F3E8FF]"
          >
            Tagasi sõidukite juurde
          </Link>

          <Link
            href="/"
            class="rounded-xl bg-[#6D28D9] px-8 py-4 font-bold text-white transition hover:bg-[#5B21B6]"
          >
            Avalehele
          </Link>
        </div>
      </div>
    </div>
  </main>
</template>