<script setup>
import { computed, ref, watch, onMounted, onUnmounted, nextTick } from "vue";
import { Link } from "@inertiajs/vue3";
import {
  ArrowRight,
  Star,
  Calendar,
  Heart,
  Gauge,
  MapPin,
  BatteryCharging,
  Weight,
  Clock,
  CheckCircle,
} from "lucide-vue-next";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import MainLayout from "../../Layouts/MainLayout.vue";
defineOptions({
  layout: MainLayout,
});

const props = defineProps({
  vehicle: {
    type: Object,
    required: true,
  },
});

let map = null;

const imageUrl = (path) => {
  if (!path) {
    return "/images/vehicles/velo-lite.webp";
  }

  if (path.startsWith("/")) {
    return path;
  }

  return `/storage/${path}`;
};

const galleryImages = computed(() => {
  const images = [];

  if (props.vehicle.image) {
    images.push(imageUrl(props.vehicle.image));
  }

  if (Array.isArray(props.vehicle.images)) {
    props.vehicle.images.forEach((image) => {
      if (image.path) {
        images.push(imageUrl(image.path));
      }
    });
  }

  return images.length ? images : ["/images/vehicles/velo-lite.webp"];
});

const activeImage = ref(galleryImages.value[0]);

watch(
  galleryImages,
  (images) => {
    activeImage.value = images[0];
  },
  { immediate: true },
);

const typeLabel = computed(() => {
  const labels = {
    scooter: "Elektritõukeratas",
    bike: "Elektrijalgratas",
    moped: "Elektrimopeed",
  };

  return labels[props.vehicle.type] || props.vehicle.type || "Sõiduk";
});

const price = computed(() => {
  const value = Number(props.vehicle.price_per_hour || 0);

  return `${value.toFixed(2)}€`;
});

const specs = computed(() => [
  {
    icon: Gauge,
    label: "Tippkiirus",
    value: props.vehicle.speed_kmh
      ? `${props.vehicle.speed_kmh} km/h`
      : "25 km/h",
  },
  {
    icon: MapPin,
    label: "Sõiduulatus",
    value: props.vehicle.range_km
      ? `${props.vehicle.range_km} km`
      : "—",
  },
  {
    icon: BatteryCharging,
    label: "Aku",
    value: props.vehicle.battery || "—",
  },
  {
    icon: Weight,
    label: "Kaal",
    value: "—",
  },
  {
    icon: Clock,
    label: "Laadimisaeg",
    value: "—",
  },
  {
    icon: MapPin,
    label: "Asukoht",
    value: props.vehicle.location || "Tallinn",
  },
]);

const benefits = computed(() => [
  "Kerge ja vastupidav konstruktsioon",
  `Kuni ${props.vehicle.range_km || "—"} km sõiduulatust ühe laadimisega`,
  "Võimas elektrimootor sujuvaks kiirenduseks",
  "Turvaline pidurisüsteem linnaliikluseks",
  "Integreeritud esi- ja tagatuled",
  "GPS-jälgimine ja nutikas lukustussüsteem",
]);

onMounted(async () => {
  await nextTick();

  const mapElement = document.getElementById("vehicle-map");

  if (!mapElement) {
    return;
  }

  map = L.map("vehicle-map", {
    zoomControl: false,
  }).setView([59.437, 24.7536], 15);

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "&copy; OpenStreetMap contributors",
  }).addTo(map);

  const veloIcon = L.divIcon({
    className: "velo-map-marker",
    html: `
      <div class="velo-marker">
        <div class="velo-marker-dot"></div>
      </div>
    `,
    iconSize: [46, 46],
    iconAnchor: [23, 46],
    popupAnchor: [0, -42],
  });

  L.marker([59.437, 24.7536], { icon: veloIcon })
    .addTo(map)
    .bindPopup(`${props.vehicle.location || "Tallinna Velo punkt"}<br>Narva mnt 5`)
    .openPopup();
});

