<template>
    <Header ref="header" />
    <div class="wrapper-like-page">
        <div>
            <div>
                <h1>Фотографии которые Вам понравились</h1>
                <p class="page-like-text">
                    Ниже представлены фотографии, которые Вам понравились, 
                    которым Вы поставили "Лайк". Вы можете отправить нам заявку, 
                    приложив эти фотографии. Так мы лучше поймём, то что Вам нужно. 
                    Просто заполните заявку. И поставьте галочку - 
                    Прикрепить фотографии, которые Вам понравились.
                </p>
                <div class="container-order-main">
                    <button
                        @click="showOrder = !showOrder"
                        class="btn-order-main"
                    >
                        Подать заявку на расчёт упаковки
                    </button>
                </div>
            </div>
            <div class="pin_container" id='gallery_id'>
                <!-- <div v-for="(image, index) in images" :key="index" class="card">
                    <img :src="image.path" alt="" />
                    <a @click="unlikeImage(image.id, index)"></a>
                    <button class="btn-like-card active"></button>
                    <span class="number-card">#{{ image.id }}</span>
                </div> -->
                <div
                    v-for="image, index in images"
                    :key="image.id"
                    class="card"
                    :id="image.id + '_image'"
                >
                    <img :src="image.path" alt="" />
                    <a
                        @click='imageClicked(image.path)'
                        :href="image.path"
                        :data-pswp-width="maxWidth"
                        :data-pswp-height="maxHeight"
                        :alt='image.description'
                        target="_blank"
                        rel="noreferrer"
                    ></a>
                    <button
                        :id="'like_button_' + image.id"
                        @click="unlikeImage(image.id, index)"
                        class="btn-like-card active"
                    ></button>
                    <span class="number-card">#{{ image.id }}</span>
                </div>
            </div>
        </div>
    </div>
    <Order v-if="showOrder" @close="closeOrder" />
</template>

<script>
import Header from "./Header.vue";
import Order from "./Order.vue";

import PhotoSwipeLightbox from "photoswipe/lightbox";
import "photoswipe/style.css";

export default {
    name: "LikePage",
    components: {
        Header,
        Order,
    },
    data() {
        return {
            images: [],
            likedImages: [],
            showOrder: false,
            maxWidth: 0,
            maxHeight: 0,
        };
    },
    mounted() {
        if (!this.lightbox) {
            this.lightbox = new PhotoSwipeLightbox({
                gallery: "#gallery_id",
                children: "a",
                pswpModule: () => import("photoswipe"),
            });
            this.lightbox.init();
        }
        this.likedImages =
            localStorage.getItem("likedImages") != null
                ? JSON.parse(localStorage.getItem("likedImages"))
                : [];
        console.log({ images_ids: JSON.stringify(this.likedImages) });
        axios
            .post("/api/get-likes", {
                images_ids: JSON.stringify(this.likedImages),
            })
            .then((response) => {
                this.images = response.data.images;
                console.log(response.data);
            });
    },
    methods: {
        imageClicked(path){
            const img = new Image();
            img.src = path;
            this.maxWidth = img.width;
            this.maxHeight = img.height;
        },
        unlikeImage(id, index) {
            this.images.splice(index, 1);
            this.likedImages.splice(this.likedImages.indexOf(id), 1);
            // console.log(JSON.stringify(this.likedImages));
            localStorage.setItem(
                "likedImages",
                JSON.stringify(this.likedImages)
            );
            this.$refs.header.likes_count = this.likedImages.length;
        },
        closeOrder() {
            this.showOrder = false;
        },
    },
    unmounted() {
        if (this.lightbox) {
            this.lightbox.destroy();
            this.lightbox = null;
        }
    },
};
</script>

<style scoped lang="scss">
.wrapper-like-page {
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
h1 {
  font-family: Roboto;
  font-weight:200;
  font-size: 37px;
  color:#fff;
  line-height: 42px;
  width:100%;
  text-align: left;
  box-sizing:border-box;
  padding: 0 !important;
  margin: 40px 0 0 0 !important;
  @media (max-width:1160px) {
    font-size: 27px !important;
    line-height: 34px !important;
  }
}
.page-like-text {
  max-width: 80%;
  font-family: Roboto;
  font-weight:300;
  font-size: 14px;
  color:#cfcfcf;
  line-height: 17px;
  padding: 0 !important;
  text-align: left;
  margin: 15px 0 30px 0 !important;
}
.container-order-main {
  width:100%;
  height:auto;
  margin: 30px 0 70px 0 !important;
  padding: 0 0 0 0 !important;
  text-align: left;
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
.pin_container {
  padding: 0;
  position: relative;
  margin:0 auto 80px !important;
  display: grid;
  grid-auto-rows: 10px;
  justify-content: center;
  gap: 0 20px;
  padding:0;
  width: 100%;
  grid-template-columns: repeat(auto-fill, 203px);
  @media (min-width:1000px) and (max-width:1160px) {
    grid-template-columns: repeat(auto-fill, 219px) !important;
  }
  @media (min-width:800px) and (max-width:1000px) {
    grid-template-columns: repeat(auto-fill, 23%) !important;
    gap: 0 19px !important;
  }
  @media (min-width:620px) and (max-width:800px) {
    grid-template-columns: repeat(auto-fill, 31%) !important;
  }
  @media (min-width:420px) and (max-width:620px) {
    grid-template-columns: repeat(auto-fill, 47%) !important;
  }
  @media (max-width:420px) {
    grid-template-columns: repeat(auto-fill, 46%) !important;
  }
}
.card {
  padding: 0;
  margin: 10px 0;
  border-radius: 14px;
  background-color: #4f4f4f;
  overflow: hidden;
  position: relative;
  grid-row-end:span 24;
  img {
    object-fit: cover;
    width:100%;
    height:100%;
    pointer-events: none !important;
  }
  a {
    position: absolute;
    z-index: 2;
    top:0;
    left:0;
    width:100%;
    height:calc(100% + 50px);
    background-color: rgba(0, 0, 0, 0.1);
    background-image: url(@/assets/maximize.svg);
    background-repeat: no-repeat;
    background-position: top calc(50% - 25px) center;
    background-size: 0;
    transition: background 0.2s ease;
    &:hover {
      background-color: rgba(0, 0, 0, 0);
      background-image: url(@/assets/maximize.svg);
      background-repeat: no-repeat;
      background-position: top calc(50% - 25px) center;
      background-size: 42px;
    }
    @media (max-width: 700px) { 
      background-color: rgba(0, 0, 0, 0) !important;
    }
  }
  .btn-like-card {
    position: absolute;
    z-index: 3;
    top:10px;
    left:10px;
    width:32px;
    height:32px;
    background-image: url(@/assets/like-white.svg);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 22px;
    border-radius: 10px;
    border:0;
    outline: none;
    cursor: pointer;
    overflow: hidden;
    transition: .3s;
    &.no-active {
      background-color: rgba(0, 0, 0, 0.8);
      &:hover {
        background-color: rgba(0, 0, 0, 1);
      }
    }
    &.active {
      background-color: rgba(230, 29, 31);
    }
  }
  .number-card {
    position: absolute;
    display: block;
    top:10px;
    right:10px;
    color:#fff;
    font-family: Roboto;
    font-weight:400;
    font-size: 12px;
    padding: 3px 7px 2px;
    border-radius: 10px;
    background-color: rgba(0, 0, 0, 0.8);
  }
}
</style>