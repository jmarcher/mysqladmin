<template>
    <Layout :schema="schema">
        <template v-slot:sidebar_elements>
            <List :schema="schema" :tables="tables"></List>
        </template>
        <template v-slot:default>
            <section class="table-components">
                <div class="container-fluid">
                    <div class="card-style mb-30">
                        <h6 class="mb-10" v-text="schema"></h6>

                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th v-for="column in data.columns"><h6 v-text="column.name"></h6></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in data.data">
                                    <td v-for="column in data.columns" class="min-width">
                                        <p v-html="getColumnRowRepresentation(column, row)"></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </Layout>
</template>

<script>
import Layout from '../Layout'
import List from "./Partials/List";
import {Link} from '@inertiajs/inertia-vue3'

export default {
    components: {Link, List, Layout},
    props: {
        schema: String,
        tables: Array,
        data: Object,
    },

    methods:{
        // This should be in a separated file.
        getColumnRowRepresentation(column, row){
            let value = row[column.name];
            if(value === null){
                return `<i>NULL</i>`
            }

            if(column.foreign_key !== null){
                // TODO: Improve this for multiple keys
                return `<a class="text-primary"
                            href="?table=${column.foreign_key.table_name}&filters[${column.foreign_key.table_keys[0]}]=${value}">
                               ${value}
                        </a>`;
            }

            return value;
        }
    }
}
</script>
