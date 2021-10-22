<template>
    <Layout>
        <template v-slot:sidebar_elements>
            <List :schema="schema" :tables="tables"></List>
        </template>
        <template v-slot:default>
            Test
        </template>
    </Layout>
</template>
<script>
import Layout from '../Layout'
import List from "./Partials/List";
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {Link, List, Layout},
    props: {
        schema:String,
        tables: Array,
    }
}
</script>

