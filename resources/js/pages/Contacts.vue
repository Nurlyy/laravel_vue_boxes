<template>
  <h1>Contacts</h1>
  <CForm @submit.prevent="submitForm">
  <div class="mb-3">
    <CFormLabel for="email">Email address</CFormLabel>
    <CFormInput v-bind="email"  type="text" id="email" placeholder="name@example.com"/>
  </div>
  <div class="mb-3">
    <CFormLabel for="phone_number">Phone Number</CFormLabel>
    <CFormInput  v-bind="phone_number" type="text" id="phone_number" placeholder="87477477447"/>
  </div>
  <div class="mb-3">
    <CFormLabel for="address">Address</CFormLabel>
    <CFormInput v-bind="address"  type="text" id="address" placeholder=""/>
  </div>
  <button class="btn btn-primary "> Save</button>
</CForm>
</template>

<script>
export default {
  name: "Contacts",
  data(){
    return {
        email: '',
        phone_number: '',
        address: '',
    }
  },
  mounted(){
    axios.post('/api/get-contacts', {}).then(function(response){
        this.email = response.data.email;
        this.phone_number = response.data.phone_number;
        this.address = response.data.address;
    })
  },
  methods: {
    submitForm(){
        axios.post('/api/save-contacts', {email: this.email, phone_number: this.phone_number, address: this.address}).then(function(response){
            console.log(response.data);
        })
        alert('saved');
    }
  }
};
</script>

<style></style>
