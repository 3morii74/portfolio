<template>
  <div class="bg-dark-navy-500" >
    <div
      class="
        container
        mx-auto
        py-12
        px-4
        sm:px-6
        lg:flex lg:items-center lg:justify-between lg:py-16 lg:px-8
      "
    >
      <h2
        class="
          text-3xl
          font-bold
          tracking-tight
        text-dark-navy-100
          sm:text-4xl
        "
        v-motion :initial="{opacity:0,
    y:100,
    }"
    :visible="{opacity:1,
      y:0,
    }" 
      >
        <span class="block">Ready to dive in?</span>
        <span class="block text-white"
          >Laravel 9 Admin Panel - Learn Roles and Permissions.</span
        >
      </h2>
      <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
        <div class="inline-flex rounded-md shadow">
          <a
            href="https://www.udemy.com/course/laravel-9-admin-panel-learn-roles-and-permissions/"
            class="
              inline-flex
              items-center
              justify-center
              rounded-md
              border border-transparent
              bg-dark-secondary
              px-5
              py-3
              text-base
              font-medium
              text-white
              hover:bg-dark-primary
            "
            >Get the Course</a
          >
        </div>
      </div>
    </div>
  </div>
</template>
