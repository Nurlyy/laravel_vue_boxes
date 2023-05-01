<template>
    <Header ref="header" />
    <div class="container-pages-wrapper">
        <div class="container-pages">
            <h1>
                <h1>{{ page.title }}</h1>
            </h1>
            <span class="dividing-line"></span>
            <iframe v-if='isContactsPage' src="https://yandex.ru/map-widget/v1/?um=constructor%3Af5ad9cf579aac300dd059222ab0ee24786597344517fc8d560c2ea958a0a613b&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe>
            <!-- <span class="dividing-line"></span> -->
            <div class="container-body-pages">
                <div v-html="page.body"></div>
            </div>
        </div>
    </div>
    <Footer />
</template>

<script>
import Footer from './Footer.vue';
import Header from "./Header.vue";
export default {
    name: "Pages",
    components: {
        Header,
        Footer,
    },
    data() {
        return {
            page: {},
            isContactsPage: false,
        };
    },
    created() {
        const slug = this.$route.params.slug;
        axios.post("/api/get-page", { slug: slug }).then((response) => {
            this.page = response.data.page;
            document.title = this.page.header_title;
            console.log(response.data);
        });
        if (window.location.href.indexOf("contact") > -1) {
            console.log('contact')
            this.isContactsPage = true;
        }
        // Fetch page data from database using slug
        // Set page data to this.page
    },
};
</script>

<style scoped lang="scss">
.container-pages-wrapper {
    margin: 0 auto;
    height: auto;
    padding: 0 20px;
    box-sizing: border-box;
    @media (min-width: 1160px) {
        width: 1140px;
    }
    @media (min-width: 1000px) and (max-width: 1160px) {
        width: 980px;
    }
    @media (max-width: 1000px) {
        width: 100%;
        min-width: 370px;
    }
}
.container-pages {
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
