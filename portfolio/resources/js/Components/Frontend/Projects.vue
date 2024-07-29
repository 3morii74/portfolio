<script setup>
import Project from "./Project.vue";
import { ref, watch } from "vue";

const props = defineProps({
  skills: Object,
  projects: Object,
});

const filteredProjects = ref(props.projects.data);
const selectedSkill = ref("all");

// Watch for changes to the selectedSkill and update filteredProjects accordingly
watch(selectedSkill, (newSkill) => {
  filterProjects(newSkill);
});

const filterProjects = (id) => {
  console.log('Filtering projects for skill id:', id);
  
  if (id === "all") {
    filteredProjects.value = props.projects.data;
  } else {
    filteredProjects.value = props.projects.data.filter((project) => {
      console.log('Project:', project);
      const hasSkill = project.skills.some((skill) => skill.id === id);
      console.log('Has skill:', hasSkill);
      return hasSkill;
    });
  }
  
  selectedSkill.value = id;
};
</script>

<template>
  <div class="container mx-auto" v-motion :initial="{opacity:0, y:100,}" :visible="{opacity:1, y:0,}">
    <nav class="mb-12 border-b-2 border-light-tail-100 dark:text-dark-navy-100">
      <ul class="flex flex-col lg:flex-row justify-evenly items-center">
        <li class="cursor-pointer capitalize m-4">
          <button
            @click="filterProjects('all')"
            class="
              flex
              text-center
              px-4
              py-2
              hover:bg-accent
              text-white
              rounded-md
            "
            :class="[
              selectedSkill === 'all'
                ? 'bg-accent'
                : 'bg-light-tail-500 dark:bg-dark-navy-100',
            ]"
          >
            All
          </button>
        </li>
        <li
          class="cursor-pointer capitalize m-4"
          v-for="projectSkill in skills.data"
          :key="projectSkill.id"
        >
          <button
            @click="filterProjects(projectSkill.id)"
            class="
              flex
              text-center
              px-4
              py-2
              hover:bg-accent
              text-white
              rounded-md
            "
            :class="[
              selectedSkill == projectSkill.id
                ? 'bg-accent'
                : 'bg-light-tail-500 dark:bg-dark-navy-100',
            ]"
          >
            {{ projectSkill.name }}
          </button>
        </li>
      </ul>
    </nav>
    <section class="grid gap-y-12 lg:grid-cols-3 lg:gap-8">
      <Project
        v-for="project in filteredProjects"
        :key="project.id"
        :project="project"
      />
    </section>
  </div>
</template>
