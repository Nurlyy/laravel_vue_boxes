<template>
    <div class="conteaner-page-404">
      <p class="p-404">404</p>
      <h1>Страница не найдена</h1>
      <p class="text">Похоже, запрашиваемая Вами страница не найдена.</p>
      <p>
        <a href="/">Вернуться на главную страницу</a>
      </p>
      
    </div>
  </template>
  
  <script>
  export default {
    name: '404'
  }
  </script>
  
  <style scoped lang="scss">
  .conteaner-page-404 {
    text-align: center;
    .p-404 {
      text-align: center;
      font-size: calc(1em + 10vw);
      color:#686868;
      font-family: Roboto;
      font-weight:200;
      padding: 0 !important;
      margin: 20vh 0 0 0 !important;
    }
    h1 {
      text-align: center;
      font-size: 34px;
      color:#fff;
      font-family: Roboto;
      font-weight:200;
      margin: 0 auto !important;
      max-width: 400px;
      width:auto;
      padding: 0 20px;
      box-sizing:border-box;
    }
    .text {
      text-align: center;
      font-size: 16px;
      color:#bbbbbb;
      font-family: Roboto;
      font-weight:300;
      margin: 10px auto 0 !important;
      max-width: 300px;
      width:auto;
      padding: 0 20px;
      box-sizing:border-box;
    }
    a {
      margin:40px auto 0 !important;
      display: block;
      position: relative;
      text-decoration: none;
      background-color: #febc67;
      width:fit-content;
      height:32px;
      border-radius: 8px;
      font-family: Roboto;
      font-weight:400;
      font-size: 14px;
      padding: 8px 12px;
      color:#000;
      box-sizing:border-box;
      border:0;
      outline: none;
      cursor: pointer;
      transition: .3s;
    }
  }
  </style>