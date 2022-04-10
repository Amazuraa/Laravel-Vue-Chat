import Vue from "vue";
import { reactive } from 'vue'
import axios from 'axios';

export const store = reactive({
    chat: [],
    chatId: -1,
    loading: false,
    user: [],
    chatList: [],
    userTarget: [],
    chatFirst: 0,
});

export const mutations = {
    setChat(id) {
        axios
            .get('/api/chat/' + id)
            .then(res => {
                store.chat = res.data.data.data_chat;
                store.user = res.data.data.user_chat;
                // console.log(res.data.data);
            });
    },
    setChatId(id) {
        store.chatId = id;
        store.loading = true;
    },
    getChatList(id) {
        axios
            .get('/api/chatList/' + id)
            .then(res => {
                store.chatList = res.data.data;
                // console.log(res.data.data);
            });
    },
    searchChat(key) {
        axios
            .get('/api/user/' + key)
            .then(res => {
                store.chatList = res.data.data;
                // console.log(res.data.data);
            });
    },
    setChatTarget(id) {
        axios
            .get('/api/user/detail/' + id)
            .then(res => {
                store.userTarget = res.data.data;              
            })
    },
    setMode(id) {
        store.chatFirst = id;
    }
};