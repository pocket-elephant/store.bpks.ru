<script setup>
import Layout from '../Layouts/Basic.vue'

defineProps({
    order: Object,
})
</script>

<template>
    <Layout>
        <h2 class="text-xl mb-4">Ваш заказ успешно оформлен</h2>
        <pre class="bg-gray-100 rounded-lg text-xs p-4">{{ order }}</pre>
    </Layout>
</template>
