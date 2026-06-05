<script setup>
import { RouterLink } from "vue-router";
import { Zap, Leaf, Shield, User, Bike } from "lucide-vue-next";
</script>

<template>
  <section
    class="mx-auto max-w-[1280px] overflow-x-hidden px-5 pt-12 pb-16 sm:px-6 sm:pt-16 lg:pt-20 lg:pb-24"
  >
    <div class="grid items-center gap-12 lg:grid-cols-[560px_1fr] lg:gap-12">
      <!-- LEFT -->
      <div>
        <h1
          class="max-w-[560px] text-[44px] font-extrabold leading-[1.08] tracking-[-0.04em] text-[#0F172A] sm:text-[56px] lg:text-[64px]"
        >
          Liigu linnas
          <br />
          kiiremini
          <span class="text-[#6D28D9]">velo'ga</span>
        </h1>

        <p
          class="mt-6 max-w-[540px] text-[16px] leading-[1.55] text-slate-500 sm:text-[18px] lg:text-[17px]"
        >
          Jätkusuutlik, kiire ja mugav viis linnaruumi navigeerimiseks. Lae alla
          äpp või rendi veebis ja alusta sõitu juba täna.
        </p>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
          <RouterLink
            to="/booking"
            class="rounded-xl bg-[#6D28D9] px-7 py-3.5 text-center text-[15px] font-bold text-white shadow-md transition hover:bg-[#5B21B6]"
          >
            Rendi nüüd
          </RouterLink>

          <RouterLink
            to="/vehicles"
            class="rounded-xl border border-[#6D28D9] px-7 py-3.5 text-center text-[15px] font-bold text-[#6D28D9] transition hover:bg-violet-50"
          >
            Vaata sõidukeid
          </RouterLink>
        </div>

        <!-- FEATURES DESKTOP -->
        <div class="mt-14 hidden items-center gap-8 lg:flex">
          <div class="flex w-[190px] items-center gap-3">
            <div
              class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#DDD0FF] text-[#6D28D9]"
            >
              <Zap :size="22" />
            </div>
            <div>
              <h3
                class="whitespace-nowrap text-[14px] font-extrabold text-[#0F172A]"
              >
                Kiire ja Lihtne
              </h3>
              <p class="whitespace-nowrap text-[12px] text-slate-500">
                Broneeri minutitega
              </p>
            </div>
          </div>

          <div class="flex w-[210px] items-center gap-3">
            <div
              class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#DDD0FF] text-[#6D28D9]"
            >
              <Leaf :size="22" />
            </div>
            <div>
              <h3
                class="whitespace-nowrap text-[14px] font-extrabold text-[#0F172A]"
              >
                Keskkonnasõbralik
              </h3>
              <p class="whitespace-nowrap text-[12px] text-slate-500">
                Roheline liikumine
              </p>
            </div>
          </div>

          <div class="flex w-[170px] items-center gap-3">
            <div
              class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#DDD0FF] text-[#6D28D9]"
            >
              <Shield :size="22" />
            </div>
            <div>
              <h3
                class="whitespace-nowrap text-[14px] font-extrabold text-[#0F172A]"
              >
                Turvaline
              </h3>
              <p class="whitespace-nowrap text-[12px] text-slate-500">
                Usaldusväärne alati
              </p>
            </div>
          </div>
        </div>

        <!-- FEATURES MOBILE/TABLET -->
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:hidden">
          <div class="flex items-center gap-4">
            <div
              class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-[#DDD0FF] text-[#6D28D9]"
            >
              <Zap :size="30" />
            </div>
            <div>
              <h3 class="text-[17px] font-extrabold text-[#0F172A]">
                Kiire ja Lihtne
              </h3>
              <p class="text-[15px] text-slate-500">Broneeri minutitega</p>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <div
              class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-[#DDD0FF] text-[#6D28D9]"
            >
              <Leaf :size="30" />
            </div>
            <div>
              <h3 class="text-[17px] font-extrabold text-[#0F172A]">
                Keskkonnasõbralik
              </h3>
              <p class="text-[15px] text-slate-500">Roheline liikumine</p>
            </div>
          </div>

          <div class="flex items-center gap-4 sm:col-span-2">
            <div
              class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-[#DDD0FF] text-[#6D28D9]"
            >
              <Shield :size="30" />
            </div>
            <div>
              <h3 class="text-[17px] font-extrabold text-[#0F172A]">
                Turvaline
              </h3>
              <p class="text-[15px] text-slate-500">Usaldusväärne alati</p>
            </div>
          </div>
        </div>
      </div>

      <!-- RIGHT DESKTOP -->
      <div class="relative hidden h-[520px] lg:block">
        <img
          src="/images/home/hero-scooter.webp"
          alt="Velo elektritõukeratas linnas"
          class="absolute right-0 top-0 h-[500px] w-[560px] rounded-2xl object-cover object-[85%_center] shadow-xl"
        />

        <div
          class="absolute left-[20px] top-[65px] rounded-2xl bg-white px-6 py-4 shadow-xl"
        >
          <div class="flex items-center gap-3">
            <Zap class="text-[#6D28D9]" :size="32" />
            <div>
              <div class="text-[16px] font-extrabold text-[#0F172A]">50 km</div>
              <p class="text-[12px] text-slate-500">Max sõidukaugus</p>
            </div>
          </div>
        </div>

        <div
          class="absolute left-[70px] top-[295px] rounded-2xl bg-white px-6 py-4 shadow-xl"
        >
          <div class="flex items-center gap-3">
            <User class="text-[#6D28D9]" :size="28" />
            <div>
              <div class="text-[16px] font-extrabold text-[#0F172A]">
                12 000
              </div>
              <p class="text-[12px] text-slate-500">Rahulolevat kasutajat</p>
            </div>
          </div>
        </div>

        <div
          class="absolute right-[40px] top-[295px] rounded-2xl bg-white px-6 py-4 shadow-xl"
        >
          <div class="flex items-center gap-3">
            <Bike class="text-[#6D28D9]" :size="28" />
            <div>
              <div class="text-[16px] font-extrabold text-[#0F172A]">350+</div>
              <p class="text-[12px] text-slate-500">Sõidukit</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
