<template>
  <div class="container-pages-wrapper">
    <h1>
      Из чего мы делаем наши коробки?
    </h1>
    <span class="dividing-line"></span>
    <div class="container-body-pages">
      Тело страницы, который заполняем из админки редактора
    </div>
  </div>
</template>

<script>
export default {
  name: 'Greeting',
}
</script>

<style scoped lang="scss">
.container-pages-wrapper {
  width:100%;
  background-color: #fff;
  border-radius: 14px;
  box-sizing:border-box;
  padding: 50px !important;
  text-align: left;
  @media (max-width: 570px) { 
    padding: 30px !important;
  }
  h1 {
    font-family: Roboto;
    font-weight:200;
    font-size: 46px;
    line-height: 54px;
    color:#000;
    width:100%;
    margin:0 !important;
    padding: 0 0 25px 0 !important;
    @media (min-width: 420px) and (max-width: 570px) { 
      font-size: 36px !important;
      line-height: 44px !important;
    }
    @media (max-width: 420px) { 
      font-size: 29px !important;
      line-height: 36px !important;
    }
  }
  .dividing-line {
    display: block;
    width:250px;
    border:0;
    background-color: #000;
    height:3px;
    margin:0 0 40px 0;
    @media (max-width: 570px) { 
      height:2px !important;
      width:135px;
    }
  }
  .container-body-pages {
    width:100%;
    height:auto;
  }
}
</style>