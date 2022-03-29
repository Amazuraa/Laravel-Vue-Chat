import Vue from "vue";
import { reactive } from 'vue'
import axios from 'axios';

export const store = reactive({
    chat: [],
    chatId: -1,
    user: [],
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
    }
};