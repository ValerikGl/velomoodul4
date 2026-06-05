<script setup>
import { ref, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { Menu, X } from "lucide-vue-next";

const isMenuOpen = ref(false);

const page = usePage();

const currentPath = computed(() => page.url);

const isActive = (path) => {
  if (path === "/") {
    return currentPath.value === "/";
  }

  return currentPath.value.startsWith(path);
};

const closeMenu = () => {
  isMenuOpen.value = false;
};
</script>

<template>
  <header
    class="sticky top-0 z-50 border-b border-slate-100 bg-[#F8FAFC]/95 backdrop-blur"
  >
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
      <!-- LOGO -->
      <Link href="/" class="flex items-center" @click="closeMenu">
        <img
          :src="'/images/brand/velo-logo.svg'"
          alt="Velo logo"
          class="h-8 w-auto"
        />
      </Link>

      <!-- DESKTOP NAV -->
      <nav
        class="hidden items-center gap-8 text-[16px] font-semibold text-[#0F172A] lg:flex"
      >
        <Link
          href="/"
          :class="['nav-link', { active: isActive('/') }]"
        >
          Avaleht
        </Link>

        <Link
          href="/vehicles"
          :class="['nav-link', { active: isActive('/vehicles') }]"
        >
          Sõidukid
        </Link>

        <Link
          href="/mission"
          :class="['nav-link', { active: isActive('/mission') }]"
        >
          Meist
        </Link>

        <Link
          href="/news"
          :class="['nav-link', { active: isActive('/news') }]"
        >
          Uudised
        </Link>

        <Link
          href="/offers"
          :class="['nav-link', { active: isActive('/offers') }]"
        >
          Kampaaniad
        </Link>

        <Link
          href="/contact"
          :class="['nav-link', { active: isActive('/contact') }]"
        >
          Kontakt
        </Link>
      </nav>

      <!-- CTA -->
      <Link
        href="/vehicles"
        class="hidden rounded-xl bg-[#6D28D9] px-6 py-3 text-[16px] font-bold text-white shadow-lg transition-all duration-300 hover:scale-105 hover:bg-[#5B21B6] lg:block"
      >
        Rendi kohe
      </Link>

      <!-- MOBILE BUTTON -->
      <button
        type="button"
        class="flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-white text-[#0F172A] shadow-sm lg:hidden"
        @click="isMenuOpen = !isMenuOpen"
      >
        <X v-if="isMenuOpen" :size="24" />
        <Menu v-else :size="24" />
      </button>
    </div>

    <!-- MOBILE MENU -->
    <Transition name="mobile-menu">
      <div
        v-if="isMenuOpen"
        class="absolute left-0 top-full z-50 w-full border-t border-slate-200 bg-[#F8FAFC] px-6 pb-6 pt-4 shadow-xl lg:hidden"
      >
        <nav class="flex flex-col gap-2">
          <Link
            href="/"
            class="mobile-link"
            :class="{ active: isActive('/') }"
            @click="closeMenu"
          >
            Avaleht
          </Link>

          <Link
            href="/vehicles"
            class="mobile-link"
            :class="{ active: isActive('/vehicles') }"
            @click="closeMenu"
          >
            Sõidukid
          </Link>

          <Link
            href="/mission"
            class="mobile-link"
            :class="{ active: isActive('/mission') }"
            @click="closeMenu"
          >
            Meist
          </Link>

          <Link
            href="/news"
            class="mobile-link"
            :class="{ active: isActive('/news') }"
            @click="closeMenu"
          >
            Uudised
          </Link>

          <Link
            href="/offers"
            class="mobile-link"
            :class="{ active: isActive('/offers') }"
            @click="closeMenu"
          >
            Kampaaniad
          </Link>

          <Link
            href="/contact"
            class="mobile-link"
            :class="{ active: isActive('/contact') }"
            @click="closeMenu"
          >
            Kontakt
          </Link>

          <Link
            href="/vehicles"
            class="mt-3 rounded-xl bg-[#6D28D9] px-6 py-3 text-center font-bold text-white shadow-md"
            @click="closeMenu"
          >
            Rendi kohe
          </Link>
        </nav>
      </div>
    </Transition>
  </header>
</template>

<style scoped>
.nav-link {
  position: relative;
  padding-bottom: 6px;
  transition:
    color 0.2s ease,
    transform 0.2s ease;
}

.nav-link:hover,
.nav-link.active {
  color: #6d28d9;
}

.nav-link:hover::after,
.nav-link.active::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 2px;
  background: #6d28d9;
  border-radius: 999px;
}

.mobile-link {
  border-radius: 12px;
  padding: 12px 14px;
  font-weight: 600;
  transition:
    background 0.2s ease,
    color 0.2s ease;
}

.mobile-link:hover,
.mobile-link.active {
  background: #ede9fe;
  color: #6d28d9;
}

.mobile-menu-enter-active,
.mobile-menu-leave-active {
  transition: all 0.25s ease;
  transform-origin: top;
}

.mobile-menu-enter-from,
.mobile-menu-leave-to {
  opacity: 0;
  transform: translateY(-12px) scaleY(0.96);
}

.mobile-menu-enter-to,
.mobile-menu-leave-from {
  opacity: 1;
  transform: translateY(0) scaleY(1);
}
</style>