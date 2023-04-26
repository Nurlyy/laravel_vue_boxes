<template>
    <h1>Edit Admin User</h1>
    <CForm @submit.prevent="submitForm">
    <div class="mb-3">
      <CFormLabel for="email">Email address</CFormLabel>
      <CFormInput type="text" id="email" placeholder="name@example.com"/>
    </div>
    <div class="mb-3">
      <CFormLabel for="username">Username</CFormLabel>
      <CFormInput type="text" id="username" placeholder="admin"/>
    </div>
    <div class="mb-3">
      <CFormLabel for="password">Password</CFormLabel>
      <CFormInput type="text" id="password" placeholder="PASSWORD"/>
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
    mouned(){
        axios.post('/api/get-user', {}).then(function(response){
            this.email = response.data.email;
            this.username = response.data.username;
            this.password = response.data.password;
        });
    },
    methods: {
      submitForm(){
        axios.post('/api/save-user', {email:this.email, username:this.username, password:this.password}).then(function(response){
            console.log(response.data);
        })
        //   alert('saved');
      }
    }
  };
  </script>
  
  <style></style>
  