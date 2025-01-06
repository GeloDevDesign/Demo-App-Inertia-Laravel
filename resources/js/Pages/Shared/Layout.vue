<script setup>
import Nav from "./Nav.vue";
</script>

<template>
   
        <section class="p-6">
            <header>
                <Nav />
            </header>

            <span>Welcome Back {{ $page.props.auth.user.username }}</span>

            <div>
                <slot name="pagename"></slot>
            </div>

            <div>
                <slot />
            </div>
       
        </section>
  
</template>
