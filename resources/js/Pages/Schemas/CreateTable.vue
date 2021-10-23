<template>
    <Layout :schema="schema">
        <template v-slot:sidebar_elements>
            <List :schema="schema" :tables="tables"></List>
        </template>
        <template v-slot:default>
            <section class="table-components">
                <div class="container-fluid">
                    <form @submit.prevent="submit">
                        <span class="main-btn secondary-btn btn-hover" @click="addColumn">Add column</span>
                        <div class="container">
                            <div class="row" v-for="column in form.columns">
                                <div class="column">
                                    <div class="input-style-1">
                                        <input type="text" placeholder="Name" v-model="column.name"/>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="select-style-2">
                                        <div class="select-position">
                                            <select v-model="column.type">
                                                <option value="">Select a Type</option>
                                                <option value="string">String</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="input-style-1">
                                <label>Table name</label>
                                <input type="text" placeholder="Table name" v-model="form.name"/>
                            </div>

                            <button type="submit" class="main-btn primary-btn btn-hover">Save</button>
                    </form>
                </div>
            </section>
        </template>
    </Layout>
</template>

<script>
import Layout from '../Layout'
import List from "./Partials/List";
import {Link} from '@inertiajs/inertia-vue3'

import {reactive} from 'vue'
import {Inertia} from '@inertiajs/inertia'

export default {
    components: {Link, List, Layout},
    setup(props) {
        const form = reactive({
            name: null,
            columns: [],
        })

        function submit() {
            Inertia.post(`/schemas/${props.schema}/create_table`, form)
        }

        function addColumn() {
            form.columns.push({
                name: '',
                type:'',
            });
        }

        return {form, submit, addColumn}
    },
    props: {
        schema: String,
        tables: Array,
    },
    methods: {}
}
</script>
