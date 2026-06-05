<script setup>
import { ArrowRight } from 'lucide-vue-next'

const smallPosts = [
  {
    date: '05.06.2026',
    title: 'Suvekampaania algab varsti',
    desc: 'Juuni lõpus algab meie suur suvekampaania. Rohkem sõite, rohkem vabadust!',
    img: '/images/blog/blog-1.webp',
  },
  {
    date: '28.05.2026',
    title: 'Rakenduse uus versioon',
    desc: 'Uus disain, paremad funktsioonid ja veel mugavam kasutajakogemus.',
    img: '/images/blog/blog-2.webp',
  },
  {
    date: '05.06.2026',
    title: '5 nippi turvaliseks sõiduks',
    desc: 'Väikesed soovitused, mis muudavad sinu sõidud veel turvalisemaks.',
    img: '/images/blog/blog-3.webp',
  },
  {
    date: '05.03.2026',
    title: 'Uued parkimisalad Tallinnas',
    desc: 'Lisanduvad 15 uut parkimisala, et muuta sõitmine veel mugavamaks.',
    img: '/images/blog/blog-4.webp',
  },
]
</script>

<template>
  <section id="news" class="bg-[#F8FAFC] py-20 lg:py-24">
    <div class="mx-auto max-w-[1280px] px-5 sm:px-6">
      <div class="flex items-start justify-between gap-6">
        <div>
          <h2 class="text-[38px] font-extrabold leading-tight text-[#0F172A] sm:text-[56px]">
            Blogi & Uudised
          </h2>

          <p class="mt-5 text-[18px] font-semibold text-[#0F172A] sm:text-[22px]">
            Hoia end kursis Velo uusimate uudiste, sündmustega.
          </p>
        </div>

        <RouterLink
          to="/news"
          class="hidden items-center gap-3 rounded-xl border border-[#6D28D9] px-6 py-3 font-bold text-[#6D28D9] transition hover:bg-[#F3E8FF] lg:flex"
        >
          Kõik Uudised
          <ArrowRight :size="20" />
        </RouterLink>
      </div>

      <article class="mt-14 grid overflow-hidden rounded-3xl bg-white shadow-[0_20px_60px_rgba(15,23,42,0.14)] lg:grid-cols-2">
        <img
          src="/images/blog/blog-main.webp"
          alt="Velo ride"
          class="h-[280px] w-full object-cover lg:h-[420px]"
        />

        <div class="flex flex-col justify-center p-7 lg:p-12">
          <p class="font-bold text-[#6D28D9]">01.06.2026</p>

          <h3 class="mt-6 text-[28px] font-extrabold leading-tight text-[#0F172A] lg:text-[36px]">
            Uus Velo ride nüüd saadaval!
          </h3>

          <p class="mt-6 max-w-[560px] text-[17px] font-semibold leading-relaxed text-[#0F172A]">
            Tutvustame meie uusimat elektrimopeedi mudelit, mis pakub kuni 80 km sõiduulatust
            ja täiustatud turvatehnoloogiat. Naudi mugavamat ja kiiremat sõiduelamust linnas.
          </p>

          <RouterLink
            to="/news"
            class="mt-8 inline-flex w-fit items-center gap-3 rounded-lg bg-[#6D28D9] px-7 py-4 font-bold text-white transition hover:bg-[#5B21B6]"
          >
            Loe Rohkem
            <ArrowRight :size="20" />
          </RouterLink>
        </div>
      </article>

      <div class="mt-8 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
        <article
          v-for="post in smallPosts"
          :key="post.title"
          class="overflow-hidden rounded-2xl bg-white shadow-[0_18px_45px_rgba(15,23,42,0.14)] transition duration-300 hover:-translate-y-2"
        >
          <img
            :src="post.img"
            :alt="post.title"
            class="h-[190px] w-full object-cover"
          />

          <div class="p-6">
            <p class="text-[14px] font-bold text-[#6D28D9]">
              {{ post.date }}
            </p>

            <h3 class="mt-3 text-[20px] font-extrabold leading-tight text-[#0F172A]">
              {{ post.title }}
            </h3>

            <p class="mt-3 min-h-[72px] text-[15px] leading-relaxed text-slate-600">
              {{ post.desc }}
            </p>

            <RouterLink
              to="/news"
              class="mt-6 inline-flex items-center gap-2 font-bold text-[#6D28D9]"
            >
              Loe rohkem
              <ArrowRight :size="18" />
            </RouterLink>
          </div>
        </article>
      </div>
    </div>
  </section>
</template>