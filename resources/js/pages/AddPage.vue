<template>
    <h1>Add Page</h1>
    <CForm>
        <div class="mb-3">
            <CFormLabel for="name">Name</CFormLabel>
            <CFormInput
                type="text"
                v-bind="name"
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
                v-bind="slug"
                disabled
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="title">Title</CFormLabel>
            <CFormInput
                type="text"
                v-bind="title"
                id="title"
                placeholder="TITLE"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="body">Body</CFormLabel>
            <CFormTextarea id="body" v-bind="body" rows="3"></CFormTextarea>
        </div>

        <div class="mb-3">
            <CFormLabel for="keyword">Keyword</CFormLabel>
            <CFormInput
                type="text"
                v-bind="keyword"
                id="keyword"
                placeholder="Keyword"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="description">Description</CFormLabel>
            <CFormTextarea
                id="description"
                v-bind="description"
                rows="3"
            ></CFormTextarea>
        </div>

        <div class="mb-3">
            <CFormLabel for="show">Visibility</CFormLabel>
            <CFormCheck
                style="margin-left: 15px"
                v-bind="visibility"
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
            alert("saved");
        },
    },
};
</script>

<style></style>
