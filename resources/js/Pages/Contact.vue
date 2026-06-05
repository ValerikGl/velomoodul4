<script setup>
import { onMounted, onUnmounted, nextTick } from "vue";
import { MapPin, Phone, Mail, Send } from "lucide-vue-next";
import L from "leaflet";
import "leaflet/dist/leaflet.css";

let contactMap = null;

onMounted(async () => {
  await nextTick();

  contactMap = L.map("contact-map", {
    zoomControl: false,
    scrollWheelZoom: false,
  }).setView([59.438387, 24.758434], 15);

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "&copy; OpenStreetMap contributors",
  }).addTo(contactMap);

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

  L.marker([59.438387, 24.758434], { icon: veloIcon })
    .addTo(contactMap)
    .bindPopup("Velo punkt<br>Narva mnt 5")
    .openPopup();
});

onUnmounted(() => {
  if (contactMap) {
    contactMap.remove();
    contactMap = null;
  }
});
</script>

<template>
  <main class="bg-[#F8FAFC] px-5 py-12 sm:px-6 lg:py-16">
    <div class="mx-auto max-w-[1280px]">
      <!-- HERO -->
      <section v-reveal class="grid items-center gap-10 lg:grid-cols-[1fr_1fr]">
        <div>
          <h1
            class="text-[44px] font-extrabold leading-tight text-[#0F172A] sm:text-[58px]"
          >
            Võta meiega <br />
            ühendust
          </h1>

          <p
            class="mt-5 max-w-[560px] text-[18px] font-semibold leading-relaxed text-[#0F172A]"
          >
            Kas sul on küsimusi sõidukite, broneeringute või koostöö kohta? Meie
            meeskond aitab sind hea meelega.
          </p>
        </div>

        <div class="relative flex justify-center">
          <img
            src="/images/contact/contact-hero.webp"
            alt="Velo contact"
            class="w-full max-w-[560px] object-contain"
          />
        </div>
      </section>

      <!-- CONTACT CARDS -->
      <section v-reveal class="mt-14 grid gap-6 md:grid-cols-3">
        <article
          class="flex items-center gap-5 rounded-2xl bg-white p-6 shadow-[0_18px_45px_rgba(15,23,42,0.10)]"
        >
          <div
            class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-[#EDE4FF] text-[#6D28D9]"
          >
            <MapPin :size="42" />
          </div>

          <div>
            <h3 class="font-extrabold text-[#0F172A]">Asukoht</h3>
            <p class="mt-1 text-sm font-extrabold text-[#6D28D9]">Velo OÜ</p>
            <p class="text-sm font-semibold text-[#0F172A]">Narva mnt 5</p>
            <p class="text-sm font-semibold text-[#0F172A]">
              10117 Tallinn, Estonia
            </p>
          </div>
        </article>

        <article
          class="flex items-center gap-5 rounded-2xl bg-white p-6 shadow-[0_18px_45px_rgba(15,23,42,0.10)]"
        >
          <div
            class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-[#EDE4FF] text-[#6D28D9]"
          >
            <Phone :size="42" />
          </div>

          <div>
            <h3 class="font-extrabold text-[#0F172A]">Telefon</h3>
            <p class="mt-1 text-sm font-extrabold text-[#6D28D9]">
              +372 5432 1234
            </p>
            <p class="text-sm font-semibold text-[#0F172A]">E-R</p>
            <p class="text-sm font-semibold text-[#0F172A]">09:00 - 19:00</p>
          </div>
        </article>

        <article
          class="flex items-center gap-5 rounded-2xl bg-white p-6 shadow-[0_18px_45px_rgba(15,23,42,0.10)]"
        >
          <div
            class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-[#EDE4FF] text-[#6D28D9]"
          >
            <Mail :size="42" />
          </div>

          <div>
            <h3 class="font-extrabold text-[#0F172A]">E-post</h3>
            <p class="mt-1 text-sm font-extrabold text-[#6D28D9]">
              info@velo.ee
            </p>
            <p class="text-sm font-semibold text-[#0F172A]">
              Vastame tavaliselt
            </p>
            <p class="text-sm font-semibold text-[#0F172A]">24 tunni jooksul</p>
          </div>
        </article>
      </section>

      <!-- FORM + MAP -->
      <section
        v-reveal
        class="mt-12 grid gap-8 rounded-3xl bg-white p-6 shadow-[0_20px_60px_rgba(15,23,42,0.10)] lg:grid-cols-[340px_1fr] lg:p-8"
      >
        <form class="flex flex-col">
          <h2 class="text-[24px] font-extrabold text-[#0F172A]">
            Saada meile sõnum
          </h2>

          <label class="mt-7">
            <span class="text-sm font-extrabold text-[#0F172A]">Nimi</span>
            <input
              type="text"
              placeholder="Sinu nimi"
              class="mt-2 h-[46px] w-full rounded-lg border border-[#CBD5E1] bg-white px-4 text-sm font-semibold outline-none transition focus:border-[#6D28D9]"
            />
          </label>

          <label class="mt-4">
            <span class="text-sm font-extrabold text-[#0F172A]">E-post</span>
            <input
              type="email"
              placeholder="Sinu e-posti aadress"
              class="mt-2 h-[46px] w-full rounded-lg border border-[#CBD5E1] bg-white px-4 text-sm font-semibold outline-none transition focus:border-[#6D28D9]"
            />
          </label>

          <label class="mt-4">
            <span class="text-sm font-extrabold text-[#0F172A]">Sõnum</span>
            <textarea
              placeholder="Sinu sõnum"
              class="mt-2 h-[150px] w-full resize-none rounded-lg border border-[#CBD5E1] bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-[#6D28D9]"
            ></textarea>
          </label>

          <button
            type="button"
            class="mt-6 flex h-[46px] items-center justify-center gap-3 rounded-lg bg-[#6D28D9] text-sm font-bold text-white shadow-lg transition hover:bg-[#5B21B6]"
          >
            <Send :size="18" />
            Saada sõnum
          </button>
        </form>

        <div class="relative overflow-hidden rounded-2xl h-full min-h-[520px]">
          <div id="contact-map" class="brand-map absolute inset-0"></div>
        </div>
      </section>
    </div>
  </main>
</template>

<style scoped>
.brand-map {
  filter: saturate(0.8) contrast(1.05);
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
  width: 15px;
  height: 15px;
  border-radius: 999px;
  background: white;
}
</style>
