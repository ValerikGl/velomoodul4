<script setup>
import { onMounted, onUnmounted, nextTick } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { MapPin, Phone, Mail, Send, CheckCircle } from "lucide-vue-next";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import MainLayout from "../Layouts/MainLayout.vue";

defineOptions({
    layout: MainLayout,
});

const page = usePage();

const form = useForm({
    name: "",
    email: "",
    message: "",
});

const submit = () => {
    form.post("/contact", {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

let contactMap = null;

onMounted(async () => {
    await nextTick();

    contactMap = L.map("contact-map", {
        zoomControl: false,
        scrollWheelZoom: false,
    }).setView([59.438387, 24.758434], 15);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; OpenStreetMap contributors",
    }).addTo(contactMap);

    const veloIcon = L.divIcon({
        className: "velo-map-marker",
        html: `
      <div class="velo-marker">
        <div class="velo-marker-dot"></div>
      </div>
    `,
        iconSize: [46, 46],
        iconAnchor: [23, 46],
        popupAnchor: [0, -42],
    });

    L.marker([59.438387, 24.758434], { icon: veloIcon })
        .addTo(contactMap)
        .bindPopup("Velo punkt<br>Narva mnt 5")
        .openPopup();
});

onUnmounted(() => {
    if (contactMap) {
        contactMap.remove();
        contactMap = null;
    }
});
</script>

<template>
    <main class="bg-[#F8FAFC] px-5 py-12 sm:px-6 lg:py-16">
        <div class="mx-auto max-w-[1280px]">
            <section
                v-reveal
                class="grid items-center gap-10 lg:grid-cols-[1fr_1fr]"
            >
                <div>
                    <h1
                        class="text-[44px] font-extrabold leading-tight text-[#0F172A] sm:text-[58px]"
                    >
                        Võta meiega <br />
                        ühendust
                    </h1>

                    <p
                        class="mt-5 max-w-[560px] text-[18px] font-semibold leading-relaxed text-[#0F172A]"
                    >
                        Kas sul on küsimusi sõidukite, broneeringute või koostöö
                        kohta? Meie meeskond aitab sind hea meelega.
                    </p>
                </div>

                <div class="relative flex justify-center">
                    <img
                        :src="'/images/contact/contact-hero.webp'"
                        alt="Velo contact"
                        class="w-full max-w-[560px] object-contain"
                    />
                </div>
            </section>

            <section v-reveal class="mt-14 grid gap-6 md:grid-cols-3">
                <article
                    class="flex items-center gap-5 rounded-2xl bg-white p-6 shadow-[0_18px_45px_rgba(15,23,42,0.10)]"
                >
                    <div
                        class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-[#EDE4FF] text-[#6D28D9]"
                    >
                        <MapPin :size="42" />
                    </div>

                    <div>
                        <h3 class="font-extrabold text-[#0F172A]">Asukoht</h3>
                        <p class="mt-1 text-sm font-extrabold text-[#6D28D9]">
                            Velo OÜ
                        </p>
                        <p class="text-sm font-semibold text-[#0F172A]">
                            Narva mnt 5
                        </p>
                        <p class="text-sm font-semibold text-[#0F172A]">
                            10117 Tallinn, Estonia
                        </p>
                    </div>
                </article>

                <article
                    class="flex items-center gap-5 rounded-2xl bg-white p-6 shadow-[0_18px_45px_rgba(15,23,42,0.10)]"
                >
                    <div
                        class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-[#EDE4FF] text-[#6D28D9]"
                    >
                        <Phone :size="42" />
                    </div>

                    <div>
                        <h3 class="font-extrabold text-[#0F172A]">Telefon</h3>
                        <p class="mt-1 text-sm font-extrabold text-[#6D28D9]">
                            +372 5432 1234
                        </p>
                        <p class="text-sm font-semibold text-[#0F172A]">E-R</p>
                        <p class="text-sm font-semibold text-[#0F172A]">
                            09:00 - 19:00
                        </p>
                    </div>
                </article>

                <article
                    class="flex items-center gap-5 rounded-2xl bg-white p-6 shadow-[0_18px_45px_rgba(15,23,42,0.10)]"
                >
                    <div
                        class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-[#EDE4FF] text-[#6D28D9]"
                    >
                        <Mail :size="42" />
                    </div>

                    <div>
                        <h3 class="font-extrabold text-[#0F172A]">E-post</h3>
                        <p class="mt-1 text-sm font-extrabold text-[#6D28D9]">
                            info@velo.ee
                        </p>
                        <p class="text-sm font-semibold text-[#0F172A]">
                            Vastame tavaliselt
                        </p>
                        <p class="text-sm font-semibold text-[#0F172A]">
                            24 tunni jooksul
                        </p>
                    </div>
                </article>
            </section>

            <section
                v-reveal
                class="mt-12 grid gap-8 rounded-3xl bg-white p-6 shadow-[0_20px_60px_rgba(15,23,42,0.10)] lg:grid-cols-[340px_1fr] lg:p-8"
            >
                <form class="flex flex-col" @submit.prevent="submit">
                    <h2 class="text-[24px] font-extrabold text-[#0F172A]">
                        Saada meile sõnum
                    </h2>

                    <Transition name="success-message">
                        <div
                            v-if="page.props.flash?.success"
                            class="mt-5 rounded-2xl border border-[#DDD0FF] bg-[#F8FAFC] p-4 shadow-[0_14px_35px_rgba(109,40,217,0.14)]"
                        >
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#EDE4FF] text-[#6D28D9]"
                                >
                                    <CheckCircle :size="24" />
                                </div>

                                <div>
                                    <p
                                        class="text-[15px] font-extrabold text-[#0F172A]"
                                    >
                                        Sõnum saadetud!
                                    </p>
                                    <p
                                        class="mt-1 text-sm font-semibold leading-relaxed text-slate-600"
                                    >
                                        Aitäh, võtsime sinu sõnumi vastu ja
                                        vastame esimesel võimalusel.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </Transition>

                    <label class="mt-7">
                        <span class="text-sm font-extrabold text-[#0F172A]"
                            >Nimi</span
                        >
                        <input
                            v-model="form.name"
                            type="text"
                            placeholder="Sinu nimi"
                            class="mt-2 h-[46px] w-full rounded-lg border border-[#CBD5E1] bg-white px-4 text-sm font-semibold outline-none transition focus:border-[#6D28D9]"
                        />
                        <p
                            v-if="form.errors.name"
                            class="mt-1 text-sm font-bold text-red-600"
                        >
                            {{ form.errors.name }}
                        </p>
                    </label>

                    <label class="mt-4">
                        <span class="text-sm font-extrabold text-[#0F172A]"
                            >E-post</span
                        >
                        <input
                            v-model="form.email"
                            type="email"
                            placeholder="Sinu e-posti aadress"
                            class="mt-2 h-[46px] w-full rounded-lg border border-[#CBD5E1] bg-white px-4 text-sm font-semibold outline-none transition focus:border-[#6D28D9]"
                        />
                        <p
                            v-if="form.errors.email"
                            class="mt-1 text-sm font-bold text-red-600"
                        >
                            {{ form.errors.email }}
                        </p>
                    </label>

                    <label class="mt-4">
                        <span class="text-sm font-extrabold text-[#0F172A]"
                            >Sõnum</span
                        >
                        <textarea
                            v-model="form.message"
                            placeholder="Sinu sõnum"
                            class="mt-2 h-[150px] w-full resize-none rounded-lg border border-[#CBD5E1] bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-[#6D28D9]"
                        ></textarea>
                        <p
                            v-if="form.errors.message"
                            class="mt-1 text-sm font-bold text-red-600"
                        >
                            {{ form.errors.message }}
                        </p>
                    </label>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="mt-6 flex h-[46px] items-center justify-center gap-3 rounded-lg bg-[#6D28D9] text-sm font-bold text-white shadow-lg transition hover:bg-[#5B21B6] disabled:cursor-not-allowed disabled:opacity-60"
                    >
                        <Send :size="18" />
                        {{ form.processing ? "Saadan..." : "Saada sõnum" }}
                    </button>
                </form>

                <div
                    class="relative h-full min-h-[520px] overflow-hidden rounded-2xl"
                >
                    <div
                        id="contact-map"
                        class="brand-map absolute inset-0"
                    ></div>
                </div>
            </section>
        </div>
    </main>
</template>

<style scoped>
.brand-map {
    filter: saturate(0.8) contrast(1.05);
}

:deep(.velo-marker) {
    width: 46px;
    height: 46px;
    border-radius: 999px 999px 999px 0;
    background: #6d28d9;
    transform: rotate(-45deg);
    box-shadow: 0 12px 30px rgba(109, 40, 217, 0.35);
    display: flex;
    align-items: center;
    justify-content: center;
}

:deep(.velo-marker-dot) {
    width: 15px;
    height: 15px;
    border-radius: 999px;
    background: white;
}

.success-message-enter-active,
.success-message-leave-active {
    transition:
        opacity 0.25s ease,
        transform 0.25s ease;
}

.success-message-enter-from,
.success-message-leave-to {
    opacity: 0;
    transform: translateY(-8px);
}
</style>
