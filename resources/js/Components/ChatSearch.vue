
<template>
    <div class="mx-3 my-3">
        <div class="relative text-gray-600">
            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     viewBox="0 0 24 24" class="w-6 h-6 text-gray-300">
                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input type="search" class="block w-full py-2 pl-10 bg-gray-100 rounded outline-none" name="search"
                   placeholder="Search" required 
                   v-model="keyWord"
                   v-on:keyup="onSearchChange()"/>
        </div>
    </div>
</template>

<script>
import { mutations } from "../Extend/store";

export default {
    data() {
        return {
            keyWord: "",
            userId: this.$page.props.auth.user.id,
        }
    },
    mounted() {},
    methods: {
        onSearchChange() {
            if (this.keyWord != '')
                mutations.searchChat(this.keyWord);
            else
                mutations.getChatList(this.userId);
        }
    }
}
</script>
