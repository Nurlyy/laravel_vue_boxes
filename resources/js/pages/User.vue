<template>
    <h1>Edit Admin User</h1>
    <CForm @submit.prevent="submitForm">
    <div class="mb-3">
      <CFormLabel for="email">Email address</CFormLabel>
      <CFormInput v-model="email" :value='email' type="text" id="email" placeholder="name@example.com"/>
    </div>
    <div class="mb-3">
      <CFormLabel for="username">Username</CFormLabel>
      <CFormInput v-model='username' :value='username' type="text" id="username" placeholder="admin"/>
    </div>
    <div class="mb-3">
      <CFormLabel for="password">Password</CFormLabel>
      <CFormInput v-model="password" :value="password" type="text" id="password" placeholder="Enter new password"/>
    </div>
    <button class="btn btn-primary "> Save</button>
  </CForm>
  </template>
  
  <script>
  export default {
    name: "User",
    data(){
        return {
            email:'',
            username:'',
            password:'',
        }
    },
    mounted(){
        axios.post('/api/get-admin', {}).then(response => {
            this.email = response.data.email;
            this.username = response.data.username;
            // console.log(response.data);
            // this.password = response.data.password;
        });
    },
    methods: {
      submitForm(){
        axios.post('/api/save-admin', {email:this.email, username:this.username, password:this.password}).then(function(response){
            console.log(response.data);
        })
        //   alert('saved');
      }
    }
  };
  </script>
  
  <style></style>
  