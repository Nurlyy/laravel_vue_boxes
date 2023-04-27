<template>
    <Header ref="header" />
    <div class="container-pages-wrapper">
        <h1>
            <h1>{{ page.title }}</h1>
        </h1>
        <span class="dividing-line"></span>
        <div class="container-body-pages">
            <div v-html="page.body"></div>
        </div>
    </div>
</template>

<script>
import Header from './Header.vue';

export default {
    name: "Pages",
    components: {
        Header
    },
    data() {
        return {
            page: {},
        };
    },
    created() {
        const slug = this.$route.params.slug;
        axios.post('/api/get-page', {slug: slug}).then(response => {
            this.page = response.data.page;
            console.log(reponse.data);
        })
        // Fetch page data from database using slug
        // Set page data to this.page
    },
};
</script>

<style scoped lang="scss">
.container-pages-wrapper {
    width: 100%;
    background-color: #fff;
    border-radius: 14px;
    box-sizing: border-box;
    padding: 50px !important;
    text-align: left;
    @media (max-width: 570px) {
        padding: 30px !important;
    }
    h1 {
        font-family: Roboto;
        font-weight: 200;
        font-size: 46px;
        line-height: 54px;
        color: #000;
        width: 100%;
        margin: 0 !important;
        padding: 0 0 25px 0 !important;
        @media (min-width: 420px) and (max-width: 570px) {
            font-size: 36px !important;
            line-height: 44px !important;
        }
        @media (max-width: 420px) {
            font-size: 29px !important;
            line-height: 36px !important;
        }
    }
    .dividing-line {
        display: block;
        width: 250px;
        border: 0;
        background-color: #000;
        height: 3px;
        margin: 0 0 40px 0;
        @media (max-width: 570px) {
            height: 2px !important;
            width: 135px;
        }
    }
    .container-body-pages {
        width: 100%;
        height: auto;
    }
}
</style>
