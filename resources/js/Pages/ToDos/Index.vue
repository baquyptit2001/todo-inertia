<template>
    <Layout>
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
                <div class="col-3 mt-3" v-for="item in todos" :class="{ done: item.completed }">
                    <Item :item="item" @check="check" @edit="editItem" @delete="deleteItem"></Item>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>

import {useForm} from "@inertiajs/inertia-vue3";
import { notification } from 'ant-design-vue';
import Layout from "../../Layouts/Layout.vue";
import Item from "./Item.vue";

export default {
    name: "Index",
    mounted() {
        document.title = "To Do List";
    },
    components: {
        Layout,
        Item
    },
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
            this.itemForm.post(route("todos.store"), {
                onSuccess: () => {
                    this.itemForm.reset();
                    notification.success({
                        message: "To Do List",
                        description: "Item added successfully"
                    });
                },
                onError: (error) => {
                    notification.error({
                        message: "Error",
                        description: error[Object.keys(error)[0]]
                    });
                }
            });
        },
        deleteItem(id) {
            this.$inertia.delete(route("todos.destroy", id));
            notification.success({
                message: "To Do List",
                description: "Item deleted successfully"
            });
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
            this.itemEditForm.put(route("todos.update", this.itemEditForm.id), {
                onSuccess: () => {
                    this.itemEditForm.reset();
                    this.itemForm.reset()
                    this.add = true
                    notification.success({
                        message: "To Do List",
                        description: "Item updated successfully"
                    });
                },
                onError: (error) => {
                    notification.error({
                        message: "Error",
                        description: error[Object.keys(error)[0]]
                    });
                }
            });
        },
        check(id) {
            this.$inertia.put(route("todos.check", id), {
                onSuccess: () => {
                    notification.success({
                        message: "To Do List",
                        description: "Item checked successfully"
                    });
                },
            });
        }
    }
}
</script>

<style scoped>
.to-do-list__items__item__title {
    font-size: 1.5rem;
    font-weight: bold;
}

.done .card-title, .done .card-text {
    text-decoration: line-through;
}
</style>
