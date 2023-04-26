<template>
    <div id="app" class="">
      <!-- При открытии модального окна, добавляем класс "blocked" к контейнеру с ID "app". Он блокирует весь контен на сайте при модальном окне -->
      <div class="wrapper">
        <Header />
        <Greeting />
        <Main />
        <ButtonUp />
        <!-- <Pages/> -->
        <Footer />
      </div>
      <!-- <Modal/> -->
      <!-- <Order/> -->
    </div>
  </template>
  
  <script>
  import Header from '../main/Header.vue'
  import Greeting from '../main/Greeting.vue'
  import Main from '../main/Main.vue'
  import Footer from '../main/Footer.vue'
  import Modal from '../main/Modal.vue'
  import Order from '../main/Order.vue'
  import ButtonUp from '../main/ButtonUp.vue'
  import Pages from '../main/Pages.vue'
  import LikePage from '../main/LikePage.vue'

  export default {
    name: 'MainLayout',
    components: {
      Header,
      Greeting,
      Main,
      Footer,
      Modal,
      Order,
      ButtonUp,
      Pages,
      LikePage,
    }
  }
  </script>
      
  <style lang="scss">
  body {
    padding:68px 0 0 0;
    margin:0;
    background-color: #000;
  }
  #app {
    margin:0;
    width:100%;
    min-width:370px;
    .blocked {
      display: block;
      position: fixed !important;
      z-index: 0 !important;
    }
  }
  .wrapper {
    margin:0 auto;
    height:auto;
    padding:0 20px;
    box-sizing:border-box;
    @media (min-width:1160px) {
      width:1140px;
    }
    @media (min-width:1000px) and (max-width:1160px) {
      width:980px;
    }
    @media (max-width:1000px) {
      width:100%;
      min-width:370px;
    }
  }
  </style>
  