<template>
  <div class="container-button">
    <button @click=' scrollToTop()' class="button-up"></button>
  </div>
</template>

<script>
export default {
  name: 'ButtonUp',
  methods: {
    scrollToTop() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    }
  }
}
</script>

<style scoped lang="scss">
.container-button {
  .button-up {
    position: fixed;
    display: block;
    z-index: 2;
    right:24px;
    bottom:50px;
    width:32px;
    height:32px;
    border:0;
    border-radius: 32px;
    background-color: #fff;
    background-image: url(@/assets/arrow-up.svg);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 24px;
    outline: none;
    -webkit-box-shadow: 0px 0px 20px 17px rgba(0, 0, 0, 0.29);
    -moz-box-shadow: 0px 0px 20px 17px rgba(0, 0, 0, 0.29);
    box-shadow: 0px 0px 20px 17px rgba(0, 0, 0, 0.29);
    cursor: pointer;
  }
}
</style>