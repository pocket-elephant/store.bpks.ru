<script setup>
import {Link} from "@inertiajs/vue3";
import {ChevronLeftIcon, ChevronRightIcon} from '@heroicons/vue/24/solid/index.js'

defineProps({
    resource: Object,
})
</script>

<template>
    <ul v-if="resource.hasOwnProperty('meta') && resource.meta.hasOwnProperty('links') && resource.meta.links.length > 3" class="flex">
        <li v-for="(link, index) in resource.meta.links" class="w-10 h-10 text-sm rounded-md flex justify-center items-center overflow-hidden"
            :class="{'border' : link.active }"
        >
            <Link v-if="link.url !== null && index !== 0 && index + 1 !== resource.meta.links.length" class="w-full h-full flex justify-center items-center hover:bg-gray-100" :href="link.url">
                {{ link.label }}
            </Link>

            <Link v-if="link.url !== null && index === 0" class="w-full h-full flex justify-center items-center hover:bg-gray-100" :href="link.url">
                <ChevronLeftIcon class="w-5 h-5"/>
            </Link>

            <Link v-if="link.url !== null && index + 1 === resource.meta.links.length" class="w-full h-full flex justify-center items-center hover:bg-gray-100" :href="link.url">
                <ChevronRightIcon class="w-5 h-5"/>
            </Link>

            <span v-if="link.url === null && index !== 0 && index + 1 !== resource.meta.links.length" class="w-full h-full flex justify-center items-center">
                {{ link.label }}
            </span>

            <span v-if="link.url === null && index === 0" class="w-full h-full flex justify-center items-center text-gray-300">
                <ChevronLeftIcon class="w-5 h-5"/>
            </span>

            <span v-if="link.url === null && index + 1 === resource.meta.links.length" class="w-full h-full flex justify-center items-center text-gray-300">
                <ChevronRightIcon class="w-5 h-5"/>
            </span>
        </li>
    </ul>
</template>
