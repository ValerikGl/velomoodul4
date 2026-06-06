<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { ArrowRight, Calendar, Clock } from "lucide-vue-next";
import MainLayout from "../Layouts/MainLayout.vue";

defineOptions({
  layout: MainLayout,
});

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
const regularPosts = computed(() => props.posts.slice(1));

const readTime = (content) => {
  if (!content) return 1;

  const words = content.trim().split(/\s+/).length;

  return Math.max(1, Math.ceil(words / 200));
};
</script>

<template>
  <main class="bg-[#F8FAFC] px-5 py-12 sm:px-6 lg:py-16">
    <div class="mx-auto max-w-[1280px]">
      <section v-reveal class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div>
          <h1 class="mt-5 text-[44px] font-extrabold leading-tight text-[#0F172A] sm:text-[58px]">
            Blogi & Uudised
          </h1>

          <p class="mt-4 max-w-[620px] text-[18px] font-semibold leading-relaxed text-[#0F172A]">
            Hoia end kursis Velo uusimate uudiste, kampaaniate ja kasulike
            linnaliikluse soovitustega.
          </p>
        </div>
      </section>

      <section
        v-if="featuredPost"
        v-reveal
        class="mt-12 overflow-hidden rounded-3xl bg-white shadow-[0_20px_60px_rgba(15,23,42,0.10)]"
      >
        <div class="grid lg:grid-cols-[1.05fr_0.95fr]">
          <img
            :src="imageUrl(featuredPost.image)"
            :alt="featuredPost.title"
            class="h-[300px] w-full object-cover lg:h-full"
          />

          <div class="flex flex-col justify-center p-7 lg:p-12">
            <div class="flex flex-wrap gap-4 text-sm font-extrabold text-[#6D28D9]">
              <span class="flex items-center gap-2">
                <Calendar :size="17" />
                {{ formatDate(featuredPost.published_at) }}
              </span>

              <span class="flex items-center gap-2">
                <Clock :size="17" />
                {{ readTime(featuredPost.content) }} min
              </span>
            </div>

            <h2 class="mt-6 text-[30px] font-extrabold leading-tight text-[#0F172A] lg:text-[40px]">
              {{ featuredPost.title }}
            </h2>

            <p class="mt-4 text-[17px] font-semibold leading-relaxed text-[#0F172A]">
              {{ featuredPost.excerpt }}
            </p>

            <Link
              :href="`/news/${featuredPost.slug}`"
              class="mt-8 inline-flex h-[48px] w-fit items-center justify-center gap-3 rounded-xl bg-[#6D28D9] px-7 font-bold text-white shadow-lg transition hover:bg-[#5B21B6]"
            >
              Loe rohkem
              <ArrowRight :size="18" />
            </Link>
          </div>
        </div>
      </section>

      <section v-else class="mt-12 rounded-3xl bg-white p-10 text-center shadow-[0_20px_60px_rgba(15,23,42,0.10)]">
        <p class="font-extrabold text-[#0F172A]">
          Uudiseid pole veel lisatud.
        </p>
      </section>

      <section v-if="regularPosts.length" id="posts" v-reveal class="mt-12">
        <div class="mb-6 flex items-center justify-between">
          <h2 class="text-[32px] font-extrabold text-[#0F172A]">
            Viimased uudised
          </h2>
        </div>

        <div class="grid gap-7 md:grid-cols-2 xl:grid-cols-3">
          <article
            v-for="post in regularPosts"
            :key="post.id"
            class="overflow-hidden rounded-3xl bg-white shadow-[0_18px_45px_rgba(15,23,42,0.10)] transition duration-300 hover:-translate-y-2 hover:shadow-[0_25px_65px_rgba(15,23,42,0.14)]"
          >
            <img
              :src="imageUrl(post.image)"
              :alt="post.title"
              class="h-[210px] w-full object-cover"
            />

            <div class="p-6">
              <div class="flex items-center justify-between gap-4">
                <span class="rounded-full bg-[#EDE4FF] px-4 py-1.5 text-xs font-extrabold text-[#6D28D9]">
                  {{ post.tag || "Uudised" }}
                </span>

                <span class="text-xs font-bold text-slate-500">
                  {{ readTime(post.content) }} min
                </span>
              </div>

              <p class="mt-5 text-sm font-extrabold text-[#6D28D9]">
                {{ formatDate(post.published_at) }}
              </p>

              <h3 class="mt-3 text-[22px] font-extrabold leading-tight text-[#0F172A]">
                {{ post.title }}
              </h3>

              <p class="mt-3 min-h-[72px] text-sm font-semibold leading-relaxed text-slate-600">
                {{ post.excerpt }}
              </p>

              <Link
                :href="`/news/${post.slug}`"
                class="mt-6 inline-flex items-center gap-2 font-extrabold text-[#6D28D9] transition hover:gap-3"
              >
                Loe rohkem
                <ArrowRight :size="18" />
              </Link>
            </div>
          </article>
        </div>
      </section>

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

          <Link
            href="/vehicles"
            class="inline-flex h-[54px] items-center justify-center rounded-xl bg-white px-8 font-extrabold text-[#6D28D9] transition hover:scale-105"
          >
            Vaata sõidukeid
          </Link>
        </div>
      </section>
    </div>
  </main>
</template>