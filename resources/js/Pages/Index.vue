<template>
    <div>
        <H1>Databases</H1>
        <ul>
            <li v-for="database in databases">
                <a :href="`/schemas/${database}`" v-text="database"></a>
            </li>
        </ul>
    </div>
</template>

<script>
import Layout from './Layout'

export default {
    // Using the shorthand
    layout: Layout,
    props: {
        databases: Array,
    }
}
</script>
