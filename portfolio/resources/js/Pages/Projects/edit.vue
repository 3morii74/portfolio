<template>
  <Head title="New Project  " />
  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        New Project
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white">
        <form class="p-4" @submit.prevent="submit">
          <div>
            <BreezeLabel for="skill_id" value="Skills" />
            <div class="mt-2">
              <div v-for="skill in skills" :key="skill.id" class="flex items-center">
                <input
                  type="checkbox"
                  :id="'skill-' + skill.id"
                  :value="skill.id"
                  v-model="form.skill_id"
                  class="mr-2"
                />
                <label :for="'skill-' + skill.id">{{ skill.name }}</label>
              </div>
            </div>
            <BreezeInputError class="mt-2" :message="form.errors.skill_id" />
          </div>
          <div>
            <BreezeLabel for="name" value="Name" />
            <BreezeInput
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
              autofocus
              autocomplete="name"
            />
            <BreezeInputError class="mt-2" :message="$page.props.errors.name" />
          </div>
          <div>
            <BreezeLabel for="project_url" value="URL" />
            <BreezeInput
              id="project_url"
              type="text"
              class="mt-1 block w-full"
              v-model="form.project_url"
              autocomplete="projecturl"
            />
            <BreezeInputError
              class="mt-2"
              :message="$page.props.errors.project_url"
            />
          </div>
          <div class="mt-2">
            <BreezeLabel for="image" value="Image" />
            <BreezeInput
              id="image"
              type="file"
              class="mt-1 block w-full"
              @input="form.image = $event.target.files[0]"
            />
            <BreezeInputError
              class="mt-2"
              :message="$page.props.errors.image"
            />
          </div>
          <div class="flex items-center justify-end mt-4">
            <BreezeButton class="ml-4"> Update </BreezeButton>
          </div>
        </form>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/Button.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeInputError from "@/Components/InputError.vue";
import BreezeLabel from "@/Components/Label.vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  skills: Array,
  project: Object,
});

const form = useForm({
  name: "",
  image: null,
  skill_id: [], // Initialize as an array to handle multiple selections
  project_url: "",
});

const submit = () => {
  Inertia.post(`/projects/${props.project.id}`, {
    _method: "put",
    name: form.name,
    image: form.image,
    skill_id: form.skill_id,
    project_url: form.project_url,
  });
};
</script>