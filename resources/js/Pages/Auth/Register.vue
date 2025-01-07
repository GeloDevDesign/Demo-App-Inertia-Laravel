<script setup>
import navLink from "../Components/navLink.vue";
</script>

<template>
  <h1 class="text-lg text-blue-500">Registration Page</h1>

  <navLink as="button" method="POST" page="register" componenName="/register">Register</navLink>
  
</template>