<script setup>
import { ref, computed, watch } from "vue";
import { Link } from "@inertiajs/vue3";
import { ArrowLeft, ArrowRight } from "lucide-vue-next";

const props = defineProps({
    offers: {
        type: Array,
        default: () => [],
    },
});

console.log("OFFERS", props.offers);

const currentOffer = ref(0);

const imageUrl = (path) => {
    if (!path) return "";
    if (path.startsWith("http")) return path;
    if (path.startsWith("/")) return path;
    return `/storage/${path}`;
};

const activeOffers = computed(() => props.offers);

watch(
    activeOffers,
    (items) => {
        if (currentOffer.value >= items.length) {
            currentOffer.value = 0;
        }
    },
    { immediate: true },
);

const nextOffer = () => {
    if (!activeOffers.value.length) return;
    currentOffer.value = (currentOffer.value + 1) % activeOffers.value.length;
};

const prevOffer = () => {
    if (!activeOffers.value.length) return;
    currentOffer.value =
        currentOffer.value === 0
            ? activeOffers.value.length - 1
            : currentOffer.value - 1;
};

const touchStartX = ref(0);
const touchEndX = ref(0);

const handleTouchStart = (event) => {
    touchStartX.value = event.changedTouches[0].screenX;
};

const handleTouchEnd = (event) => {
    touchEndX.value = event.changedTouches[0].screenX;

    const diff = touchStartX.value - touchEndX.value;
    if (Math.abs(diff) < 50) return;

    diff > 0 ? nextOffer() : prevOffer();
};
</script>

<template>
    <section id="offers" class="overflow-hidden bg-[#F8FAFC] py-20 lg:py-24">
        <div class="mx-auto max-w-[1280px] px-5 sm:px-6">
            <div class="flex items-start justify-between gap-6">
                <div>
                    <h2
                        class="text-[38px] font-extrabold text-[#0F172A] sm:text-[56px]"
                    >
                        Pakkumised
                    </h2>

                    <p
                        class="mt-4 text-[18px] font-semibold text-[#0F172A] sm:text-[22px]"
                    >
                        Säästa rohkem meie parimate kampaaniate ja
                        eripakkumistega.
                    </p>
                </div>

                <div
                    v-if="activeOffers.length > 1"
                    class="hidden gap-4 lg:flex"
                >
                    <button
                        type="button"
                        aria-label="Eelmine pakkumine"
                        class="flex h-14 w-14 items-center justify-center rounded-full bg-[#6D28D9] text-white shadow-xl transition hover:scale-110 focus:outline-none focus:ring-4 focus:ring-[#C4B5FD]"
                        @click="prevOffer"
                    >
                        <ArrowLeft :size="30" aria-hidden="true" />
                    </button>

                    <button
                        type="button"
                        aria-label="Järgmine pakkumine"
                        class="flex h-14 w-14 items-center justify-center rounded-full bg-[#6D28D9] text-white shadow-xl transition hover:scale-110 focus:outline-none focus:ring-4 focus:ring-[#C4B5FD]"
                        @click="nextOffer"
                    >
                        <ArrowRight :size="30" aria-hidden="true" />
                    </button>
                </div>
            </div>

            <div
                v-if="activeOffers.length"
                class="mt-12"
                @touchstart="handleTouchStart"
                @touchend="handleTouchEnd"
            >
                <Transition name="offer-slide" mode="out-in">
                    <div :key="activeOffers[currentOffer]?.id" class="relative">
                        <Link
                            v-if="activeOffers[currentOffer]?.link"
                            :href="activeOffers[currentOffer].link"
                        >
                            <img
                                :src="
                                    imageUrl(activeOffers[currentOffer].image)
                                "
                                :alt="
                                    activeOffers[currentOffer].title ||
                                    'Velo pakkumine'
                                "
                                width="1120"
                                height="640"
                                class="mx-auto w-full max-w-[1120px] rounded-3xl object-cover shadow-[0_20px_60px_rgba(15,23,42,0.12)]"
                                loading="lazy"
                                decoding="async"
                            />
                        </Link>

                        <img
                            v-else
                            :src="imageUrl(activeOffers[currentOffer].image)"
                            :alt="
                                activeOffers[currentOffer].title ||
                                'Velo pakkumine'
                            "
                            width="1120"
                            height="640"
                            class="mx-auto w-full max-w-[1120px] rounded-3xl object-cover shadow-[0_20px_60px_rgba(15,23,42,0.12)]"
                            loading="lazy"
                            decoding="async"
                        />
                    </div>
                </Transition>
            </div>

            <div
                v-else
                class="mt-12 rounded-3xl bg-white p-8 text-center font-extrabold text-[#0F172A] shadow-[0_20px_60px_rgba(15,23,42,0.12)]"
            >
                Pakkumisi pole veel lisatud.
            </div>

            <div
                v-if="activeOffers.length > 1"
                class="mt-8 flex justify-center gap-4"
                aria-label="Pakkumiste valik"
            >
                <button
                    v-for="(_, index) in activeOffers"
                    :key="index"
                    type="button"
                    class="h-4 w-4 rounded-full transition focus:outline-none focus:ring-4 focus:ring-[#C4B5FD]"
                    :class="
                        index === currentOffer ? 'bg-[#6D28D9]' : 'bg-[#DDD0FF]'
                    "
                    :aria-label="`Näita pakkumist ${index + 1}`"
                    :aria-current="index === currentOffer ? 'true' : undefined"
                    @click="currentOffer = index"
                />
            </div>
        </div>
    </section>
</template>

<style scoped>
.offer-slide-enter-active,
.offer-slide-leave-active {
    transition:
        opacity 0.45s ease,
        transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
}

.offer-slide-enter-from {
    opacity: 0;
    transform: translateX(80px) scale(0.98);
}

.offer-slide-leave-to {
    opacity: 0;
    transform: translateX(-80px) scale(0.98);
}
</style>
