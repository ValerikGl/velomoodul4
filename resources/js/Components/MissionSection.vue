<script setup>
import { Leaf, Zap, Shield } from 'lucide-vue-next'
</script>

<template>
  <section id="mission" class="relative overflow-hidden bg-[#F8FAFC] py-24">
    <img
  src="/images/home/mission-bg.svg"
  alt=""
  class="absolute inset-0 mt-20 mx-auto w-[1400px] opacity-20 pointer-events-none"
/>

    <div class="relative mx-auto max-w-[1280px] px-6">
      <div class="text-center">
        <h2 class="text-[42px] font-extrabold leading-none text-[#0F172A] sm:text-[56px]">
          Meie <span class="text-[#6D28D9]">Missioon</span>
        </h2>

        <div class="mx-auto mt-8 h-[5px] w-[150px] rounded-full bg-[#6D28D9]"></div>

        <p class="mx-auto mt-8 max-w-[760px] text-[16px] font-semibold leading-relaxed text-[#0F172A]">
          Oleme pühendunud keskkonnasõbraliku ja kättesaadava linnaliikluse loomisele.
          Velo eesmärk on muuta igapäevane liikumine kiiremaks, mugavamaks ja jätkusuutlikumaks,
          pakkudes kaasaegseid elektritõukerataste lahendusi kõigile linnakodanikele.
        </p>
      </div>

      <div class="mt-16 grid gap-8 lg:grid-cols-3">
        <article class="mission-card">
          <Leaf class="mx-auto text-green-600" :size="88" />
          <h3 class="mt-10 text-[30px] font-extrabold text-[#0F172A]">Keskkonnasõbralik</h3>
          <div class="mx-auto my-8 h-[5px] w-[140px] rounded-full bg-[#6D28D9]"></div>
          <p class="mx-auto max-w-[320px] text-[18px] font-semibold leading-relaxed text-[#0F172A]">
            Elektrilised sõidukid aitavad muuta linna puhtamaks ja rohelisemaks.
          </p>
        </article>

        <article class="mission-card">
          <Zap class="mx-auto text-[#6D28D9]" :size="88" />
          <h3 class="mt-10 text-[30px] font-extrabold text-[#0F172A]">Kiire ja mugav</h3>
          <div class="mx-auto my-8 h-[5px] w-[140px] rounded-full bg-[#6D28D9]"></div>
          <p class="mx-auto max-w-[320px] text-[18px] font-semibold leading-relaxed text-[#0F172A]">
            Väldi ummikuid ja jõua sihtkohta mugavalt.
          </p>
        </article>

        <article class="mission-card">
          <Shield class="mx-auto text-indigo-500" :size="88" />
          <h3 class="mt-10 text-[30px] font-extrabold text-[#0F172A]">Turvaline kasutus</h3>
          <div class="mx-auto my-8 h-[5px] w-[140px] rounded-full bg-[#6D28D9]"></div>
          <p class="mx-auto max-w-[320px] text-[18px] font-semibold leading-relaxed text-[#0F172A]">
            Kõik tõukerattad läbivad regulaarse kontrolli.
          </p>
        </article>
      </div>
    </div>
  </section>
</template>

<style scoped>
.mission-card {
  min-height: 420px;
  border-radius: 24px;
  background: white;
  padding: 64px 40px;
  text-align: center;
  box-shadow: 0 24px 70px rgba(15, 23, 42, 0.12);
}
</style>