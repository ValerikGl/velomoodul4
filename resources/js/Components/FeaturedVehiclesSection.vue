<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { RouterLink } from 'vue-router'

import {
  ArrowRight,
  ArrowLeft,
  Gauge,
  BatteryCharging,
  ShieldCheck,
  Wrench,
  Lock,
  PhoneCall,
} from 'lucide-vue-next'

const currentIndex = ref(0)
const direction = ref('next')
const isAnimating = ref(false)
const isMobile = ref(false)

const vehicles = [
  {
    tag: 'POPULAARNE',
    name: 'Velo Lite',
    desc: 'Võimas elektritõukeratas igapäevaseks linnakasutuseks',
    speed: '25 km/h',
    range: '50 km',
    img: '/images/vehicles/velo-lite.webp',
    imageScale: "scale-[1.3]",
  },
  {
    tag: 'UUS',
    name: 'Velo Ride',
    desc: 'Elektrimootoriga linnamopeed pikemateks sõitudeks',
    speed: '45 km/h',
    range: '80 km',
    img: '/images/vehicles/velo-ride.webp',
    imageScale: "scale-[1.25]",
  },
  {
    tag: 'PREEMIUM',
    name: 'Velo Urban',
    desc: 'Kaasaegne elektrijalgratas aktiivseks kasutamiseks',
    speed: '25 km/h',
    range: '75 km',
    img: '/images/vehicles/velo-urban.webp',
    imageScale: "scale-[1.35]",
  },
  {
    tag: 'UUS',
    name: 'Velo Pro',
    desc: 'Kerge elektritõukeratas kiireks linnas liikumiseks',
    speed: '25 km/h',
    range: '45 km',
    img: '/images/vehicles/velo-pro.webp',
    imageScale: "scale-[1.15]",
  },
  {
    tag: 'COMFORT',
    name: 'Velo Cruise',
    desc: 'Dünaamiline mudel kiireks ja aktiivseks linnasõiduks',
    speed: '30 km/h',
    range: '60 km',
    img: '/images/vehicles/velo-cruise.webp',
    imageScale: "scale-[1.25]",
  },
  {
    tag: 'MAX',
    name: 'Velo City',
    desc: 'Kõrge sõiduulatusega mudel pikemateks linnateekondadeks',
    speed: '35 km/h',
    range: '90 km',
    img: '/images/vehicles/velo-city.webp',
    imageScale: "scale-[1.5]",
  },
]

const checkScreen = () => {
  isMobile.value = window.innerWidth < 1024
}

onMounted(() => {
  checkScreen()
  window.addEventListener('resize', checkScreen)
})

onUnmounted(() => {
  window.removeEventListener('resize', checkScreen)
})

const unlockAnimation = () => {
  window.setTimeout(() => {
    isAnimating.value = false
  }, 600)
}

const getStep = () => (isMobile.value ? 1 : 3)

const nextSlide = () => {
  if (isAnimating.value) return

  isAnimating.value = true
  direction.value = 'next'
  currentIndex.value = (currentIndex.value + getStep()) % vehicles.length
  unlockAnimation()
}

const prevSlide = () => {
  if (isAnimating.value) return

  isAnimating.value = true
  direction.value = 'prev'
  currentIndex.value = (currentIndex.value - getStep() + vehicles.length) % vehicles.length
  unlockAnimation()
}

const visibleVehicles = computed(() => {
  if (isMobile.value) {
    return [vehicles[currentIndex.value]]
  }

  return [
    vehicles[currentIndex.value],
    vehicles[(currentIndex.value + 1) % vehicles.length],
    vehicles[(currentIndex.value + 2) % vehicles.length],
  ]
})
</script>

