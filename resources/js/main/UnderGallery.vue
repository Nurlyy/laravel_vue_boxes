<template>
    <div class="container-greeting-wrapper">
        <div class="container-greeting">
            <p v-html="foot_text" class="greeting-text">
              
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: "UnderGallery",
    data() {
        return {
            foot_text:'',
        };
    },
    mounted(){
        axios.post('/api/get-main-page').then(response =>{
            this.foot_text = response.data.mainPage.foot_text;
        })
    }
};
</script>

<style scoped lang="scss">
.container-greeting-wrapper {
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
  .container-greeting {
    position: relative;
    position: relative;
    margin:0 auto;
    padding: 60px 0 60px;
    width: 100%;
    @media (max-width:500px) {
      padding: 20px 0 40px !important;
    }
    h1 {
      font-family: 'Roboto', sans-serif;
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
      font-family: 'Roboto', sans-serif;
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
        font-family: 'Roboto', sans-serif;
        font-weight:400;
        font-size: 11px;
        margin: 0 0 0 4px;
        transition: .3s;
        &:hover {
          background-color: #d8d8d8;
        }
      }
      @media (max-width:500px) {
        padding: 0 !important;
      }
    }
    .container-order-main {
      width:100%;
      height:auto;
      margin: 60px 0 0 0 !important;
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
        font-family: 'Roboto', sans-serif;
        font-weight:500;
        font-size: 14px;
        cursor: pointer;
        &:hover {
          background-color: #fcb04d;
        }
      }
    }
    @media (max-width: 500px){
        .container-order-main {
            display:none !important;
        }
    }
  }
}
</style>