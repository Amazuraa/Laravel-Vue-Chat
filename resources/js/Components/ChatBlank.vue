<script setup>
import Spinner from 'vue-loading-spinner/src/components/RotateSquare2.vue';
</script>

<template>
    <div class="w-full h-full">

        <div class="grid gap-4 place-content-center h-full">
            <div class="place-content-center">
                <Spinner class="ml-3"></Spinner>
                <br>
                <span>Loading ..</span>
            </div>
        </div>

    </div>
</template>
