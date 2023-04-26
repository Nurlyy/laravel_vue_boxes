<template>
  <div class="container-order-wrapper">
    <div class="container-order">
      <p>Заявка на расчёт упаковки</p>
      <span class="order-header-text">Расскажите, что Вам нужно, это займёт не больше минуты. Так же можете прикрепить фотографии, которым Вы поставили лайк</span>
      <div class="container-two">
        <input type="text" class="inp" placeholder="Ваше имя">
        <input type="text" class="inp" placeholder="Телефон / E-Mail">
      </div>
      <div class="container-one">
        <textarea class="inp txr" placeholder="Опишите Вашу задачу"></textarea>
      </div>
      <div class="container-one">
        <label for="photo" class="label"><input type="checkbox" id="photo" name="photo" checked><span>Прикрепить фотографии к которым Вы поставили лайк?</span></label>
      </div>
      <div class="container-one">
        <button class="btn-order-enter">Отправить заявку</button>
      </div>
      <button class="close"></button>
      
      <!-- Выводим уведомление при успешной отправки -->
      <!-- <div class="container-sending-true">
        Заявка успешно отправлена
      </div> -->
      <!-- ////// -->

    </div> 
  </div>
</template>

<script>
export default {
  name: 'Order'
}
</script>

<style scoped lang="scss">
.container-order-wrapper {
  width:100%;
  height:100%;
  position: fixed;
  z-index: 999;
  top:0;
  left:0;
  right:0;
  bottom:0;
  background-color: rgba(0, 0, 0, 0.65);
  overflow: overlay;
  text-align: center;
  box-sizing:border-box;
  .container-order {
    position: relative;
    max-width: 420px;
    margin:15vh auto;
    background-color: #fff;
    border-radius: 14px;
    padding:0 0 6px 0;
    overflow: hidden;
    p {
      position: relative;
      font-family: Roboto;
      font-weight:500;
      font-size: 15px;
      text-transform: uppercase;
      color:#000;
      padding:5px 0 16px;
      border-bottom:1px solid #e6e6e6;
    }
    .order-header-text {
      display: block;
      width: 100%;
      box-sizing:border-box;
      padding:0 20px 30px;
      font-family: Roboto;
      font-weight:400;
      font-size: 13px;
      color:#757575;
      text-align: center;
    }
    .close {
      position: absolute;
      width:46px;
      height:46px;
      top:5px;
      right: 5px;
      background-color: none;
      background: none;
      background-image: url(@/assets/close.svg);
      background-repeat: no-repeat;
      background-position: center center;
      background-size: 30px;
      cursor: pointer;
      border: 0;
      outline: none;
      -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";
      filter: alpha(opacity=40);
      -moz-opacity: 0.4;
      -khtml-opacity: 0.4;
      opacity: 0.4;
      transition: .3s;
      &:hover {
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        filter: alpha(opacity=100);
        -moz-opacity: 1;
        -khtml-opacity: 1;
        opacity: 1;
      }
    }
    .container-one {
      width:100%;
      display: grid;
      grid-template-columns: 1fr;
      grid-auto-rows: 1fr;
      gap: 14px;
      box-sizing:border-box;
      padding: 0 20px;
      margin-top:14px;
    }
    .container-two {
      width:100%;
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-auto-rows: 1fr;
      gap: 14px;
      box-sizing:border-box;
      padding: 0 20px;
    }
    .label {
      font-family: Roboto;
      font-weight:400;
      font-size: 13px;
      color:#000;
      margin-top:2px;
      input {
        margin:8px 0 0 0;
        float:left;
        -ms-transform: scale(1.4);
        -moz-transform: scale(1.4);
        -webkit-transform: scale(1.4);
        -o-transform: scale(1.4);
        transform: scale(1.4);
      }
      span {
        float:left;
        width:80%;
        text-align: left;
        margin:0 0 0 18px;
      }
    }
    .inp {
      border:1px solid #c7c7c7;
      border-radius: 8px;
      font-family: Roboto;
      font-weight:400;
      font-size: 13px;
      color:#000;
      height:32px;
      width:100%;
      padding: 0 14px;
      margin:0;
      box-sizing:border-box;
      transition: .3s;
      outline: none;
      &:hover, &:focus, &:active {
        border: 1px solid #000 !important;
      }
      &.txr {
        height:80px !important;
        padding: 14px !important;
      }
    }
    .btn-order-enter {
      width: 100%;
      height:33px;
      border-radius: 8px;
      font-family: Roboto;
      font-weight:400;
      font-size: 14px;
      padding: 0 12px;
      color:#000;
      box-sizing:border-box;
      text-align: center;
      border:0;
      outline: none;
      cursor: pointer;
      transition: .3s;
      background-color: #febc67;
      margin:0 0 15px 0;
      &:hover {
        background-color: #fcb04d;
      }
    }
    .container-sending-true {
      position: absolute;
      top:50px;
      left:0;
      width:100%;
      height:100%;
      background-color: #fff;
      text-align: center;
      box-sizing:border-box;
      padding:280px 40px;
      font-family: Roboto;
      font-weight:400;
      font-size: 15px;
      background-image: url(@/assets/send-ok.svg);
      background-repeat: no-repeat;
      background-position: top 95px center;
      background-size: 100px;
    }
  }
}
</style>