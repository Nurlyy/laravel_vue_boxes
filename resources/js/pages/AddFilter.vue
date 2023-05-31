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
            isLoading: false,
        };
    },
    methods: {
        submitForm() {
            this.isLoading = true;
            console.log(this.id);
            if (!this.id) {
                axios
                    .post("/api/add-filter", { name: this.name })
                    .then((response) => {
                        // alert('Saved');
                        // console.log(response);
                        router.push({ name: "Filters" });
                        this.isLoading = false;
                    });
            } else {
                axios
                    .post("/api/update-filter", {
                        id: this.id,
                        name: this.name,
                    })
                    .then((response) => {
                        this.isLoading = false;
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