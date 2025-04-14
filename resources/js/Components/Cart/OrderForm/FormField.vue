<script setup>
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
    errorKey: String,
})

const page = usePage();
</script>

<template>
    <div class="mb-4">
        <label class="block text-gray-700">
            <slot name="label"/>
        </label>
        <slot/>
        <div class="text-red-600 text-sm mt-2" v-if="page.props.errors.hasOwnProperty(props.errorKey)">{{ page.props.errors[props.errorKey] }}</div>
    </div>
</template>
