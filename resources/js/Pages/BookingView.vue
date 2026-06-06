<script setup>
import { computed, ref, onMounted, onUnmounted, nextTick } from "vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import {
  ArrowRight,
  Calendar,
  Clock,
  Hourglass,
  MapPin,
  Gauge,
  BatteryCharging,
  CreditCard,
  User,
  Mail,
} from "lucide-vue-next";

import L from "leaflet";
import "leaflet/dist/leaflet.css";
import MainLayout from "../Layouts/MainLayout.vue";

defineOptions({
  layout: MainLayout,
});

const props = defineProps({
  vehicle: {
    type: Object,
    required: true,
  },
});

const page = usePage();
const vehicle = computed(() => props.vehicle);

const imageUrl = (path) => {
  if (!path) return "/images/vehicles/velo-lite.webp";
  if (path.startsWith("/")) return path;
  return `/storage/${path}`;
};

const vehicleImage = computed(() => imageUrl(vehicle.value.image));

const vehiclePrice = computed(() => Number(vehicle.value.price_per_hour || 0));

const selectedDate = ref(new Date().toISOString().split("T")[0]);
const selectedTime = ref("14:00");
const selectedDuration = ref(2);
const selectedCountryCode = ref("+372");
const phoneNumber = ref("");

const form = useForm({
  name: "",
  email: "",
  phone: "",
  booking_date: selectedDate.value,
  start_time: selectedTime.value,
  duration_hours: selectedDuration.value,
});

const serviceFee = 1;

const totalPrice = computed(() => {
  return vehiclePrice.value * Number(selectedDuration.value) + serviceFee;
});

const returnInfo = computed(() => {
  const [hours, minutes] = selectedTime.value.split(":").map(Number);

  let returnHours = hours + Number(selectedDuration.value);
  let returnDate = new Date(selectedDate.value);

  if (returnHours >= 19) {
    returnDate.setDate(returnDate.getDate() + 1);
    returnHours = 8;
  }

  return {
    time: `${String(returnHours).padStart(2, "0")}:${String(minutes).padStart(2, "0")}`,
    date: returnDate.toISOString().split("T")[0],
  };
});

const submitBooking = () => {
  form.phone = `${selectedCountryCode.value} ${phoneNumber.value}`;
  form.booking_date = selectedDate.value;
  form.start_time = selectedTime.value;
  form.duration_hours = selectedDuration.value;

  form.post(`/booking/${vehicle.value.slug}`, {
    preserveScroll: true,
  });
};

const dateInput = ref(null);

const openDatePicker = () => {
  dateInput.value?.showPicker?.();
};

let bookingMap = null;

onMounted(async () => {
  await nextTick();

  bookingMap = L.map("booking-map", {
    zoomControl: false,
    scrollWheelZoom: false,
  }).setView([59.438387, 24.758434], 15);

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "&copy; OpenStreetMap contributors",
  }).addTo(bookingMap);

  const veloIcon = L.divIcon({
    className: "velo-map-marker",
    html: `
      <div class="velo-marker">
        <div class="velo-marker-dot"></div>
      </div>
    `,
    iconSize: [42, 42],
    iconAnchor: [21, 42],
    popupAnchor: [0, -38],
  });

  L.marker([59.438387, 24.758434], { icon: veloIcon })
    .addTo(bookingMap)
    .bindPopup("Velo punkt<br>Narva mnt 5");
});

onUnmounted(() => {
  if (bookingMap) {
    bookingMap.remove();
    bookingMap = null;
  }
});
</script>

