<script setup>
</script>
<template>
  <section
    id="home"
    class="
      lg:h-[85vh]
      flex
      items-center
      bg-light-primary
      dark:bg-dark-primary
      py-32
      lg:py-0
      overflow-hidden
    "
  >
    <div class="container mx-auto h-full">
      <div class="flex flex-col md:flex-row items-center h-full pt-8">
        <div class="flex-1 flex flex-col items-center lg:items-start">
          <p class="text-lg text-accent text-md mb-[22px]">Hey, I'm Omar! 👋</p>
          <h1
            class="
              text-4xl
              leading-[44px]
              md:text-5xl md:leading-tight
              lg:text-7xl lg:leading-[1.2]
              font-bold
              md:tracking-[-2px]
            "
          >
            I Build & Design <br />
            Web Interfaces.
          </h1>
          <p
            class="
              pt-4
              pb-8
              md:pt-6 md:pb-12
              max-w-[480px]
              text-lg text-center
              lg:text-left
            "
          >
            Lorem ipsum dolor sit amet consectetur adipisicing illo ad labore
            dolor elit.
          </p>
          <button
            class="
              btn btn-md
              bg-accent
              hover:bg-light-secondary hover:text-light-tail-500
              dark:hover:bg-dark-secondary dark:hover:text-dark-navy-100
              md:btn-lg
              transition-all
            "
          >
            Work with me
          </button>
        </div>
        <div class="flex flex-1 justify-end items-center h-full mt-8 md:mt-0">
          <img
            class="rounded-lg"
            src="https://scontent.fcai19-7.fna.fbcdn.net/v/t39.30808-6/450559652_2745879958905113_7244495243180391719_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeHgFJR655hOT98rfHwiDPjFgoctqUh6E2aChy2pSHoTZtN5x-tpf-8eCkb5u9-J_yWwTwPjmcxMkQkgBqPHaIRZ&_nc_ohc=eizU4A8KQbMQ7kNvgFip-Pa&_nc_ht=scontent.fcai19-7.fna&oh=00_AYBMV_PUsMIrJbSp9vnV-C4DGbLQkI6SLzPDVkg63O27Mg&oe=669F5606"
            alt="Hero"
          />
        </div>
      </div>
    </div>
  </section>
</template>