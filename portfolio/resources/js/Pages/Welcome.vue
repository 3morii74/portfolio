<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import FrontendLayout from "@/Layouts/Frontend.vue";
import Hero from "@/Components/Frontend/Hero.vue";
import Promote from "@/Components/Frontend/Promote.vue";
import About from "@/Components/Frontend/About.vue";

import Skills from "@/Components/Frontend/Skills.vue";
defineProps({
  skills:Object,
})
</script>

<template>
  <Head title="Welcome to portfolio" />
  <FrontendLayout>
    <!-- Hero primary -->
     <Hero/>
    <!-- promote tail-100 -->
     <Promote/>
    <!-- About secondary -->
     <About/>
    <!-- Skills tail-100 -->
     <Skills :skills="skills"/>
    <!-- Portfolio primary -->    
    <!-- Services secondary -->
     <!-- Contact primary -->
    



  </FrontendLayout>
</template>