<template>
  <main class="bg-[#F8FAFC] px-5 py-10 sm:px-6 lg:py-14">
    <div class="mx-auto max-w-[1280px]">
      <div class="mb-8 flex flex-wrap items-center gap-3 text-sm font-bold text-[#0F172A]">
        <Link href="/" class="hover:text-[#6D28D9]">Avaleht</Link>
        <ArrowRight :size="16" />
        <Link href="/vehicles" class="hover:text-[#6D28D9]">Sõidukid</Link>
        <ArrowRight :size="16" />
        <Link :href="`/vehicles/${vehicle.slug}`" class="hover:text-[#6D28D9]">
          {{ vehicle.name }}
        </Link>
        <ArrowRight :size="16" />
        <span class="text-[#6D28D9]">Broneering</span>
      </div>

      <div class="grid items-start gap-6 xl:grid-cols-[1fr_320px]">
        <div
          v-reveal
          class="rounded-3xl bg-white p-6 shadow-[0_20px_60px_rgba(15,23,42,0.08)] lg:p-8"
        >
          <section>
            <h2 class="text-[24px] font-extrabold text-[#0F172A]">
              1. Valitud sõiduk
            </h2>

            <div class="mt-5 grid gap-7 lg:grid-cols-[340px_1fr]">
              <div class="flex h-[220px] items-center justify-center overflow-hidden rounded-2xl bg-[#F8FAFC]">
                <img
                  :src="vehicleImage"
                  :alt="vehicle.name"
                  class="h-full w-full object-contain transition"
                />
              </div>

              <div class="flex h-full flex-col">
                <div class="flex flex-col gap-5 xl:flex-row xl:items-start xl:justify-between">
                  <div>
                    <h1 class="whitespace-nowrap text-[38px] font-extrabold leading-none text-[#0F172A] xl:text-[44px]">
                      {{ vehicle.name }}
                    </h1>

                    <p class="mt-3 text-[18px] font-semibold text-[#0F172A]">
                      {{ vehicle.type }}
                    </p>
                  </div>

                  <div class="shrink-0 whitespace-nowrap text-[40px] font-extrabold leading-none text-[#6D28D9] xl:text-[46px]">
                    {{ vehiclePrice.toFixed(2) }}€<span class="text-[22px] text-[#0F172A]">/h</span>
                  </div>
                </div>

                <div class="mt-6 space-y-3 text-[16px] font-bold text-[#0F172A]">
                  <div class="flex items-center gap-3">
                    <Gauge :size="20" class="text-[#6D28D9]" />
                    {{ vehicle.speed_kmh || 25 }} km/h
                  </div>

                  <div class="flex items-center gap-3">
                    <MapPin :size="20" class="text-[#6D28D9]" />
                    {{ vehicle.range_km }} km
                  </div>

                  <div class="flex items-center gap-3">
                    <BatteryCharging :size="20" class="text-[#6D28D9]" />
                    {{ vehicle.battery || "—" }}
                  </div>
                </div>

                <div class="mt-auto flex justify-end pt-6">
                  <Link
                    href="/vehicles"
                    class="inline-flex h-[46px] w-[270px] items-center justify-center rounded-xl border border-[#6D28D9] text-sm font-bold text-[#6D28D9] transition hover:bg-[#F3E8FF]"
                  >
                    Muuda sõidukit
                  </Link>
                </div>
              </div>
            </div>
          </section>

          <section class="mt-9 border-t border-[#E9D9FF] pt-8">
            <h2 class="text-[24px] font-extrabold text-[#0F172A]">
              2. Kuupäev ja kellaaeg
            </h2>

            <div class="mt-5 grid gap-4 md:grid-cols-3">
              <div class="relative">
                <span class="mb-2 block text-sm font-extrabold text-[#0F172A]">
                  Kuupäev
                </span>

                <button
                  type="button"
                  class="flex h-[64px] w-full items-center justify-between gap-4 rounded-2xl border border-[#CBD5E1] bg-white px-5 shadow-sm transition hover:border-[#6D28D9]"
                  @click="openDatePicker"
                >
                  <div class="flex items-center gap-4">
                    <Calendar :size="24" class="text-[#6D28D9]" />
                    <span class="text-[18px] font-bold text-[#0F172A]">
                      {{ selectedDate }}
                    </span>
                  </div>
                </button>

                <input
                  ref="dateInput"
                  v-model="selectedDate"
                  type="date"
                  class="pointer-events-none absolute opacity-0"
                />

                <p v-if="form.errors.booking_date" class="mt-1 text-xs font-bold text-red-600">
                  {{ form.errors.booking_date }}
                </p>
              </div>

              <div class="group relative">
                <span class="mb-2 block text-sm font-extrabold text-[#0F172A]">
                  Algusaeg
                </span>

                <div class="flex h-[64px] items-center gap-4 rounded-2xl border border-[#CBD5E1] bg-white px-5 shadow-sm">
                  <Clock :size="24" class="text-[#6D28D9]" />
                  <span class="text-[18px] font-bold text-[#0F172A]">
                    {{ selectedTime }}
                  </span>
                </div>

                <select
                  v-model="selectedTime"
                  class="absolute bottom-0 left-0 h-[64px] w-full cursor-pointer opacity-0"
                >
                  <option>08:00</option>
                  <option>09:00</option>
                  <option>10:00</option>
                  <option>11:00</option>
                  <option>12:00</option>
                  <option>13:00</option>
                  <option>14:00</option>
                  <option>15:00</option>
                  <option>16:00</option>
                </select>

                <p v-if="form.errors.start_time" class="mt-1 text-xs font-bold text-red-600">
                  {{ form.errors.start_time }}
                </p>
              </div>

              <div class="group relative">
                <span class="mb-2 block text-sm font-extrabold text-[#0F172A]">
                  Kestus
                </span>

                <div class="flex h-[64px] items-center gap-4 rounded-2xl border border-[#CBD5E1] bg-white px-5 shadow-sm">
                  <Hourglass :size="24" class="text-[#6D28D9]" />
                  <span class="text-[18px] font-bold text-[#0F172A]">
                    {{ selectedDuration }} tundi
                  </span>
                </div>

                <select
                  v-model="selectedDuration"
                  class="absolute bottom-0 left-0 h-[64px] w-full cursor-pointer opacity-0"
                >
                  <option :value="1">1 tund</option>
                  <option :value="2">2 tundi</option>
                  <option :value="3">3 tundi</option>
                  <option :value="4">4 tundi</option>
                  <option :value="5">5 tundi</option>
                  <option :value="6">6 tundi</option>
                  <option :value="7">7 tundi</option>
                  <option :value="8">8 tundi</option>
                </select>

                <p v-if="form.errors.duration_hours" class="mt-1 text-xs font-bold text-red-600">
                  {{ form.errors.duration_hours }}
                </p>
              </div>
            </div>

            <div class="mt-5 flex items-center gap-3 rounded-2xl border border-[#C4B5FD] bg-[#EDE4FF] px-5 py-4 text-sm font-extrabold text-[#6D28D9]">
              <Clock :size="20" />
              <span>
                Tagastamine hiljemalt {{ returnInfo.time }}, {{ returnInfo.date }}
              </span>
            </div>
          </section>

          <section class="mt-10 border-t border-[#E9D9FF] pt-8">
            <h2 class="text-[24px] font-extrabold text-[#0F172A]">
              3. Asukoht
            </h2>

            <div class="relative mt-5 overflow-hidden rounded-2xl">
              <div id="booking-map" class="brand-map h-[280px] w-full"></div>

              <div class="absolute left-0 top-0 z-[500] flex items-center gap-4 rounded-br-2xl bg-white/95 px-8 py-6 shadow-[0_12px_35px_rgba(15,23,42,0.12)]">
                <MapPin class="text-[#6D28D9]" :size="58" />

                <div>
                  <h3 class="text-[17px] font-extrabold text-[#0F172A]">
                    Tallinn Kesklinn
                  </h3>

                  <p class="mt-1 text-[16px] font-bold text-[#0F172A]">
                    {{ vehicle.location }}
                  </p>
                </div>
              </div>
            </div>
          </section>

          <section class="mt-10 border-t border-[#E9D9FF] pt-8">
            <h2 class="text-[24px] font-extrabold text-[#0F172A]">
              4. Kasutaja andmed
            </h2>

            <div class="mt-5 grid gap-4 md:grid-cols-3">
              <label>
                <span class="text-sm font-extrabold text-[#0F172A]">Nimi</span>
                <div class="mt-2 flex items-center gap-3 rounded-xl border border-[#CBD5E1] px-4 py-3">
                  <User class="text-[#6D28D9]" :size="18" />
                  <input
                    v-model="form.name"
                    placeholder="Sisesta oma nimi"
                    class="w-full bg-transparent text-sm outline-none"
                  />
                </div>
                <p v-if="form.errors.name" class="mt-1 text-xs font-bold text-red-600">
                  {{ form.errors.name }}
                </p>
              </label>

              <label>
                <span class="text-sm font-extrabold text-[#0F172A]">E-post</span>
                <div class="mt-2 flex items-center gap-3 rounded-xl border border-[#CBD5E1] px-4 py-3">
                  <Mail class="text-[#6D28D9]" :size="18" />
                  <input
                    v-model="form.email"
                    type="email"
                    placeholder="Sisesta oma e-post"
                    class="w-full bg-transparent text-sm outline-none"
                  />
                </div>
                <p v-if="form.errors.email" class="mt-1 text-xs font-bold text-red-600">
                  {{ form.errors.email }}
                </p>
              </label>

              <label>
                <span class="text-sm font-extrabold text-[#0F172A]">Telefon</span>

                <div class="mt-2 flex h-[45px] items-center rounded-xl border border-[#CBD5E1] bg-white px-4">
                  <select
                    v-model="selectedCountryCode"
                    class="mr-3 h-full w-[76px] cursor-pointer bg-transparent text-sm font-extrabold text-[#0F172A] outline-none"
                  >
                    <option value="+372">🇪🇪 +372</option>
                    <option value="+371">🇱🇻 +371</option>
                    <option value="+370">🇱🇹 +370</option>
                    <option value="+358">🇫🇮 +358</option>
                  </select>

                  <div class="mr-3 h-6 w-px shrink-0 bg-[#CBD5E1]"></div>

                  <input
                    v-model="phoneNumber"
                    type="tel"
                    placeholder="Telefoninumber"
                    class="min-w-0 flex-1 bg-transparent text-sm font-semibold outline-none placeholder:text-slate-400"
                  />
                </div>

                <p v-if="form.errors.phone" class="mt-1 text-xs font-bold text-red-600">
                  {{ form.errors.phone }}
                </p>
              </label>
            </div>
          </section>
        </div>

        <aside class="h-fit self-start xl:sticky xl:top-28">
          <div
            v-reveal
            class="rounded-3xl bg-white p-6 shadow-[0_20px_60px_rgba(15,23,42,0.08)]"
          >
            <h3 class="text-[18px] font-extrabold text-[#0F172A]">
              Broneeringu kokkuvõte
            </h3>

            <div
              v-if="page.props.flash?.success"
              class="mt-4 rounded-2xl border border-[#DDD0FF] bg-[#F8FAFC] p-4 shadow-[0_14px_35px_rgba(109,40,217,0.14)]"
            >
              <p class="font-extrabold text-[#6D28D9]">
                🎉 Broneering kinnitatud!
              </p>
              <p class="mt-1 text-sm text-slate-600">
                Sinu broneering on edukalt salvestatud.
              </p>
            </div>

            <div class="mt-6 flex gap-4">
              <div class="flex h-20 w-24 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-[#F8FAFC]">
                <img
                  :src="vehicleImage"
                  :alt="vehicle.name"
                  class="h-full w-full object-contain"
                />
              </div>

              <div class="min-w-0">
                <h4 class="text-[15px] font-extrabold text-[#0F172A]">
                  {{ vehicle.name }}
                </h4>

                <p class="mt-1 text-sm text-slate-600">
                  {{ vehicle.type }}
                </p>

                <p class="mt-2 text-[18px] font-extrabold text-[#6D28D9]">
                  {{ vehiclePrice.toFixed(2) }}€/h
                </p>
              </div>
            </div>

            <div class="mt-6 border-t border-[#E9D9FF] pt-6">
              <div class="space-y-4 text-[14px]">
                <div class="flex items-center justify-between">
                  <span class="font-bold text-[#0F172A]">Kuupäev</span>
                  <span class="font-extrabold text-[#0F172A]">{{ selectedDate }}</span>
                </div>

                <div class="flex items-center justify-between">
                  <span class="font-bold text-[#0F172A]">Aeg</span>
                  <span class="font-extrabold text-[#0F172A]">{{ selectedTime }}</span>
                </div>

                <div class="flex items-center justify-between">
                  <span class="font-bold text-[#0F172A]">Kestus</span>
                  <span class="font-extrabold text-[#0F172A]">{{ selectedDuration }} tundi</span>
                </div>

                <div class="flex items-center justify-between">
                  <span class="font-bold text-[#0F172A]">Asukoht</span>
                  <span class="max-w-[120px] text-right font-extrabold text-[#0F172A]">
                    {{ vehicle.location }}
                  </span>
                </div>
              </div>
            </div>

            <div class="mt-6 border-t border-[#E9D9FF] pt-6">
              <div class="space-y-3 text-[14px]">
                <div class="flex justify-between">
                  <span class="font-bold text-[#0F172A]">Hind tunnis</span>
                  <span class="font-extrabold text-[#0F172A]">{{ vehiclePrice.toFixed(2) }}€</span>
                </div>

                <div class="flex justify-between">
                  <span class="font-bold text-[#0F172A]">Vahesumma</span>
                  <span class="font-extrabold text-[#0F172A]">
                    {{ (vehiclePrice * selectedDuration).toFixed(2) }}€
                  </span>
                </div>

                <div class="flex justify-between">
                  <span class="font-bold text-[#0F172A]">Teenustasu</span>
                  <span class="font-extrabold text-[#0F172A]">{{ serviceFee.toFixed(2) }}€</span>
                </div>
              </div>
            </div>

            <div class="mt-8 flex items-end justify-between">
              <span class="text-[20px] font-extrabold text-[#0F172A]">
                Kokku
              </span>

              <span class="text-[44px] font-extrabold leading-none text-[#6D28D9]">
                {{ totalPrice.toFixed(2) }}€
              </span>
            </div>

            <button
              type="button"
              :disabled="form.processing"
              class="mt-6 flex h-[56px] w-full items-center justify-center gap-3 rounded-2xl bg-[#6D28D9] font-bold text-white shadow-[0_12px_30px_rgba(109,40,217,0.35)] transition hover:bg-[#5B21B6] disabled:cursor-not-allowed disabled:opacity-60"
              @click="submitBooking"
            >
              <CreditCard :size="20" />
              {{ form.processing ? "Salvestan..." : "Kinnita Broneering" }}
            </button>
          </div>
        </aside>
      </div>
    </div>
  </main>
</template>

<style scoped>
.brand-map {
  filter: saturate(0.8) contrast(1.05);
}

:deep(.velo-marker) {
  width: 42px;
  height: 42px;
  border-radius: 999px 999px 999px 0;
  background: #6d28d9;
  transform: rotate(-45deg);
  box-shadow: 0 12px 30px rgba(109, 40, 217, 0.35);
  display: flex;
  align-items: center;
  justify-content: center;
}

:deep(.velo-marker-dot) {
  width: 14px;
  height: 14px;
  border-radius: 999px;
  background: white;
}
</style>