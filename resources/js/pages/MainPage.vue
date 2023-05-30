<template>
    <CAlert :visible="alert_state" color="success">Изменения сохранены</CAlert>
    <h1>Главная страница</h1>
    <CForm @submit.prevent="submitForm">
        <div class="mb-3">
            <CFormLabel for="header">Заголовок страницы</CFormLabel>
            <CFormInput
                v-model="header"
                :value="header"
                type="text"
                id="header"
            />
        </div>
        <div class="mb-3">
            <CFormLabel for="title">Тайтл</CFormLabel>
            <CFormInput v-model="title" :value="title" type="text" id="title" />
        </div>
        <div class="mb-3">
            <CFormLabel for="body">Контент</CFormLabel>
            <CFormTextarea v-model="body" :value="body" type="text" id="body" />
        </div>
        <div class="mb-3">
            <CFormLabel for="foot_text">Текст под галереей</CFormLabel>
            <CFormTextarea
                v-model="foot_text"
                :value="foot_text"
                type="text"
                id="foot_text"
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
        <button class="btn btn-primary">
            <CIcon icon="cil-save" size="sm" /> Сохранить
        </button>
    </CForm>
</template>

<script>
export default {
    name: "Contacts",
    data() {
        return {
            header: "",
            title: "",
            body: "",
            foot_text: "",
            description: "",
            alert_state: false,
        };
    },
    mounted() {
        axios.post("/api/get-main-page", {}).then((response) => {
            console.log(response.data);
            this.header = response.data.mainPage.header;
            this.title = response.data.mainPage.title;
            this.body = response.data.mainPage.body;
            this.foot_text = response.data.mainPage.foot_text;
            this.description = response.data.mainPage.description;
        });
    },
    methods: {
        submitForm() {
            axios
                .post("/api/save-main-page", {
                    header: this.header,
                    title: this.title,
                    body: this.body,
                    foot_text: this.foot_text,
                    description: this.description,
                })
                .then((response) => {
                    console.log(response.data);
                    this.alert_state = true;
                    setTimeout(() => {
                        this.alert_state = false;
                    }, 1500);
                });
            // alert('saved');
        },
        updateValues() {},
    },
};
</script>

<style></style>
