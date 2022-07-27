<template>
    <div class="todo-item">
        <div class="todo-item__title">
            {{ item.title }}
        </div>
        <div class="todo-item__description">
            {{ item.description }}
        </div>
        <div class="todo-item__actions">
            <button class="btn btn-primary" @click="editItem(item)">Edit</button>
            <button class="btn btn-danger" @click="deleteItem(item.id)">Delete</button>
        </div>
    </div>
</template>

<script>

export default {
    name: "Item",
    props: {
        item: {
            type: Object,
            required: true
        }
    },
    methods: {
        editItem(item) {
            this.$router.push({
                name: "Edit",
                params: {
                    id: item.id
                }
            });
        },
        deleteItem(item) {
            this.$store.dispatch("deleteItem", item);
        }
    }
}
</script>

<style scoped>

</style>
