<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeTesting from '@/Components/Testing.vue';
import ChatBlank from '@/Components/ChatBlank.vue';
import { Head } from '@inertiajs/inertia-vue3';
import axios from 'axios';
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white border-b border-gray-200">

                        <div class="container mx-auto">
                            <div class="min-w-full rounded lg:grid lg:grid-cols-3">
                                <div class="border-r border-gray-300 lg:col-span-1">
                                <div class="mx-3 my-3">
                                    <div class="relative text-gray-600">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        viewBox="0 0 24 24" class="w-6 h-6 text-gray-300">
                                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </span>
                                    <input type="search" class="block w-full py-2 pl-10 bg-gray-100 rounded outline-none" name="search"
                                        placeholder="Search" required />
                                    </div>
                                </div>

                                <ul class="overflow-auto h-[32rem]">
                                    <h2 class="my-2 mb-2 ml-2 text-lg text-gray-600">Chats</h2>
                                    <li>
                                    <a
                                        v-for="(j, i) in listChat" :key="i"
                                        v-on:click="stateChat = j.id"
                                        class="flex items-center px-4 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer focus:outline-none"
                                        v-bind:class="(stateChat == j.id) ? 'bg-gray-100' : 'hover:bg-gray-100'"
                                    >
                                        <img class="object-cover w-10 h-10 rounded-full"
                                             :src="j.picture" 
                                             alt="username" />
                                        <div class="w-full pb-2">
                                            <div class="flex justify-between">
                                                <span class="block ml-4 font-semibold text-gray-600">{{ j.name }}</span>
                                                <span class="block ml-2 text-sm text-gray-600">{{ j.date }}</span>
                                            </div>
                                            <span class="block ml-4 text-sm text-gray-600">{{ j.data }}</span>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                                </div>
                                <div class="hidden border-r lg:col-span-2 lg:block bg-[#f6f1ff7a]">
                                    <ChatBlank v-if="isLoading"></ChatBlank>
                                    <BreezeTesting v-if="!isLoading"></BreezeTesting>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import { mutations } from "../Extend/store";

export default {
    data() {
        return {
            isLoading: true,
            stateChat: -1,
            listChat: [],
            userId: this.$page.props.auth.user.id, 
        }
    },
    watch: {
        stateChat: function () {
            if (this.stateChat != -1) {
                this.getChatsData();
                mutations.setChatId(this.stateChat);
            }
        },
    },
    created() {
        this.getChats();
    },
    mounted() {
        // this.onLoading();
    },
    methods: {
        onLoading() {
            this.isLoading = true;
            setTimeout(() => this.isLoading = false, 1500);
        },
        getChats() {
            axios
                .get('/api/chatList/' + this.userId)
                .then(res => {
                    this.listChat = res.data.data;
                    // console.log(res.data.data);
                });
        },
        getChatsData() {
            this.onLoading();
            mutations.setChat(this.stateChat);
        },

    }
}
</script>