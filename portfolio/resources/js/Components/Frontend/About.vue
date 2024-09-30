<template>
  <section id="about" class="section bg-dark-secondary">
    <div class="container mx-auto" v-motion :initial="{
      opacity: 0,
      y: 100,
    }" :visible="{
      opacity: 1,
      y: 0,
    }">
      <div class="flex flex-col xl:flex-row gap-24">
        <img class="object-cover h-full w-[566px] md:mx-auto lg:mx-0 rounded-2xl"
          src="https://avatars.githubusercontent.com/u/130834353?s=400&u=9f6b023e5dc7374dacb6f5c89612caf5ea763b45&v=4"
          alt="about" />
        <div class="
            flex flex-col
            items-center
            text-center
            lg:items-start lg:text-left
          ">
          <div class="flex flex-col">
            <h2 class="text-3xl lg:text-4xl font-medium lg:font-extrabold mb-3">
              About Me
            </h2>
            <P class="mb-4 text-accent">Freelance frontend Web developer</P>
            <hr class="mb-8 opacity-90 " />
            <p class="mb-8">
              I am a backend developer with over one year of experience using Laravel to build robust and scalable
              applications. I specialize in creating RESTful APIs, managing databases, and implementing authentication
              systems to ensure data security. <br />
              <br />
              My journey in backend development has equipped me with the skills to solve complex problems and enhance
              user experiences through efficient server-side solutions. I am passionate about optimizing performance and
              maintaining code quality, which allows me to deliver high-quality software. <br />
              <br />
              I look forward to collaborating on exciting projects and leveraging my skills to contribute effectively to
              your team.
            </p>

          </div>
        
        </div>
      </div>
    </div>
  </section>
</template>