<template>

  <Head title="Skills Index" />
  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Skills</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end m-2 p-2">
          <Link href="/skills/create" class="
              px-4
              py-2
              bg-indigo-500
              hover:bg-indigo-700
              text-white
              rounded-md
            ">New Skill</Link>
        </div>

        <div class="overflow-x-auto relative">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-900">
            <thead class="text-xs text-white-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
              <tr>
                <th scope="col" class="py-3 px-6">ID</th>
                <th scope="col" class="py-3 px-6">Name</th>
                <th scope="col" class="py-3 px-6">Image</th>
                <th scope="col" class="py-3 px-6"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="skill in skills.data" :key="skill.id"
              class="bg-white border-b dark:bg-white-800 dark:border-white-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text">
                  {{ skill.id }}
                </th>
                <td class="py-4 px-6">{{ skill.name }}</td>
                <td class="py-4 px-6">
                  <img :src="skill.image" class="w-12 h-12 rounded-full" />
                </td>
                <td class="py-4 px-6">
                  <Link :href="route('skills.edit', skill.id)"
                    class="font-medium text-blue-500 hover:text-blue-700 mr-2">
                  Edit</Link>
                  <Link :href="route('skills.destroy', skill.id)" method="delete" as="button" type="button"
                    class="font-medium text-red-500 hover:text-red-700 mr-2">Delete</Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
  skills: Object,
});
</script>