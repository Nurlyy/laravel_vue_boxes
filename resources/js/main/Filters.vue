<template>
    <div class="container-navigation-wrapper">
      <nav>
        <p>Фильтры</p>
        <ul>
          <li  v-for="filter in filters" :key='filter.id' @click='go_to_category(filter.id)' >
            <!-- <router-link :to="'/category/' + filter.id">{{ filter.name }}</router-link> -->
            <a :href='"/category/"+filter.id'>{{ filter.name }}</a>
        </li>
          <!-- <li><a href="#">Материалы</a></li>
          <li><a href="#">Технологии</a></li>
          <li><a href="#">Контакты</a></li> -->
        </ul>
        <button @click='$emit("close");' class="close"></button>
      </nav> 
    </div>
  </template>
  
  <script>
  export default {
    name: 'Filters',
    data(){
      return {
            showFilters:false,
            filters: null,
      }
    },
    mounted() {
      axios.post('/api/get-filters').then(response => {
          this.filters = response.data.filters;
      })
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