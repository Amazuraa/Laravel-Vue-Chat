<template>
    <div class="w-full">
        <!-- header -->
        <div>
            <div class="relative flex items-center p-3 border-b border-gray-300">
                <img class="object-cover w-10 h-10 rounded-full"
                     :src="targetChat.picture" 
                     alt="username" />
                <span class="block ml-4 font-bold text-gray-600">
                    {{ targetChat.name }}
                </span>
                <span class="absolute w-3 h-3 bg-green-600 rounded-full left-10 top-3"></span>
            </div>
        </div>

        <!-- chats data goes here -->
        <div class="relative w-full bg-[#f6f1ff7a] p-6 overflow-y-auto h-[30rem]">
        <!-- <ul class="space-y-2">
            <li class="flex" v-for="(j, i) in chatData" :key="i" 
                v-bind:class="(j.user != userId) ? 'justify-start':'justify-end'">
            <div class="relative max-w-xl px-4 py-2 rounded shadow"
                 v-bind:class="(j.user != userId) 
                                ? 'text-gray-700 bg-[white]'
                                : 'text-gray-50 bg-indigo-500'">
                <span class="block"
                      v-bind:class="(j.user != userId) ? '':'text-right'">{{ j.data }}</span>
                <span class="block mt-1" style="font-size: 10px;"
                      v-bind:class="(j.user != userId) ? 'text-gray-300':'text-right text-gray-400'">{{ j.date }}</span>
            </div>
            </li>
        </ul> -->
        </div>

        <!-- buttons -->
        <div class="flex gap-3 items-center justify-between w-full p-3 border-t border-gray-300">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
            </button>

            <input type="text" placeholder="Message" v-model="dataChat.data"
                class="block w-full py-2 pl-4 mx-3 bg-gray-100 rounded-full outline-none focus:text-gray-700"
                name="message" required />

            <button v-on:click="setNewChat()">
                <svg class="w-5 h-5 text-gray-500 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { store, mutations } from "../Extend/store";

export default {
    data() {
        return {
            dataChat: {
                user: this.$page.props.auth.user.id,
                data: '',
                date: '',
            },
            formChat: {
                data_chat: [],
                user_chat: [],
            },
            userId: this.$page.props.auth.user.id, 
        }
    },
    computed: {
        targetChat() { return store.userTarget; }
    },
    mounted() {},
    methods: {
        setNewChat() {
            let hour = new Date().getHours();
            let minute = new Date().getMinutes();

            this.dataChat.date = hour + ':' + minute;
            
            this.formChat.data_chat.push(this.dataChat);
            this.formChat.user_chat.push(this.userId, this.targetChat.id);

            this.formChat.data_chat = JSON.stringify(this.formChat.data_chat);
            this.formChat.user_chat = JSON.stringify(this.formChat.user_chat);

            // mutations.setMode();

            // console.log(this.formChat);

            axios
                .post('/api/chat', this.formChat)
                .then(res => {
                    // console.log(res.data.data);
                    mutations.setMode(res.data.data);
                })
        }
    }
}
</script>