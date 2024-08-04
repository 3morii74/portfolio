<script setup>
import Project from "./Project.vue";
import { ref, watch } from "vue";

const props = defineProps({
  skills: Object,
  projects: Object,
});

const filteredProjects = ref(props.projects.data);
const selectedSkill = ref("all");
const showDropdown = ref(false);

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
  showDropdown.value = false; // Hide dropdown after selection
};

const selectedSkillName = ref("All");

watch(selectedSkill, () => {
  if (selectedSkill.value === "all") {
    selectedSkillName.value = "All";
  } else {
    const skill = props.skills.data.find(skill => skill.id === selectedSkill.value);
    selectedSkillName.value = skill ? skill.name : "Select a skill";
  }
});
</script>

<template>
  <div class="container mx-auto" v-motion :initial="{opacity:0, y:100,}" :visible="{opacity:1, y:0,}">
    <nav class="mb-12 border-b-2 border-light-tail-100 text-dark-navy-100">
      <!-- Dropdown for mobile -->
      <div class="block lg:hidden relative">
        <button @click="showDropdown = !showDropdown" class="bg-dark-navy-100 text-white px-4 py-2 rounded-md w-full text-left">
          {{ selectedSkillName }}
          <span class="float-right">&#x25BC;</span>
        </button>
        <ul v-if="showDropdown" class="absolute bg-dark-navy-500 w-full rounded-md mt-2 z-10 shadow-lg">
          <li>
            <button
              @click="filterProjects('all')"
              class="block w-full text-left px-4 py-2 hover:bg-accent text-white"
              :class="[
                selectedSkill === 'all'
                  ? 'bg-accent'
                  : 'bg-dark-navy-100',
              ]"
            >
              All
            </button>
          </li>
          <li
            v-for="projectSkill in skills.data"
            :key="projectSkill.id"
          >
            <button
              @click="filterProjects(projectSkill.id)"
              class="block w-full text-left px-4 py-2 hover:bg-accent text-white"
              :class="[
                selectedSkill == projectSkill.id
                  ? 'bg-accent'
                  : 'bg-dark-navy-100',
              ]"
            >
              {{ projectSkill.name }}
            </button>
          </li>
        </ul>
      </div>

      <!-- List for larger screens -->
      <ul class="hidden lg:flex flex-wrap justify-center lg:justify-evenly items-center space-y-4 lg:space-y-0 lg:space-x-4">
        <li class="cursor-pointer capitalize">
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
                : 'bg-dark-navy-100',
            ]"
          >
            All
          </button>
        </li>
        <li
          class="cursor-pointer capitalize"
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
                : 'bg-dark-navy-100',
            ]"
          >
            {{ projectSkill.name }}
          </button>
        </li>
      </ul>
    </nav>

    <section class="grid gap-y-12 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 lg:gap-8">
      <Project
        v-for="project in filteredProjects"
        :key="project.id"
        :project="project"
      />
    </section>
  </div>
</template>

