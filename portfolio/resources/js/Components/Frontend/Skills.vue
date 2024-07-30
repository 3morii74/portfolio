<script setup>
defineProps({
  skills: Object,
});
</script>

<template>
  <section class="bg-light-tail-100 dark:bg-dark-navy-500 py-16 overflow-hidden">
    <div class="container mx-auto relative">
      <div class="carousel-wrapper">
        <div class="carousel">
          <!-- Duplicate the skill items to create a continuous effect -->
          <div class="carousel-track">
            <div
              class="carousel-item flex items-center justify-center"
              v-for="(skill, index) in skills.data"
              :key="index"
            >
              <img :src="skill.image" :alt="skill.name" class="lg:h-20" />
            </div>
          </div>
          <div class="carousel-track">
            <div
              class="carousel-item flex items-center justify-center"
              v-for="(skill, index) in skills.data"
              :key="index + skills.data.length"
            >
              <img :src="skill.image" :alt="skill.name" class="lg:h-20" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.carousel-wrapper {
  display: flex;
  width: 100%;
  overflow: hidden;
}

.carousel {
  display: flex;
  width: 100%; /* Make sure this is twice the width of a single track */
  animation: scroll 10s linear infinite;
}

@keyframes scroll {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-100%);
  }
}

.carousel-track {
  display: flex;
  flex: 0 0 100%; /* Each track takes up 50% of the total width */
}

.carousel-item {
  flex: 0 10 12.5%; /* Adjust based on the number of items visible at once */
}
</style>
