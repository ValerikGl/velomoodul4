<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { ArrowRight } from "lucide-vue-next";

const props = defineProps({
  posts: {
    type: Array,
    default: () => [],
  },
});

const imageUrl = (path) => {
  if (!path) return "/images/blog/blog-main.webp";
  if (path.startsWith("/")) return path;
  return `/storage/${path}`;
};

const formatDate = (date) => {
  if (!date) return "";
  return new Date(date).toLocaleDateString("et-EE");
};

const featuredPost = computed(() => props.posts[0] || null);
const smallPosts = computed(() => props.posts.slice(1, 5));

const readTime = (content) => {
  if (!content) return 1;

  const words = content.trim().split(/\s+/).length;

  return Math.max(1, Math.ceil(words / 200));
};
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

        <Link
          href="/news"
          class="hidden items-center gap-3 rounded-xl border border-[#6D28D9] px-6 py-3 font-bold text-[#6D28D9] transition hover:bg-[#F3E8FF] lg:flex"
        >
          Kõik Uudised
          <ArrowRight :size="20" />
        </Link>
      </div>

      <article
        v-if="featuredPost"
        class="mt-14 grid overflow-hidden rounded-3xl bg-white shadow-[0_20px_60px_rgba(15,23,42,0.14)] lg:grid-cols-2"
      >
        <img
          :src="imageUrl(featuredPost.image)"
          :alt="featuredPost.title"
          class="h-[280px] w-full object-cover lg:h-[420px]"
        />

        <div class="flex flex-col justify-center p-7 lg:p-12">
          <p class="font-bold text-[#6D28D9]">
            {{ formatDate(featuredPost.published_at) }}
          </p>

          <h3 class="mt-6 text-[28px] font-extrabold leading-tight text-[#0F172A] lg:text-[36px]">
            {{ featuredPost.title }}
          </h3>

          <p class="mt-6 max-w-[560px] text-[17px] font-semibold leading-relaxed text-[#0F172A]">
            {{ featuredPost.excerpt }}
          </p>

          <Link
            :href="`/news/${featuredPost.slug}`"
            class="mt-8 inline-flex w-fit items-center gap-3 rounded-lg bg-[#6D28D9] px-7 py-4 font-bold text-white transition hover:bg-[#5B21B6]"
          >
            Loe Rohkem
            <ArrowRight :size="20" />
          </Link>
        </div>
      </article>

      <div
        v-else
        class="mt-14 rounded-3xl bg-white p-8 text-center font-extrabold text-[#0F172A] shadow-[0_20px_60px_rgba(15,23,42,0.14)]"
      >
        Uudiseid pole veel lisatud.
      </div>

      <div
        v-if="smallPosts.length"
        class="mt-8 grid gap-8 sm:grid-cols-2 lg:grid-cols-4"
      >
        <article
          v-for="post in smallPosts"
          :key="post.id"
          class="overflow-hidden rounded-2xl bg-white shadow-[0_18px_45px_rgba(15,23,42,0.14)] transition duration-300 hover:-translate-y-2"
        >
          <img
            :src="imageUrl(post.image)"
            :alt="post.title"
            class="h-[190px] w-full object-cover"
          />

          <div class="p-6">
            <p class="text-[14px] font-bold text-[#6D28D9]">
              {{ formatDate(post.published_at) }}
            </p>

            <h3 class="mt-3 text-[20px] font-extrabold leading-tight text-[#0F172A]">
              {{ post.title }}
            </h3>

            <p class="mt-3 min-h-[72px] text-[15px] leading-relaxed text-slate-600">
              {{ post.excerpt }}
            </p>

            <Link
              :href="`/news/${post.slug}`"
              class="mt-6 inline-flex items-center gap-2 font-bold text-[#6D28D9]"
            >
              Loe rohkem
              <ArrowRight :size="18" />
            </Link>
          </div>
        </article>
      </div>
    </div>
  </section>
</template>