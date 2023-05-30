<template>
    <div @scroll='console.log("Index scrolled")'>
        <Header ref="header" />
        <Greeting />
        <Main :category_id='id' @likesCount="getLikesCount()" />
        <!-- <UnderGallery /> -->
    </div>
</template>

<script>
import Greeting from "../main/Greeting.vue";
import Main from "../main/Main.vue";
import Header from "./Header.vue";
import UnderGallery from './UnderGallery.vue';

export default {
    name: "Index",
    components: {
        Header,
        Greeting,
        Main,UnderGallery,
    },
    data() {
        return {
            likes_count: 0,
            id: null,
        };
    },
    created(){
        this.id = this.$route.params.id;
        console.log('cat id from index: ' + this.id);
        axios.post('/api/get-main-page').then(response =>{
            const description = response.data.mainPage.description;
            document.querySelector('meta[name="description"]').setAttribute('content', description);
        })
    },
    methods: {
        getLikesCount() {
            console.log(this.id);
            this.likes_count = localStorage.getItem("likedImages")
                ? JSON.parse(localStorage.getItem("likedImages")).length
                : 0;
            // console.log(this.likes_count);
            this.$refs.header.likes_count = this.likes_count;
        },

    },
   
};
</script>

<style></style>
