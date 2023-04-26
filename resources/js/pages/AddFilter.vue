<template>
    <h1>Add Filter</h1>
    <CForm>
        <div class="mb-3">
            <CFormLabel for="name">Name</CFormLabel>
            <CFormInput type="text" v-model="name" :value='name' id="name" placeholder="NAME" />
        </div>

        <button class="btn btn-primary mb-5">Save</button>
    </CForm>
</template>

<script>
import router from '@/router/index.js';
export default {
    name: "AddFilter",
    data() {
        return {
            name: "",
        };
    },
    methods: {
        submitForm() {
            axios
                .post("/api/add-filter", { name: this.name })
                .then(function (response) {
                    // alert('Saved');
                    // console.log(response);
                    router.push({name: "Filters"});
                });
            // alert("saved");
        },
    },
};
</script>

<style></style>
