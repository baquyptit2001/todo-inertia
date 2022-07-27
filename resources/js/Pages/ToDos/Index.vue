<template>
    <div class="to-do-list container">
        <div class="to-do-list__header d-flex justify-content-center">
            <div class="to-do-list__header__title w-50" v-if="add">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="staticEmail" v-model="itemForm.title">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPassword" v-model="itemForm.description">
                    </div>
                </div>
                <div class="to-do-list__header__actions">
                    <button class="btn btn-primary" @click="addItem">Add</button>
                </div>
            </div>
            <div class="to-do-list__header__title w-50" v-else>
                <input type="hidden" class="form-control" id="staticEmail" v-model="itemEditForm.id">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="staticEmail" v-model="itemEditForm.title">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPassword" v-model="itemEditForm.description">
                    </div>
                </div>
                <div class="to-do-list__header__actions">
                    <button class="btn btn-primary" @click="saveEditItem">Edit</button>
                    <button class="btn btn-danger ms-3" @click="cancelEdit">Cancel</button>
                </div>
            </div>
        </div>
        <div class="to-do-list__items row justify-content-around pt-5">
            <div class="col-3" v-for="item in todos">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ item.title }}</h5>
                        <p class="card-text">{{ item.description }}</p>
                        <div class="to-do-list__items__item__actions">
                            <button class="btn btn-primary" @click="editItem(item)">Edit</button>
                            <button class="btn btn-danger ms-3" @click="deleteItem(item)">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import {useForm} from "@inertiajs/inertia-vue3";

export default {
    name: "Index",
    setup() {
        const itemForm = useForm({
            title: "",
            description: ""
        });

        const itemEditForm = useForm({
            id: "",
            title: "",
            description: ""
        });

        return {itemForm, itemEditForm}
    },
    props: {
        todos: {
            type: Array
        }
    },
    data() {
        return {
            add: true,
        }
    },
    methods: {
        addItem() {
            this.itemForm.post(route("todos.store"));
            this.itemForm.reset();
        },
        deleteItem(id) {
            this.$inertia.delete(route("todos.destroy", id));
        },
        editItem(item) {
            this.itemEditForm.title = item.title;
            this.itemEditForm.description = item.description;
            this.itemEditForm.id = item.id;
            this.add = false
        },
        cancelEdit() {
            this.itemEditForm.reset();
            this.itemForm.reset()
            this.add = true
        },
        saveEditItem() {
            this.itemEditForm.put(route("todos.update", this.itemEditForm.id));
            this.itemEditForm.reset();
            this.itemForm.reset()
            this.add = true
        }
    }
}
</script>

<style scoped>
.to-do-list__items__item__title {
    font-size: 1.5rem;
    font-weight: bold;
}
</style>
