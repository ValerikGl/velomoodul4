<script setup>
import { Shield, Zap, Heart, Leaf, ArrowRight } from "lucide-vue-next";

const values = [
  {
    icon: Leaf,
    title: "Keskkonnasõbralikkus",
    text: "Toetame rohelisemat tulevikku, vähendades linnas heitkoguseid ja ummikuid.",
  },
  {
    icon: Shield,
    title: "Usaldusväärsus",
    text: "Pakume kvaliteetseid ja hooldatud sõidukeid, et saaksid alati kindel olla oma teekonnas.",
  },
  {
    icon: Zap,
    title: "Innovatsioon",
    text: "Toome pidevalt uusi lahendusi, mis teevad liikumise nutikamaks ja mugavamaks.",
  },
  {
    icon: Heart,
    title: "Inimesed",
    text: "Meie jaoks oled sina oluline. Loome kogemuse, mis paneb sind naeratama.",
  },
];

const stats = [
  {
    value: "2022",
    label: "Asutamise aasta",
  },
  {
    value: "350+",
    label: "Sõidukit",
  },
  {
    value: "5000+",
    label: "Rahulolevat klienti",
  },
];
</script>

<template>
  <main class="bg-[#F8FAFC] px-5 pb-12 pt-6 sm:px-6 lg:pb-16 lg:pt-8">
    <div class="mx-auto max-w-[1280px]">
      <!-- HERO -->
      <section
        v-reveal
        class="grid items-center gap-8 pb-10 pt-4 lg:grid-cols-[1fr_1fr] lg:pb-12 lg:pt-6"
      >
        <div>
          <h1
            class="text-[42px] font-extrabold leading-tight text-[#0F172A] sm:text-[56px]"
          >
            Meie missioon <br />
            on liikuv vabadus
          </h1>

          <p
            class="mt-5 max-w-[620px] text-[17px] font-semibold leading-relaxed text-[#0F172A]"
          >
            Velo toob inimestele nutikaid ja keskkonnasõbralikke
            liikumislahendusi, mis teevad linna paremini ligipääsetavaks
            kõigile.
          </p>
        </div>

        <div class="relative flex justify-center">
          <img
            src="/images/about/about-mascot.webp"
            alt="Velo maskott"
            class="relative z-10 w-full max-w-[420px] object-contain"
          />

          <div
            class="absolute right-0 top-1/2 z-20 hidden w-[240px] -translate-y-1/2 rounded-3xl bg-white p-5 shadow-[0_18px_45px_rgba(15,23,42,0.10)] lg:block"
          >
            <span
              class="rounded-full bg-[#EDE4FF] px-3 py-1 text-xs font-extrabold text-[#6D28D9]"
            >
              MEIE MASKOTT
            </span>

            <h3 class="mt-3 text-[21px] font-extrabold text-[#0F172A]">
              Pistrik
            </h3>

            <p class="mt-3 text-sm font-semibold leading-relaxed text-[#0F172A]">
              Pistrik on meie kiire, nutikas ja usaldusväärne sõber kes
              sümboliseerib vabadust, kiirust ja nutikat liikumist.
            </p>
          </div>
        </div>
      </section>

      <!-- STORY -->
      <section
        v-reveal
        class="mt-10 grid gap-10 lg:grid-cols-[1fr_1.15fr] lg:items-center"
      >
        <div
          class="flex min-h-[300px] items-center justify-center rounded-3xl bg-[#EDE4FF] p-10"
        >
          <img
            src="/images/brand/Velo-logo.svg"
            alt="Velo logo"
            class="w-full max-w-[400px]"
          />
        </div>

        <div>
          <h2 class="text-[34px] font-extrabold text-[#0F172A]">
            Kuidas kõik alguse sai?
          </h2>

          <p class="mt-5 text-[17px] font-semibold leading-relaxed text-[#0F172A]">
            Velo sündis soovist muuta linnaliikumine lihtsamaks, rohelisemaks ja
            paindlikumaks. Alustasime väikese visiooniga, kuid suure sooviga
            luua midagi, mis muudab inimeste igapäevaelu.
          </p>

          <p class="mt-5 text-[17px] font-semibold leading-relaxed text-[#0F172A]">
            Täna oleme uhked, et saame pakkuda laia valikut kvaliteetseid
            elektrisõidukeid ja jätkata teekonda nutikama linna suunas.
          </p>

          <div class="mt-7 grid gap-4 sm:grid-cols-3">
            <div
              v-for="stat in stats"
              :key="stat.label"
              class="rounded-2xl bg-white p-5 shadow-[0_14px_35px_rgba(15,23,42,0.10)]"
            >
              <p class="text-[24px] font-extrabold text-[#6D28D9]">
                {{ stat.value }}
              </p>

              <p class="mt-1 text-sm font-bold text-[#0F172A]">
                {{ stat.label }}
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- VALUES -->
      <section v-reveal class="mt-12">
        <h2 class="text-[24px] font-extrabold text-[#0F172A]">
          Meie väärtused
        </h2>

        <div class="mt-5 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
          <article
            v-for="value in values"
            :key="value.title"
            class="flex gap-5 rounded-2xl bg-white p-6 shadow-[0_16px_40px_rgba(15,23,42,0.10)] transition hover:-translate-y-1"
          >
            <div
              class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-[#EDE4FF] text-[#6D28D9]"
            >
              <component :is="value.icon" :size="32" />
            </div>

            <div>
              <h3 class="font-extrabold text-[#0F172A]">
                {{ value.title }}
              </h3>

              <p class="mt-2 text-sm font-semibold leading-relaxed text-[#0F172A]">
                {{ value.text }}
              </p>
            </div>
          </article>
        </div>
      </section>

      <!-- CTA -->
      <section
        v-reveal
        class="mt-10 overflow-hidden rounded-3xl bg-[#6D28D9] bg-[url('/images/about/about-cta.webp')] bg-cover bg-center px-8 py-8 text-white shadow-[0_20px_60px_rgba(109,40,217,0.25)] lg:px-10"
      >
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
          <div>
            <h2 class="text-[26px] font-extrabold">
              Valmis Liikuma?
            </h2>

            <p class="mt-3 max-w-[520px] text-white/85">
              Tutvu meie sõidukitega ja leia endale sobiv lahendus juba täna.
            </p>
          </div>

          <RouterLink
            to="/vehicles"
            class="inline-flex h-[48px] items-center justify-center gap-3 rounded-xl bg-white px-7 text-sm font-extrabold text-[#6D28D9] transition hover:scale-105"
          >
            Vaata sõidukeid
            <ArrowRight :size="18" />
          </RouterLink>
        </div>
      </section>
    </div>
  </main>
</template>