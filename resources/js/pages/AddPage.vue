<template>
    <CForm @submit.prevent="submitForm()">
    <div class="mb-3">
        <CFormLabel for="name">название</CFormLabel>
        <CFormInput
            type="text"
            v-model="name"
            :value="name"
            @change="slugify_name()"
            id="name"
            placeholder="NAME"
        />
    </div>
    <div class="mb-3">
        <CFormLabel for="slug">URL</CFormLabel>
        <CFormInput
            id="slug"
            type="text"
            placeholder="SLUG"
            aria-label="Disabled input example"
            v-model="slug"
            :value="slug"
            disabled
        />
    </div>

    <div class="mb-3">
        <CFormLabel for="title">Тайтл</CFormLabel>
        <CFormInput
            type="text"
            v-model="title"
            :value="title"
            id="title"
            placeholder="TITLE"
        />
    </div>

    <div class="mb-3">
        <CFormLabel for="header_title">Заголовок страницы</CFormLabel>
        <CFormInput
            type="text"
            v-model="header_title"
            :value="header_title"
            id="header_title"
            placeholder="Заголовок"
        />
    </div>

    <CFormLabel for="title">Тело</CFormLabel>
    <QuillEditor  v-model:value="body" v-model:content="body" contentType="html" theme="snow"/>

    <!-- <div class="mb-3">
            <CFormLabel for="body">Body</CFormLabedl>
            <CFormTextarea id="body" v-model="body" rows="3">{{
                this.body
            }}</CFormTextarea>
        </div> -->

    <div class="mb-3">
        <CFormLabel for="keyword">Ключевые слова</CFormLabel>
        <CFormInput
            type="text"
            v-model="keyword"
            :value="keyword"
            id="keyword"
            placeholder="Keyword"
        />
    </div>

    <div class="mb-3">
        <CFormLabel for="description">Описание</CFormLabel>
        <CFormTextarea
            id="description"
            v-model="description"
            :value="description"
            rows="3"
        ></CFormTextarea>
    </div>

    <div class="mb-3">
        <CFormLabel for="show">Показывать</CFormLabel>
        <CFormCheck style="margin-left: 15px" @change="changeVisibility" :checked='visibility' id="show" />
    </div>

    <button class="btn btn-primary mb-5">Сохранить</button>
    </CForm>
</template>

<script>
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import router from "@/router/index.js";
export default {
    name: "AddPage",
    components: {
        QuillEditor,
    },
    data() {
        return {
            name: "",
            slug: "",
            title: "",
            header_title: "",
            body: "",
            keyword: "",
            description: "",
            visibility: false,
            id: null,
        };
    },
    methods: {
        changeVisibility(){
            this.visibility = !this.visibility;
        },
        slugify_name() {
            this.slug = this.slugify(this.name);
        },
        submitForm() {
            // console.log(this.body);
            const visibility = this.visibility == true ? "1" : "0";
            if (this.id != null) {
                axios.post("/api/update-page", { name: this.name, slug: this.slug, title: this.title, header_title: this.header_title, body: this.body, keyword: this.keyword, description: this.description, visibility: visibility, id: this.id})
                    .then(function (response) {
                        console.log(response.data);
                    });
            } else {
                axios
                    .post("/api/add-page", {
                        name: this.name,
                        slug: this.slug,
                        title: this.title,
                        header_title: this.header_title,
                        body: this.body,
                        keyword: this.keyword,
                        description: this.description,
                        visibility: this.visibility,
                    })
                    .then(function (response) {
                        console.log(response.data);
                    });
                // alert("saved");
            }
            router.push({name: "Pages"});
        },
        slugify(str) {
            return str
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, "")
                .replace(/[\s_-]+/g, "-")
                .replace(/^-+|-+$/g, "");
        },
    },
    created() {
        const slug = this.$route.params.slug;
        if (slug) {
            axios.post("/api/get-page-admin", { slug: slug }).then((response) => {
                // this.page = response.data.page;
                // console.log(reponse.data);
                this.update = true;
                this.name = response.data.page.name;
                this.slug = response.data.page.slug;
                this.title = response.data.page.title;
                this.header_title = response.data.page.header_title;
                this.body = response.data.page.body;
                this.keyword = response.data.page.keyword;
                this.description = response.data.page.description;
                this.visibility = response.data.page.show == '1' ? true : false;
                this.id = response.data.page.id;
            });
        }

        // Fetch page data from database using slug
        // Set page data to this.page
    },
};
</script>

<style></style>