<template>
  <section class="bg-[#F8FAFC] py-20 lg:py-24">
    <div class="mx-auto max-w-[1280px] px-5 sm:px-6">
      <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
        <div>
          <h2 class="text-[38px] font-extrabold leading-tight text-[#0F172A] sm:text-[56px]">
            Uusimad <span class="text-[#6D28D9]">sõidukid</span>
          </h2>

          <p class="mt-5 max-w-[620px] text-[18px] leading-relaxed text-[#0F172A] sm:text-[22px]">
            Kaasaegsed ja hooldatud elektritõukerattad, mis muudavad sinu liikumise linnas
            kiiremaks.
          </p>
        </div>

        <RouterLink
          to="/vehicles"
          class="hidden items-center gap-3 rounded-xl bg-[#6D28D9] px-7 py-4 font-bold text-white shadow-md transition hover:bg-[#5B21B6] lg:flex"
        >
          Vaata kõiki sõidukeid
          <ArrowRight :size="20" />
        </RouterLink>
      </div>

      <div class="relative mt-12 overflow-visible px-4 py-4 sm:px-10 lg:mt-16 lg:px-14">
        <button
          class="absolute left-0 top-1/2 z-30 flex h-12 w-12 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-white text-[#6D28D9] shadow-xl transition-all duration-300 hover:scale-110 hover:shadow-2xl disabled:opacity-50 lg:h-16 lg:w-16"
          :disabled="isAnimating"
          @click="prevSlide"
        >
          <ArrowLeft :size="28" />
        </button>

        <Transition :name="direction === 'next' ? 'slide-next' : 'slide-prev'" mode="out-in">
          <div :key="currentIndex" class="mx-auto grid max-w-[1120px] grid-cols-1 gap-8 lg:grid-cols-3">
            <article
              v-for="vehicle in visibleVehicles"
              :key="vehicle.name + vehicle.tag + vehicle.range"
              class="rounded-[24px] bg-white p-5 shadow-[0_20px_60px_rgba(15,23,42,0.12)] transition duration-300 hover:-translate-y-2 lg:min-h-[520px] lg:p-6"
            >
              <span class="rounded-full bg-[#EDE4FF] px-4 py-2 text-[12px] font-bold text-[#6D28D9]">
                {{ vehicle.tag }}
              </span>

              <img
                :src="vehicle.img"
                :alt="vehicle.name"
                :class="vehicle.imageScale"
                class="mx-auto mt-4 h-[150px] w-full object-contain transition-transform duration-300 hover:scale-105 lg:h-[220px]"
              />

              <h3 class="mt-3 text-[22px] font-extrabold text-[#0F172A] lg:mt-4 lg:text-[28px]">
                {{ vehicle.name }}
              </h3>

              <p class="mt-2 min-h-[50px] text-[15px] leading-snug text-[#0F172A] lg:min-h-[60px] lg:text-[18px]">
                {{ vehicle.desc }}
              </p>

              <div class="mt-5 grid grid-cols-2 gap-3 lg:gap-4">
                <div class="flex items-center gap-2 lg:gap-3">
                  <Gauge class="text-[#6D28D9]" :size="24" />
                  <div>
                    <div class="text-sm font-extrabold text-[#0F172A] lg:text-base">
                      {{ vehicle.speed }}
                    </div>
                    <div class="text-[11px] text-slate-500 lg:text-[13px]">
                      Maksimaalne kiirus
                    </div>
                  </div>
                </div>

                <div class="flex items-center gap-2 lg:gap-3">
                  <BatteryCharging class="text-[#6D28D9]" :size="24" />
                  <div>
                    <div class="text-sm font-extrabold text-[#0F172A] lg:text-base">
                      {{ vehicle.range }}
                    </div>
                    <div class="text-[11px] text-slate-500 lg:text-[13px]">
                      Sõiduulatus
                    </div>
                  </div>
                </div>
              </div>

              <RouterLink
                to="/vehicles"
                class="mt-5 flex items-center justify-center gap-3 rounded-xl border border-[#6D28D9] bg-[#F3E8FF] px-5 py-3 font-bold text-[#6D28D9] transition hover:bg-[#EDE4FF] lg:mt-6"
              >
                Vaata lähemalt
                <ArrowRight :size="18" />
              </RouterLink>
            </article>
          </div>
        </Transition>

        <button
          class="absolute right-0 top-1/2 z-30 flex h-12 w-12 translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-white text-[#6D28D9] shadow-xl transition-all duration-300 hover:scale-110 hover:shadow-2xl disabled:opacity-50 lg:h-16 lg:w-16"
          :disabled="isAnimating"
          @click="nextSlide"
        >
          <ArrowRight :size="28" />
        </button>
      </div>

      <div
        class="mx-auto mt-12 grid max-w-[1120px] gap-4 rounded-2xl bg-white px-6 py-5 shadow-[0_18px_50px_rgba(15,23,42,0.12)] md:grid-cols-2 lg:grid-cols-4"
      >
        <div class="flex items-center gap-3">
          <ShieldCheck class="shrink-0 text-[#6D28D9]" :size="34" />
          <div>
            <h3 class="whitespace-nowrap text-[16px] font-extrabold text-[#0F172A]">
              Kindlustatud sõidukid
            </h3>
            <p class="text-[13px] text-slate-600">
              Kõik sõidukid on kindlustatud
            </p>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <Wrench class="shrink-0 text-[#6D28D9]" :size="34" />
          <div>
            <h3 class="whitespace-nowrap text-[16px] font-extrabold text-[#0F172A]">
              Regulaarselt hooldatud
            </h3>
            <p class="text-[13px] text-slate-600">
              Tehniline kontroll enne iga sõitu
            </p>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <Lock class="shrink-0 text-[#6D28D9]" :size="34" />
          <div>
            <h3 class="whitespace-nowrap text-[16px] font-extrabold text-[#0F172A]">
              Turvaline kasutamine
            </h3>
            <p class="text-[13px] text-slate-600">
              Kaasaegsed GPS süsteemid
            </p>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <PhoneCall class="shrink-0 text-[#6D28D9]" :size="34" />
          <div>
            <h3 class="whitespace-nowrap text-[16px] font-extrabold text-[#0F172A]">
              Tugi 24/7
            </h3>
            <p class="text-[13px] text-slate-600">
              Abi alati ühe klikiga
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.slide-next-enter-active,
.slide-next-leave-active,
.slide-prev-enter-active,
.slide-prev-leave-active {
  transition:
    transform 0.55s cubic-bezier(0.16, 1, 0.3, 1),
    opacity 0.55s ease;
}

.slide-next-enter-from {
  opacity: 0;
  transform: translateX(120px) scale(0.97);
}

.slide-next-leave-to {
  opacity: 0;
  transform: translateX(-120px) scale(0.97);
}

.slide-prev-enter-from {
  opacity: 0;
  transform: translateX(-120px) scale(0.97);
}

.slide-prev-leave-to {
  opacity: 0;
  transform: translateX(120px) scale(0.97);
}
</style>