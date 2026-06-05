<script setup>
import { MapPin, Lock, Zap } from "lucide-vue-next";

const features = [
  {
    icon: MapPin,
    title: "Leia lähim sõiduk",
    text: "Näed reaalajas vabu sõidukeid enda läheduses",
  },
  {
    icon: Lock,
    title: "Broneeri sekunditega",
    text: "Broneeri sõiduk kuni 15 minutiks tasuta.",
  },
  {
    icon: Zap,
    title: "Ava sõit ühe puudutusega",
    text: "Kiire, mugav ja kontaktivaba.",
  },
];
</script>

<template>
  <section class="bg-[#F8FAFC] py-20 lg:py-24">
    <div
      class="mx-auto grid max-w-[1280px] items-center gap-12 px-5 sm:px-6 lg:grid-cols-[460px_1fr]"
    >
      <!-- LEFT -->
      <div>
        <h2
          class="text-[38px] font-extrabold leading-tight text-[#0F172A] sm:text-[56px]"
        >
          Sõida nutikamalt
        </h2>

        <p
          class="mt-5 max-w-[500px] text-[18px] font-semibold leading-relaxed text-[#0F172A] sm:text-[22px]"
        >
          Meie rakendus teeb sõiduki leidmise, broneerimise ja avamise lihtsaks
          ja kiireks.
        </p>

        <div class="mt-10 space-y-8">
          <div
            v-for="feature in features"
            :key="feature.title"
            class="flex items-center gap-5"
          >
            <div
              class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-[#EDE4FF] text-[#6D28D9]"
            >
              <component :is="feature.icon" :size="34" :stroke-width="2.5" />
            </div>

            <div>
              <h3 class="text-[18px] font-extrabold text-[#0F172A]">
                {{ feature.title }}
              </h3>

              <p class="mt-1 text-[14px] text-slate-600">
                {{ feature.text }}
              </p>
            </div>
          </div>
        </div>

        <div class="mt-8 flex gap-3">
          <img
            src="/images/stores/google-play.webp"
            alt="Google Play"
            class="h-[42px] w-auto sm:h-[54px]"
          />

          <img
            src="/images/stores/app-store.webp"
            alt="App Store"
            class="h-[42px] w-auto sm:h-[54px]"
          />
        </div>
      </div>

      <!-- RIGHT -->
      <div class="relative mt-8 flex justify-center lg:mt-0 lg:justify-end">
        <img
          src="/images/home/app-devices.webp"
          alt="Velo app with vehicles"
          class="w-full max-w-[300px] object-contain sm:max-w-[520px] lg:max-w-[700px]"
        />
      </div>
    </div>
  </section>
</template>
