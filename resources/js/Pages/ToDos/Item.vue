<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ item.title }}</h5>
            <p class="card-text">{{ item.description }}</p>
            <div class="to-do-list__items__item__actions">
                <a-checkbox v-model:checked="item.completed" @change="check(item.id)">Done</a-checkbox>
                <button class="btn btn-primary" @click="editItem(item)">Edit</button>
                <a-popconfirm
                    title="Are you sure delete this task?"
                    ok-text="Yes"
                    cancel-text="No"
                    @confirm="deleteItem(item)"
                >
                    <button class="btn btn-danger ms-3">Delete</button>
                </a-popconfirm>
            </div>
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
        check(id) {
            this.$emit("check", id);
        },
        deleteItem(item) {
            this.$emit("delete", item);
        },
        editItem(item) {
            this.$emit("edit", item);
        }
    }
}
</script>

<style scoped>
.done .card-title, .done .card-text {
    text-decoration: line-through;
}
</style>
