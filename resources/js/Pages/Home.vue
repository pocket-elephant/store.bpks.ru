<script setup>
import Layout from '../Layouts/Basic.vue'
import CategoryMenu from '../Components/CategoryMenu.vue'

const props = defineProps({
    categories: Object
})

</script>

<template>
    <Layout>
        <CategoryMenu :categories="categories.data"/>
    </Layout>
</template>
