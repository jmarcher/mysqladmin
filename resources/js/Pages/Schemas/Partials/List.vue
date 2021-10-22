<template>
                <li v-for="table in tables">
                    <Link :href="`/schemas/${schema}/data/?table=${table}`" class="nav-link" aria-current="page">
                        <!--          <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>-->
                        {{ table }}
                    </Link>
                </li>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    name: "List",
    components:{Link},
    props:{
        schema:String,
        tables:Array,
    }
}
</script>

<style scoped>
.flexible {
    display: flex;
    flex-wrap: nowrap;
    height: 100vh;
    height: -webkit-fill-available;
    max-height: 100vh;
    overflow-x: auto;
    overflow-y: auto;
}
</style>
