<template>
  <div class="container-footer-wrapper">
    <div class="contact-footer">
      <div>
        <span class="tell">+7 812 209 70 45</span>
        <span class="e-mail">public@propako.ru</span>
      </div>
      <div>
      <span class="address">Россия, Санкт-Петербург, Петровская коса, д.1, к.1, БЦ Петровский</span>

      </div>
    </div>
    <div class="footer">
      <span>© 2023. Все права зашищены.</span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Footer',
}
</script>

<style scoped lang="scss">
.container-footer-wrapper {
  .contact-footer {
    width:100%;
    display: grid;
    grid-template-columns: max-content 1fr;
    grid-template-rows: auto;
    gap:0 30px;
    margin-top:20px;
    @media (max-width:720px) { 
      grid-template-columns: 1fr !important;
    }
    span {
      display: block;
      color:#fff;
      font-family: Roboto;
      font-weight:300;
      font-size: 16px;
      line-height: 21px;
      padding: 0 !important;
      margin:0 !important;
      @media (max-width:860px) { 
        font-size: 13px !important;
      }
      &.address {
        text-align: right !important;
        color:#a1a1a1 !important;
        @media (max-width:720px) { 
          text-align: left !important;
        }
      }
      &.tell {
        margin-right:30px !important;
        float:left;
      }
      &.e-mail {
        float:left;
      }
    }
  }
  .footer {
    width:100%;
    color:#a1a1a1;
    font-family: Roboto;
    font-weight:300;
    font-size: 12px;
    padding:12px 0;
  }
}
</style>