<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { ArrowLeft, Calendar, Clock, Tag } from "lucide-vue-next";
import MainLayout from "../Layouts/MainLayout.vue";

defineOptions({
  layout: MainLayout,
});

const props = defineProps({
  post: {
    type: Object,
    required: true,
  },
});

const imageUrl = (path) => {
  if (!path) return "/images/blog/blog-main.webp";
  if (path.startsWith("http")) return path;
  if (path.startsWith("/")) return path;
  return `/storage/${path}`;
};

const formattedDate = computed(() => {
  if (!props.post.published_at) return "";
  return new Date(props.post.published_at).toLocaleDateString("et-EE");
});

const readTime = computed(() => {
  if (!props.post.content) return 1;

  const words = props.post.content.trim().split(/\s+/).length;
  return Math.max(1, Math.ceil(words / 200));
});
</script>

<template>
  <main class="bg-[#F8FAFC] px-5 py-12 sm:px-6 lg:py-16">
    <article class="mx-auto max-w-[980px]">
      <Link
        href="/news"
        class="inline-flex items-center gap-2 font-extrabold text-[#6D28D9] transition hover:gap-3"
      >
        <ArrowLeft :size="18" />
        Tagasi uudiste juurde
      </Link>

      <div
        class="mt-8 overflow-hidden rounded-3xl bg-white shadow-[0_20px_60px_rgba(15,23,42,0.10)]"
      >
        <img
          :src="imageUrl(post.image)"
          :alt="post.title"
          class="h-[320px] w-full object-cover sm:h-[420px]"
        />

        <div class="p-7 sm:p-10 lg:p-12">
          <div class="flex flex-wrap gap-4 text-sm font-extrabold text-[#6D28D9]">
            <span class="flex items-center gap-2">
              <Calendar :size="17" />
              {{ formattedDate }}
            </span>

            <span class="flex items-center gap-2">
              <Clock :size="17" />
              {{ readTime }} min
            </span>

            <span
              v-if="post.tag"
              class="flex items-center gap-2"
            >
              <Tag :size="17" />
              {{ post.tag }}
            </span>
          </div>

          <h1
            class="mt-6 text-[38px] font-extrabold leading-tight text-[#0F172A] sm:text-[56px]"
          >
            {{ post.title }}
          </h1>

          <p
            class="mt-5 text-[20px] font-semibold leading-relaxed text-slate-600"
          >
            {{ post.excerpt }}
          </p>

          <div
            class="prose-custom mt-10 whitespace-pre-line text-[17px] font-medium leading-[1.9] text-[#0F172A]"
          >
            {{ post.content }}
          </div>
        </div>
      </div>

      
    </article>
  </main>
</template>