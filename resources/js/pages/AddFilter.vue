<template>
    <h1>Добавить фильтр</h1>
    <CForm @submit.prevent='submitForm()'>
        <div class="mb-3">
            <CFormLabel for="name">Название</CFormLabel>
            <CFormInput type="text" v-model="name" :value='name' id="name" placeholder="NAME" />
        </div>

        <button class="btn btn-primary mb-5">Сохранить</button>
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
