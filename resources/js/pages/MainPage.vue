<template>
    <h1>Главная страница</h1>
    <CForm @submit.prevent="submitForm">
    <div class="mb-3">
      <CFormLabel for="header">Заголовок страницы</CFormLabel>
      <CFormInput v-model="header" :value='header'  type="text" id="header" />
    </div>
    <div class="mb-3">
      <CFormLabel for="title">Тайтл</CFormLabel>
      <CFormInput  v-model="title" :value='title' type="text" id="title" />
    </div>
    <div class="mb-3">
      <CFormLabel for="body">Контент</CFormLabel>
      <CFormTextarea v-model="body" :value='body'  type="text" id="body" />
    </div>
    <button class="btn btn-primary "><CIcon icon="cil-save" size="sm"/> Сохранить</button>
  </CForm>
  </template>
  
  <script>
  export default {
    name: "Contacts",
    data(){
      return {
          header: '',
          title: '',
          body: '',
      }
    },
    mounted(){
      axios.post('/api/get-main-page', {}).then(response => {
          console.log(response.data);
          this.header = response.data.mainPage.header;
          this.title = response.data.mainPage.title;
          this.body = response.data.mainPage.body;
      });
    },
    methods: {
      submitForm(){
          axios.post('/api/save-main-page', {header: this.header, title: this.title, body: this.body}).then(function(response){
              console.log(response.data);
          })
          // alert('saved');
      },
      updateValues(){
  
      }
    }
  };
  </script>
  
  <style></style>
  