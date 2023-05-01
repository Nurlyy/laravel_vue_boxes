<template>
  <div class="container-navigation-wrapper">
    <nav>
      <p>Меню</p>
      <ul>
        <!-- <li><a href="#">Главная</a></li>
        <li><a @click='showOrder = true;' >Заявка на расчёт</a></li> -->
        <!-- <li><a v-for="page in pages" :key='page.id' :href='"page/"+page.slug'>{{page.name}}</a></li> -->
        <li v-for="page in pages" :key='page.id' ><router-link :to="'/page/' + page.slug">{{ page.title }}</router-link></li>
        <!-- <li><a href="#">Материалы</a></li>
        <li><a href="#">Технологии</a></li>
        <li><a href="#">Контакты</a></li> -->
        <li> <a  href="https://instagram.com/_propako_"><img style="height:50px; margin-top: 15px;" src="../assets/insta.png" /></a> </li>
      </ul>
      <button @click='$emit("close");' class="close"></button>
    </nav> 
  </div>
  <Order v-if="showOrder" @close='closeOrder' />
</template>

<script>
export default {
  name: 'Modal',
  data(){
    return {
        showOrder :false,
        pages: null,
    }
  },
  mounted() {
    axios.post('/api/get-pages').then(response => {
        this.pages = response.data.items;
    })
  },
  methods: {
    closeOrder(){
        this.showOrder = false;
    }
  }
}
</script>

<style lang="scss">
.wrapper-blocked {
  display: block;
  position: fixed !important;
  z-index: 0 !important;
}
</style>

<style scoped lang="scss">
.container-navigation-wrapper {
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
  nav {
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
      padding:17px 0 16px;
      border-bottom:1px solid #e6e6e6;
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
    ul {
      margin-left: 0;
      padding-left: 0;
      li {
        list-style-type: none;
        border-bottom:1px solid #f4f4f4;
        padding:10px;
        a {
          display: block;
          color:#000;
          font-family: Roboto;
          font-weight:300;
          font-size: 17px;
          text-decoration: none;
          transition: .3s;
          &:hover {
            color:#c4c4c4;
          }
        }
        &:last-child {
          border: none !important;
        }
      }
    }
  }
}
</style>