<template>
    <h1>Add Page</h1>
    <CForm @submit.prevent='submitForm()'>
        <div class="mb-3">
            <CFormLabel for="name">Name</CFormLabel>
            <CFormInput
                type="text"
                v-model="name"
                :value='name'
                @change="slugify_name()"
                id="name"
                placeholder="NAME"
            />
        </div>
        <div class="mb-3">
            <CFormLabel for="slug">Slug</CFormLabel>
            <CFormInput
                id="slug"
                type="text"
                placeholder="SLUG"
                aria-label="Disabled input example"
                v-model="slug"
                :value='slug'
                disabled
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="title">Title</CFormLabel>
            <CFormInput
                type="text"
                v-model="title"
                :value='title'
                id="title"
                placeholder="TITLE"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="body">Body</CFormLabel>
            <CFormTextarea id="body" v-model="body" rows="3">{{ this.body }}</CFormTextarea>
        </div>

        <div class="mb-3">
            <CFormLabel for="keyword">Keyword</CFormLabel>
            <CFormInput
                type="text"
                v-model="keyword"
                :value='keyword'
                id="keyword"
                placeholder="Keyword"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="description">Description</CFormLabel>
            <CFormTextarea
                id="description"
                v-model="description"
                :value='description'
                rows="3"
            ></CFormTextarea>
        </div>

        <div class="mb-3">
            <CFormLabel for="show">Visibility</CFormLabel>
            <CFormCheck
                style="margin-left: 15px"
                v-model="visibility"
                id="show"
            />
        </div>

        <button class="btn btn-primary mb-5">Save</button>
    </CForm>
</template>

<script>
export default {
    name: "AddPage",
    data() {
        return {
            name: "",
            slug: "",
            title: "",
            body: "",
            keyword: "",
            description: "",
            visibility: false,
        };
    },
    methods: {
        slugify_name(){
            this.slug = this.slugify(this.name);
        },
        submitForm() {
            axios
                .post("/api/add-page", {
                    name: this.name,
                    slug: this.slug,
                    title: this.title,
                    body: this.body,
                    keyword: this.keyword,
                    description: this.description,
                    visibility: this.visibility,
                })
                .then(function (response) {
                    console.log(response.data);
                });
            // alert("saved");
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
};
</script>

<style></style>
