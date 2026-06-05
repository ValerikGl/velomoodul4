<script setup>
import { ArrowRight, Calendar, Clock } from "lucide-vue-next";

const featuredPost = {
  date: "05.06.2026",
  readTime: "4 min",
  title: "Uus Velo ride nüüd saadaval!",
  text: "Tutvustame meie uusimat elektrimopeedi mudelit, mis pakub kuni 80 km sõiduulatust ja täiustatud turvatehnoloogiat.",
  image: "/images/blog/blog-1.webp",
};

const posts = [
  {
    date: "05.06.2026",
    readTime: "3 min",
    title: "Suvekampaania algab varsti",
    text: "Juuni lõpus algab meie suur suvekampaania. Rohkem sõite, rohkem vabadust!",
    image: "/images/blog/blog-2.webp",
    tag: "Kampaania",
  },
  {
    date: "28.05.2026",
    readTime: "5 min",
    title: "Rakenduse uus versioon",
    text: "Uus disain, paremad funktsioonid ja veel mugavam kasutajakogemus.",
    image: "/images/blog/blog-3.webp",
    tag: "Rakendus",
  },
  {
    date: "18.05.2026",
    readTime: "4 min",
    title: "5 nippi turvaliseks sõiduks",
    text: "Väikesed soovitused, mis muudavad sinu sõidud veel turvalisemaks.",
    image: "/images/blog/blog-4.webp",
    tag: "Ohutus",
  },
  {
    date: "12.05.2026",
    readTime: "3 min",
    title: "Uued parkimisalad Tallinnas",
    text: "Lisanduvad 15 uut parkimisala, et muuta sõitmine veel mugavamaks.",
    image: "/images/blog/blog-5.webp",
    tag: "Uudised",
  },
  {
    date: "02.05.2026",
    readTime: "6 min",
    title: "Miks valida elektrisõiduk?",
    text: "Elektriline linnaliiklus on kiire, säästlik ja keskkonnasõbralikum.",
    image: "/images/blog/blog-6.webp",
    tag: "Linnaliiklus",
  },
  {
    date: "25.04.2026",
    readTime: "4 min",
    title: "Velo laieneb uutesse linnaosadesse",
    text: "Toome Velo sõidukid veel rohkemate kasutajateni üle Tallinna.",
    image: "/images/blog/blog-7.webp",
    tag: "Velo",
  },
];
</script>

<template>
  <main class="bg-[#F8FAFC] px-5 py-12 sm:px-6 lg:py-16">
    <div class="mx-auto max-w-[1280px]">
      <!-- Hero -->
      <section
        v-reveal
        class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between"
      >
        <div>
          <h1
            class="mt-5 text-[44px] font-extrabold leading-tight text-[#0F172A] sm:text-[58px]"
          >
            Blogi & Uudised
          </h1>

          <p
            class="mt-4 max-w-[620px] text-[18px] font-semibold leading-relaxed text-[#0F172A]"
          >
            Hoia end kursis Velo uusimate uudiste, kampaaniate ja kasulike
            linnaliikluse soovitustega.
          </p>
        </div>

        
      </section>

      <!-- Featured -->
      <section
        v-reveal
        class="mt-12 overflow-hidden rounded-3xl bg-white shadow-[0_20px_60px_rgba(15,23,42,0.10)]"
      >
        <div class="grid lg:grid-cols-[1.05fr_0.95fr]">
          <img
            :src="featuredPost.image"
            :alt="featuredPost.title"
            class="h-[300px] w-full object-cover lg:h-full"
          />

          <div class="flex flex-col justify-center p-7 lg:p-12">
            <div
              class="flex flex-wrap gap-4 text-sm font-extrabold text-[#6D28D9]"
            >
              <span class="flex items-center gap-2">
                <Calendar :size="17" />
                {{ featuredPost.date }}
              </span>

              <span class="flex items-center gap-2">
                <Clock :size="17" />
                {{ featuredPost.readTime }}
              </span>
            </div>

            <h2
              class="mt-6 text-[30px] font-extrabold leading-tight text-[#0F172A] lg:text-[40px]"
            >
              {{ featuredPost.title }}
            </h2>

            <p
              class="mt-4 text-[17px] font-semibold leading-relaxed text-[#0F172A]"
            >
              {{ featuredPost.text }}
            </p>

            <a
              href="#"
              class="mt-8 inline-flex h-[48px] w-fit items-center justify-center gap-3 rounded-xl bg-[#6D28D9] px-7 font-bold text-white shadow-lg transition hover:bg-[#5B21B6]"
            >
              Loe rohkem
              <ArrowRight :size="18" />
            </a>
          </div>
        </div>
      </section>

      <!-- Posts -->
      <section id="posts" v-reveal class="mt-12">
        <div class="mb-6 flex items-center justify-between">
          <h2 class="text-[32px] font-extrabold text-[#0F172A]">
            Viimased uudised
          </h2>
        </div>

        <div class="grid gap-7 md:grid-cols-2 xl:grid-cols-3">
          <article
            v-for="post in posts"
            :key="post.title"
            class="overflow-hidden rounded-3xl bg-white shadow-[0_18px_45px_rgba(15,23,42,0.10)] transition duration-300 hover:-translate-y-2 hover:shadow-[0_25px_65px_rgba(15,23,42,0.14)]"
          >
            <img
              :src="post.image"
              :alt="post.title"
              class="h-[210px] w-full object-cover"
            />

            <div class="p-6">
              <div class="flex items-center justify-between gap-4">
                <span
                  class="rounded-full bg-[#EDE4FF] px-4 py-1.5 text-xs font-extrabold text-[#6D28D9]"
                >
                  {{ post.tag }}
                </span>

                <span class="text-xs font-bold text-slate-500">
                  {{ post.readTime }}
                </span>
              </div>

              <p class="mt-5 text-sm font-extrabold text-[#6D28D9]">
                {{ post.date }}
              </p>

              <h3
                class="mt-3 text-[22px] font-extrabold leading-tight text-[#0F172A]"
              >
                {{ post.title }}
              </h3>

              <p
                class="mt-3 min-h-[72px] text-sm font-semibold leading-relaxed text-slate-600"
              >
                {{ post.text }}
              </p>

              <a
                href="#"
                class="mt-6 inline-flex items-center gap-2 font-extrabold text-[#6D28D9] transition hover:gap-3"
              >
                Loe rohkem
                <ArrowRight :size="18" />
              </a>
            </div>
          </article>
        </div>
      </section>

      <!-- CTA -->
      <section
        v-reveal
        class="mt-14 rounded-3xl bg-[#6D28D9] px-7 py-10 text-white shadow-[0_24px_70px_rgba(109,40,217,0.25)] lg:px-12"
      >
        <div class="grid gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
          <div>
            <h2 class="text-[30px] font-extrabold lg:text-[38px]">
              Valmis linnas mugavamalt liikuma?
            </h2>

            <p class="mt-3 max-w-[620px] text-white/80">
              Broneeri sobiv Velo sõiduk ja alusta sõitu juba täna.
            </p>
          </div>

          <a
            href="/vehicles"
            class="inline-flex h-[54px] items-center justify-center rounded-xl bg-white px-8 font-extrabold text-[#6D28D9] transition hover:scale-105"
          >
            Vaata sõidukeid
          </a>
        </div>
      </section>
    </div>
  </main>
</template>
