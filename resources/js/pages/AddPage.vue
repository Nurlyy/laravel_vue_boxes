<template>
    <div v-if="isLoading" class="loading-overlay">
        <CButton disabled>
            <CSpinner
                component="span"
                size="xsl"
                color="light"
                aria-hidden="true"
            />
        </CButton>
    </div>
    <h1 v-if="id == null">Добавить Страницу</h1>
    <h1 v-if="id != null">Изменить Страницу</h1>
    <CForm @submit.prevent="submitForm()">
        <div class="mb-3">
            <CFormLabel for="name"
                >Придумайте URL (латинскими буквами)</CFormLabel
            >
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
            <CFormLabel for="header_title">SEO - title</CFormLabel>
            <CFormInput
                type="text"
                v-model="header_title"
                :value="header_title"
                id="header_title"
                placeholder="Заголовок"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="title"
                >Заголовок страницы (Отображается на странице)</CFormLabel
            >
            <CFormInput
                type="text"
                v-model="title"
                :value="title"
                id="title"
                placeholder="TITLE"
            />
        </div>

        <CFormLabel for="title">Текст страницы</CFormLabel>
        <mavon-editor
            v-model="body"
            :language="'ru'"
            :html="true"
            @htmlCode="htmlCode"
            @save="change"
            @imgAdd="imgUpload"
            ref="mavoneditor"
            class='mb-3'
        />

        <div class="mb-3">
            <CFormLabel for="keyword"
                >SEO - Ключевые слова (Укажите через запятую)</CFormLabel
            >
            <CFormInput
                type="text"
                v-model="keyword"
                :value="keyword"
                id="keyword"
                placeholder="Keyword"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="description"
                >SEO - Description (Описание)</CFormLabel
            >
            <CFormTextarea
                id="description"
                v-model="description"
                :value="description"
                rows="3"
            ></CFormTextarea>
        </div>

        <div class="mb-3">
            <CFormLabel for="show"
                >Показывать ссылку на страницу в меню?
            </CFormLabel>
            <CFormCheck
                style="margin-left: 15px"
                @change="changeVisibility"
                :checked="visibility"
                id="show"
            />
        </div>

        <button class="btn btn-primary mb-5">
            <CIcon icon="cil-save" size="sm" /> Сохранить
        </button>
    </CForm>
</template>

<script>
// import { QuillEditor } from "@vueup/vue-quill";
// import "@vueup/vue-quill/dist/vue-quill.snow.css";
import router from "@/router/index.js";
export default {
    name: "AddPage",
    components: {
        // QuillEditor,
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
            isLoading: false,
        };
    },
    methods: {
        change(v, html) {
            console.log(v);
            console.log(html);
            this.body = html;
        },
        htmlCode(status, value) {
            this.htmlValueFromEditor = value;
        },
        imgUpload(pos, $file, $vm) {
            var formdata = new FormData();
            formdata.append("image", $file);
            // console.log(pos);
            // ajax上传
            axios({
                url: "/api/upload-image",
                method: "post",
                data: formdata,
                headers: { "Content-Type": "multipart/form-data" },
            })
                .then((res) => {
                    console.log(res);
                    const { data } = res;
                    this.$refs.mavoneditor.$img2Url(pos, data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        changeVisibility() {
            this.visibility = !this.visibility;
        },
        slugify_name() {
            this.slug = this.slugify(this.name);
        },
        submitForm() {
            // console.log(this.body);
            this.isLoading = true;
            const visibility = this.visibility == true ? "1" : "0";
            if (this.id != null) {
                axios
                    .post("/api/update-page", {
                        name: this.name,
                        slug: this.slug,
                        title: this.title,
                        header_title: this.header_title,
                        body: this.body,
                        keyword: this.keyword,
                        description: this.description,
                        visibility: visibility,
                        id: this.id,
                    })
                    .then((response) => {
                        console.log(response.data);
                        this.isLoading = false;
                        router.push({ name: "Pages" });
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
                    .then((response) => {
                        console.log(response.data);
                        this.isLoading = false;
                        router.push({ name: "Pages" });
                    });
                // alert("saved");
            }
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
            axios
                .post("/api/get-page-admin", { slug: slug })
                .then((response) => {
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
                    this.visibility =
                        response.data.page.show == "1" ? true : false;
                    this.id = response.data.page.id;
                });
        }

        // Fetch page data from database using slug
        // Set page data to this.page
    },
};
</script>

<style scoped>
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}
</style>
