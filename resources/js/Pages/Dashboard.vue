<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import ChatMain from '@/Components/ChatMain.vue';
import ChatBlank from '@/Components/ChatBlank.vue';
import ChatNew from '@/Components/ChatNew.vue';
import ChatSearch from '@/Components/ChatSearch.vue';
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
                                    <ChatSearch></ChatSearch>

                                    <ul class="overflow-auto h-[32rem]">
                                        <h2 class="my-2 mb-2 ml-2 text-lg text-gray-600">Chats</h2>
                                        <li>
                                        <a
                                            v-for="(j, i) in listChat" :key="i"
                                            v-on:click="stateChat = j.id, (j.data != null) ? isNew = false : isNew = true"
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
                                                <span class="block ml-4 text-sm text-gray-600">{{ (j.data != null) ? j.data : 'Start a new chat ..' }}</span>
                                            </div>
                                        </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="hidden border-r lg:col-span-2 lg:block bg-[#f6f1ff7a]">
                                    <ChatBlank v-if="isLoading"></ChatBlank>
                                    <ChatMain v-if="!isLoading && !isNew"></ChatMain>
                                    <ChatNew v-if="!isLoading && isNew"></ChatNew>
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
import { store, mutations } from "../Extend/store";

export default {
    data() {
        return {
            isLoading: true,
            isNew: false,
            stateChat: -1,
            userId: this.$page.props.auth.user.id, 
        }
    },
    watch: {
        stateChat: function () {
            if (this.stateChat != -1) {
                if (!this.isNew) {
                    this.getChatsData();
                    mutations.setChatId(this.stateChat);
                }
                else
                {
                    this.onLoading();
                    mutations.setChatTarget(this.stateChat);
                }
            }
        },
        firstChat: function () {
            // console.log(this.modeChat);

            // this.stateChat = this.firstChat;
            this.isNew = !this.isNew;
            mutations.setChatId(this.firstChat);
            mutations.setChat(this.firstChat);
            this.getChats();
            // this.onLoading();

            console.log(this.isNew);
        }
    },
    computed: {
        listChat() { return store.chatList; },
        firstChat() { return store.chatFirst; },
    },
    created() {
        this.getChats();
    },
    mounted() {},
    methods: {
        onLoading() {
            this.isLoading = true;
            setTimeout(() => this.isLoading = false, 1500);
        },
        getChats() {
            mutations.getChatList(this.userId);
        },
        getChatsData() {
            this.onLoading();
            mutations.setChat(this.stateChat);
        },

    }
}
</script>