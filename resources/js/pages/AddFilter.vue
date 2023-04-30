<template>
    <h1 v-if="id==null">Добавить фильтр</h1>
    <h1 v-if="id!=null">Изменить фильтр</h1>
    <CForm @submit.prevent="submitForm()">
        <div class="mb-3">
            <CFormLabel for="name">Название</CFormLabel>
            <CFormInput
                type="text"
                v-model="name"
                :value="name"
                id="name"
                placeholder="NAME"
            />
        </div>

        <button class="btn btn-primary mb-5">
            <CIcon icon="cil-save" size="sm" /> Сохранить
        </button>
    </CForm>
</template>

<script>
import router from "@/router/index.js";
export default {
    name: "AddFilter",
    data() {
        return {
            name: "",
            id: null,
        };
    },
    methods: {
        submitForm() {
            console.log(this.id);
            if (!this.id) {
                axios
                    .post("/api/add-filter", { name: this.name })
                    .then(function (response) {
                        // alert('Saved');
                        // console.log(response);
                        router.push({ name: "Filters" });
                    });
            } else {
                axios
                    .post("/api/update-filter", {
                        id: this.id,
                        name: this.name,
                    })
                    .then((response) => {
                        setTimeout(() => {
                            router.push({ name: "Filters" });
                        }, 500);
                    });
            }
            // alert("saved");
        },
    },
    created() {
        const id = this.$route.params.id;
        if (id) {
            this.id = id;
            axios.post("/api/get-filter-admin", { id: id }).then((response) => {
                // this.page = response.data.page;
                // console.log(reponse.data);
                this.name = response.data.filter.name;
                this.id = response.data.filter.id;
            });
        }

        // Fetch page data from database using slug
        // Set page data to this.page
    },
};
</script>

<style></style>
