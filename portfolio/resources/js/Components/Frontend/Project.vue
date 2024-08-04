<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
  project: Object,
});
</script>

<template>
  <a
    :href="project.project_url"
    class="group flex flex-col items-center text-center cursor-pointer"
    v-motion :initial="{opacity:0, y:100,}" :enter="{opacity:1, y:0,}"
  >
    <div class="mb-6">
      <img class="rounded-2xl h-56" :src="project.image" :alt="project.name" />
    </div>
    <div>
    </div>
    <h3
      class="
        group-hover:text-light-tail-100
        text-2xl
        font-semibold
        capitalize
        mb-3
      "
    >
      {{ project.name }}
    </h3>
  </a>
</template>
