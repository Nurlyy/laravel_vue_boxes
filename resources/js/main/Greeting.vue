<template>
  <div class="container-greeting-wrapper">
    <div class="container-greeting">
      <h1>
        Эмоции начинаются с упаковки
      </h1>
      <p class="greeting-text">
        Коробка с логотипом выглядит гораздо привлекательнее, чем просто коробка, даже если мы используем для оклейки самую красивую дизайнерскую бумагу. Брендирование - это не только логотип, но любое изображение, которое будет нанесено на коробку. В некоторых случаях, цвет коробки тоже будет элементом брендирования. Исходя из того, что наша специализация - производство коробок с основой из переплетного картона, мы можем использовать несколько основных технологий нанесения изображения на коробку.
        <a href="#">Подробнее</a>
      </p>
      <div class="container-order-main">
        <button class="btn-order-main">Подать заявку на расчёт упаковки</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Greeting',
}
</script>

<style scoped lang="scss">
.container-greeting-wrapper {
  .container-greeting {
    position: relative;
    position: relative;
    margin:0 auto;
    padding: 80px 0 100px;
    width: 100%;
    h1 {
      font-family: Roboto;
      font-weight:200;
      font-size: 67px;
      color:#fff;
      line-height: 60px;
      width:100%;
      text-align: center;
      box-sizing:border-box;
      padding: 0 !important;
      margin: 0 !important;
      @media (max-width:1160px) {
        font-size: 57px !important;
        line-height: 50px !important;
      }
    }
    .greeting-text {
      max-width: 100%;
      font-family: Roboto;
      font-weight:300;
      font-size: 14px;
      color:#cfcfcf;
      line-height: 17px;
      padding: 0 70px !important;
      text-align: center;
      margin: 20px 0 0 0 !important;
      a {
        background-color: #fff;
        border-radius: 8px;
        padding: 2px 7px;
        text-decoration: none;
        color:#000;
        font-family: Roboto;
        font-weight:400;
        font-size: 11px;
        margin: 0 0 0 4px;
        transition: .3s;
        &:hover {
          background-color: #d8d8d8;
        }
      }
    }
    .container-order-main {
      width:100%;
      height:auto;
      margin: 40px 0 0 0 !important;
      padding: 0 0 0 0 !important;
      text-align: center;
      .btn-order-main {
        border:0;
        outline: none;
        border-radius: 12px;
        padding: 0 50px 0 20px;
        background-image: url(@/assets/order.svg);
        background-repeat: no-repeat;
        background-position: top 7px right 8px;
        background-size: 30px;
        background-color: #febc67;
        height:42px;
        color:#000;
        font-family: Roboto;
        font-weight:500;
        font-size: 14px;
        cursor: pointer;
        &:hover {
          background-color: #fcb04d;
        }
      }
    }
  }
}
</style>