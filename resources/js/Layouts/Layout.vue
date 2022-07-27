<template>
    <div>
        <Header></Header>
        <slot></slot>
    </div>
</template>

<script>

import Header from "../Components/Header.vue";

export default {
    name: "Layout",
    components: {Header}
}
</script>

<style scoped>

</style>
