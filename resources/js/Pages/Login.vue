<template>
  <div>
    <H1>Welcome</H1>
    <p>Hello {{ user.name }}, welcome to your first Inertia app!</p>
  </div>
</template>

<script>
  import Layout from './Layout'

  export default {
    // Using the shorthand
    layout: Layout,

    props: {
      user: Object,
    },
  }
</script>
