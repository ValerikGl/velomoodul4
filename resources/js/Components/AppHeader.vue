<script setup>
import { ref } from "vue";
import { Menu, X } from "lucide-vue-next";

const isMenuOpen = ref(false);

const closeMenu = () => {
  isMenuOpen.value = false;
};
</script>

<template>
  <header class="sticky top-0 z-50 bg-[#F8FAFC]/95 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
      <RouterLink to="/" class="flex items-center" @click="closeMenu">
        <img src="/images/brand/Velo-logo.svg" alt="Velo logo" class="h-8 w-auto" />
      </RouterLink>

      <!-- DESKTOP NAV -->
      <nav
        class="hidden items-center gap-8 text-[16px] font-semibold text-[#0F172A] lg:flex"
      >
        <RouterLink to="/" class="nav-link">Avaleht</RouterLink>
        <RouterLink to="/vehicles" class="nav-link">Sõidukid</RouterLink>
        <RouterLink to="/mission" class="nav-link">Meist</RouterLink>
        <RouterLink to="/news" class="nav-link">Uudised</RouterLink>
        <RouterLink to="/offers" class="nav-link">Kampaaniad</RouterLink>
        <RouterLink to="/contact" class="nav-link">Kontakt</RouterLink>
      </nav>

      <RouterLink
        to="/booking"
        class="hidden rounded-xl bg-[#6D28D9] px-6 py-3 text-[16px] font-bold text-white shadow-lg transition hover:bg-[#5B21B6] lg:block"
      >
        Rendi kohe
      </RouterLink>

      <!-- MOBILE BURGER -->
      <button
        type="button"
        class="flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-white text-[#0F172A] shadow-sm lg:hidden"
        aria-label="Ava menüü"
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
        class="absolute left-0 top-full z-50 w-full border-t border-slate-200 bg-[#F8FAFC] px-6 pb-6 pt-3 shadow-xl lg:hidden"
      >
        <nav
          class="flex flex-col gap-3 text-[16px] font-semibold text-[#0F172A]"
        >
          <RouterLink to="/" class="mobile-link" @click="closeMenu"
            >Avaleht</RouterLink
          >
          <RouterLink to="/vehicles" class="mobile-link" @click="closeMenu"
            >Sõidukid</RouterLink
          >
          <RouterLink to="/about" class="mobile-link" @click="closeMenu">
            Meist
          </RouterLink>
          <RouterLink to="/news" class="mobile-link" @click="closeMenu">
            Uudised
          </RouterLink>
          <RouterLink to="/offers" class="mobile-link" @click="closeMenu">
            Kampaaniad
          </RouterLink>
          
          <RouterLink to="/contact" class="mobile-link" @click="closeMenu"
            >Kontakt</RouterLink
          >

          <RouterLink
            to="/booking"
            class="mt-2 rounded-xl bg-[#6D28D9] px-6 py-3 text-center font-bold text-white shadow-md"
            @click="closeMenu"
          >
            Rendi kohe
          </RouterLink>
        </nav>
      </div>
    </Transition>
  </header>
</template>

<style scoped>
.nav-link {
  position: relative;
  padding-bottom: 6px;
  transition: color 0.2s ease;
}

.nav-link.router-link-active,
.nav-link:hover {
  color: #6d28d9;
}

.nav-link.router-link-active::after,
.nav-link:hover::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 2px;
  width: 100%;
  background: #6d28d9;
  border-radius: 999px;
}

.mobile-link {
  border-radius: 12px;
  padding: 12px 14px;
  transition:
    background 0.2s ease,
    color 0.2s ease;
}

.mobile-link.router-link-active,
.mobile-link:hover {
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
