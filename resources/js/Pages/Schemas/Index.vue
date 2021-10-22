<template>
    <div>
    <List v-slot="sidebar_elements"></List>
    </div>
</template>
<script>
import Layout from '../Layout'
import List from "./Partials/List";
import { Link } from '@inertiajs/inertia-vue3'

export default {
    // Using the shorthand
    layout: Layout,
    components: {Link, List},
    props: {
        schema:String,
        tables: Array,
    }
}
</script>