onUnmounted(() => {
  if (map) {
    map.remove();
    map = null;
  }
});
</script>

<template>
  <main class="bg-[#F8FAFC] px-5 py-10 sm:px-6 lg:py-14">
    <div class="mx-auto max-w-[1280px]">
      <div
        class="mb-8 flex items-center gap-4 text-sm font-bold text-[#0F172A]"
      >
        <Link href="/" class="hover:text-[#6D28D9]">Avaleht</Link>

        <ArrowRight :size="16" />

        <Link href="/vehicles" class="hover:text-[#6D28D9]">
          Sõidukid
        </Link>

        <ArrowRight :size="16" />

        <span class="text-[#6D28D9]">{{ vehicle.name }}</span>
      </div>

      <section
        v-reveal
        class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center"
      >
        <div>
          <div
            class="overflow-hidden rounded-3xl bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.10)]"
          >
            <Transition name="fade-image" mode="out-in">
              <img
                :key="activeImage"
                :src="activeImage"
                :alt="vehicle.name"
                class="mx-auto h-[320px] w-full object-contain lg:h-[430px]"
              />
            </Transition>
          </div>

          <div
            v-if="galleryImages.length > 1"
            class="mt-8 grid grid-cols-3 gap-5"
          >
            <button
              v-for="image in galleryImages"
              :key="image"
              class="rounded-xl border-2 bg-white p-4 shadow-[0_10px_30px_rgba(15,23,42,0.08)] transition hover:-translate-y-1"
              :class="
                activeImage === image
                  ? 'border-[#6D28D9]'
                  : 'border-transparent'
              "
              @click="activeImage = image"
            >
              <img
                :src="image"
                :alt="`${vehicle.name} thumbnail`"
                class="h-[100px] w-full object-contain"
              />
            </button>
          </div>
        </div>

        <div>
          <div class="mb-5 flex gap-3">
            <span
              class="rounded-full bg-[#EDE4FF] px-4 py-2 text-[12px] font-extrabold text-[#6D28D9]"
            >
              {{ typeLabel }}
            </span>

            <span
              class="rounded-full bg-green-100 px-4 py-2 text-[12px] font-extrabold text-green-600"
            >
              Saadaval
            </span>
          </div>

          <h1
            class="text-[42px] font-extrabold leading-tight text-[#0F172A] lg:text-[56px]"
          >
            {{ vehicle.name }}
          </h1>

          <p class="mt-3 text-[22px] font-semibold text-[#0F172A]">
            {{ typeLabel }}
          </p>

          <div class="mt-7 flex items-center gap-2 font-bold text-[#0F172A]">
            <Star class="fill-yellow-400 text-yellow-400" :size="22" />
            <span>4.9 (324 arvustust)</span>
          </div>

          <p
            class="mt-7 max-w-[520px] text-[17px] font-semibold leading-relaxed text-slate-700"
          >
            {{ vehicle.description }}
          </p>

          <div class="my-8 h-px max-w-[520px] bg-[#DDD0FF]"></div>

          <p class="font-extrabold text-[#0F172A]">Hind tunnis</p>

          <div class="mt-2 flex items-end gap-1">
            <span class="text-[42px] font-extrabold text-[#6D28D9]">
              {{ price }}
            </span>
            <span class="pb-2 text-[18px] font-extrabold text-[#0F172A]">
              /h
            </span>
          </div>

          <div class="mt-6 flex items-center gap-4">
            <Link
              href="/contact"
              class="inline-flex items-center gap-3 rounded-xl bg-[#6D28D9] px-7 py-4 font-bold text-white shadow-lg transition hover:scale-105 hover:bg-[#5B21B6] active:scale-95"
            >
              <Calendar :size="20" />
              Broneeri Kohe
            </Link>

            <button
              class="flex h-14 w-14 items-center justify-center rounded-full bg-white text-[#6D28D9] shadow-xl transition hover:scale-110"
            >
              <Heart :size="24" />
            </button>
          </div>
        </div>
      </section>

      <section v-reveal class="mt-16">
        <h2 class="mb-6 text-[24px] font-extrabold text-[#0F172A]">
          Tehnilised andmed
        </h2>

        <div
          class="grid gap-5 rounded-3xl bg-white p-6 shadow-[0_20px_60px_rgba(15,23,42,0.10)] sm:grid-cols-2 lg:grid-cols-6"
        >
          <div
            v-for="spec in specs"
            :key="spec.label"
            class="rounded-2xl bg-[#F8FAFC] p-5 text-center shadow-[0_10px_30px_rgba(15,23,42,0.10)] transition hover:-translate-y-1"
          >
            <p class="font-bold text-[#0F172A]">
              {{ spec.label }}
            </p>

            <component
              :is="spec.icon"
              class="mx-auto mt-4 text-[#6D28D9]"
              :size="46"
            />

            <p class="mt-4 font-extrabold text-[#0F172A]">
              {{ spec.value }}
            </p>
          </div>
        </div>
      </section>

      <section v-reveal class="mt-10 grid gap-8 lg:grid-cols-[380px_1fr]">
        <article
          class="rounded-3xl bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.10)]"
        >
          <h2 class="text-[24px] font-extrabold text-[#0F172A]">Kirjeldus</h2>

          <p
            class="mt-6 text-[15px] font-semibold leading-relaxed text-[#0F172A]"
          >
            {{ vehicle.description }}
          </p>

          <p
            class="mt-5 text-[15px] font-semibold leading-relaxed text-[#0F172A]"
          >
            Elegantne disain, võimas aku ja kvaliteetsed komponendid tagavad
            sujuva sõidukogemuse nii igapäevasteks töölesõitudeks kui ka
            pikemateks linnaseiklusteks.
          </p>

          <ul class="mt-7 space-y-3">
            <li
              v-for="benefit in benefits"
              :key="benefit"
              class="flex items-start gap-3 text-sm font-semibold text-[#0F172A]"
            >
              <CheckCircle class="mt-0.5 shrink-0 text-[#6D28D9]" :size="18" />
              <span>{{ benefit }}</span>
            </li>
          </ul>
        </article>

        <article
          class="relative overflow-hidden rounded-3xl bg-white shadow-[0_20px_60px_rgba(15,23,42,0.10)]"
        >
          <div
            id="vehicle-map"
            class="h-full brand-map min-h-[420px] w-full"
          ></div>

          <div
            class="pointer-events-none absolute left-0 top-0 z-[500] rounded-br-3xl bg-white p-8 shadow-[0_15px_40px_rgba(15,23,42,0.12)]"
          >
            <h2 class="text-[24px] font-extrabold text-[#0F172A]">Saadavus</h2>

            <p class="mt-4 font-extrabold text-[#6D28D9]">
              {{ vehicle.location || "Tallinna Velo punkt" }}
            </p>

            <p class="mt-2 font-bold text-[#0F172A]">Narva mnt 5</p>
          </div>
        </article>
      </section>
    </div>
  </main>
</template>

<style scoped>
.fade-image-enter-active,
.fade-image-leave-active {
  transition:
    opacity 0.25s ease,
    transform 0.25s ease;
}

.fade-image-enter-from,
.fade-image-leave-to {
  opacity: 0;
  transform: scale(0.98);
}

.brand-map {
  filter: saturate(0.75) contrast(1.05);
}

.brand-map::after {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(109, 40, 217, 0.12);
  pointer-events: none;
  z-index: 450;
}

:deep(.velo-marker) {
  width: 46px;
  height: 46px;
  border-radius: 999px 999px 999px 0;
  background: #6d28d9;
  transform: rotate(-45deg);
  box-shadow: 0 12px 30px rgba(109, 40, 217, 0.35);
  display: flex;
  align-items: center;
  justify-content: center;
}

:deep(.velo-marker-dot) {
  width: 16px;
  height: 16px;
  border-radius: 999px;
  background: white;
}
</style>