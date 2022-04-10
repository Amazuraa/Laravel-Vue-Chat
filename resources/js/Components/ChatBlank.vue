<script setup>
import Spinner from 'vue-loading-spinner/src/components/RotateSquare2.vue';
import applicationLogo from '@/Components/ApplicationLogo.vue'
</script>

<template>
    <div class="w-full h-full">

        <div class="grid gap-4 place-content-center h-full">
            <div class="grid justify-items-center" v-if="isLoading">
                <Spinner class="self-center"></Spinner>
                <br>
                <p class="text-center">Loading ..</p>
            </div>
            <div class="place-content-center" v-if="!isLoading">
                <application-logo class=" w-[110px]"></application-logo>
                <br>
                <p class="text-center">Select or Start <br>a new chat</p>
            </div>
        </div>

    </div>
</template>

<script>
import { store } from '../Extend/store'

export default {
    data() {},
    computed: {
        isLoading() { return store.loading; },
    },
}
</script>
