<template>
    <h1>Контактные данные</h1>
    <CForm @submit.prevent="submitForm">
        <div style="width: 50%">
            <div class="mb-3">
                <CFormLabel for="email">Email</CFormLabel>
                <CFormInput
                    v-model="email"
                    :value="email"
                    type="text"
                    id="email"
                    placeholder="name@example.com"
                />
            </div>
            <div class="mb-3">
                <CFormLabel for="phone_number">Номер телефона</CFormLabel>
                <CFormInput
                    v-model="phone_number"
                    :value="phone_number"
                    type="text"
                    id="phone_number"
                    placeholder="87477477447"
                />
            </div>
            <div class="mb-3">
                <CFormLabel for="address">Адресс</CFormLabel>
                <CFormInput
                    v-model="address"
                    :value="address"
                    type="text"
                    id="address"
                    placeholder=""
                />
            </div>
            <button class="btn btn-primary">
                <CIcon icon="cil-save" size="sm" /> Сохранить
            </button>
        </div>
    </CForm>
</template>

<script>
export default {
    name: "Contacts",
    data() {
        return {
            email: "",
            phone_number: "",
            address: "",
        };
    },
    mounted() {
        axios.post("/api/get-contacts", {}).then((response) => {
            console.log(response.data);
            this.email = response.data.contacts.email;
            this.phone_number = response.data.contacts.phone_number;
            this.address = response.data.contacts.address;
        });
    },
    methods: {
        submitForm() {
            axios
                .post("/api/save-contacts", {
                    email: this.email,
                    phone_number: this.phone_number,
                    address: this.address,
                })
                .then(function (response) {
                    console.log(response.data);
                });
            // alert('saved');
        },
        updateValues() {},
    },
};
</script>

<style></style>
