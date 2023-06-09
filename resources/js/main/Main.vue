<template>
    <div class="container-main">
        <div
            class="pin_container scroll-container"
            ref="scrollContainer"
            @scroll="console.log('Main scrolled')"
            id="gallery_id"
        >
            <!-- <transition-group name="list" tag="p"> -->
                <div
                    v-for="image in images"
                    :key="image.id"
                    :class="image.class"
                    :id="image.id + '_image'"
                >
                    <img :src="image.preview" :alt="image.description" />
                    <a
                        @click="imageClicked(image.path, $event)"
                        :href="image.path"
                        :data-pswp-width="maxWidth"
                        :data-pswp-height="maxHeight"
                        :aria-label='image.description'
                        target="_blank"
                        rel="noreferrer"
                        id="imageView"
                    ></a>
                    <button
                        :id="'like_button_' + image.id"
                        @click="likeImage(image.id)"
                        aria-label="Like image button"
                        :class="
                            isLiked(image.id)
                                ? 'btn-like-card active add-image'
                                : 'btn-like-card no-active add-image'
                        "
                    ></button>
                    <button   
                        aria-label="Share button"    
                        class="btn-like-card no-active"
                        style="margin-top: 35px;"
                        @click='handleShareClick(image.id, $event)'
                    ><div :id="'share_button_' + image.id" style='height:fit-content;border-radius:15px; width:fit-content;background-color:white;'></div></button>
                    <span class="number-card">#{{ image.id }}</span>
                </div>
            <!-- </transition-group> -->
        </div>
    </div>
</template>

<script>
import PhotoSwipeLightbox from "photoswipe/lightbox";
import "photoswipe/style.css";
import { yandex_shared } from "../assets/ya/main.js";
export default {
    name: "Main",
    created() {
        window.addEventListener("scroll", this.handleScroll);
        this.observer = new IntersectionObserver(this.handleIntersection, {
            root: null,
            rootMargin: "150px",
            threshold: 1.0,
        });
    },
    props: {
        category_id: null,
    },
    data() {
        return {
            images: [],
            likedImages: [],
            classList: ["card_small", "card_medium", "card_large"],
            page: 1,
            perPage: 16,
            lastPage: null,
            isLoading: false,
            isError: false,
            error: "",
            observer: null,
            api_url: null,
            maxWidth: 0,
            maxHeight: 0,
            loadedPages: [],
            imageUrls: [],
            preloadedImages: [],
            loadedImages: [],
        };
    },
    mounted() {
        if (!this.lightbox) {
            this.lightbox = new PhotoSwipeLightbox({
                gallery: "#gallery_id",
                children: "#imageView",
                pswpModule: () => import("photoswipe"),
            });
            this.lightbox.init();
        }        this.likedImages =
            localStorage.getItem("likedImages") != null
                ? JSON.parse(localStorage.getItem("likedImages"))
                : [];
        this.loadNextPage();
    },
    methods: {
        imageClicked(path, event) {
            if (event.target.tagName.toLowerCase() === 'a') {
                const img = new Image();
                img.src = path;
                this.maxWidth = img.width;
                this.maxHeight = img.height;
            }
        },
        isLiked(id) {
            if (localStorage.getItem("likedImages")) {
                return JSON.parse(localStorage.getItem("likedImages")).includes(
                    id
                );
            }
        },

        likeImage(id) {
            if (!this.likedImages.includes(id)) {
                this.likedImages.push(id);
                localStorage.setItem(
                    "likedImages",
                    JSON.stringify(this.likedImages)
                );
                // console.log(this.likedImages.length);
                this.$nextTick(() => {
                    this.$emit("likesCount");
                });
                var btn = document.getElementById("like_button_" + id);
                btn.className = "btn-like-card active add-image";
            } else {
                this.unlikeImage(id);
                var btn = document.getElementById("like_button_" + id);
                btn.className = "btn-like-card no-active add-image";
            }
        },
        unlikeImage(id) {
            this.likedImages.splice(this.likedImages.indexOf(id), 1);
            localStorage.setItem(
                "likedImages",
                JSON.stringify(this.likedImages)
            );
            this.$nextTick(() => {
                this.$emit("likesCount");
            });
        },
        loadNextPage() {
            // console.log("cat id: " + this.category_id);
            if (this.isLoading || this.isError) {
                return;
            }

            if (this.page - 1 >= this.lastPage && this.lastPage != null) {
                return;
            }

            this.isLoading = true;

            if (this.category_id == null) {
                this.api_url = `/api/get-images?page=${this.page}&per_page=${this.perPage}`;
            } else {
                this.api_url = `/api/get-category-images?category_id=${this.category_id}&{page=${this.page}&per_page=${this.perPage}`;
            }

            axios
                .get(this.api_url)
                .then((response) => {
                    this.isLoading = false;
                    var temp = response.data.images;
                    temp.forEach((element) => {
                        // const randomIndex = Math.floor(Math.random() * this.sizeClasses.length);
                        // item.size = this.sizeClasses[randomIndex];

                        element["class"] =
                            "card " +
                            this.classList[
                                Math.floor(
                                    Math.random() * this.classList.length
                                )
                            ];
                    });
                    this.images.push(...temp);
                    setTimeout(() => {
                        temp.forEach((element) => {
                            yandex_shared("share_button_" + element.id, window.location.origin + element.path);
                            console.log(window.location.origin + element.path);
                        });
                    }, 500);
                    this.page += 1;
                    this.lastPage = response.data.lastPage;
                })
                .catch((error) => {
                    this.isLoading = false;
                    this.isError = true;
                    this.error = error.message;
                });
        },
        loadPage(){

        },
        loadImages(){

        },
        handleIntersection(entries) {
            if (entries[0].isIntersecting) {
                this.loadNextPage();
            }
        },
        handleScroll: function (el) {
            window.onscroll = () => {
                if (
                    window.innerHeight + Math.ceil(window.pageYOffset) >=
                    document.body.offsetHeight - 1000
                ) {
                    this.loadNextPage();
                }
            };
            // console.log("scrolled");
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

.list-enter-active,
.list-leave-active {
    transition: opacity 0.5s ease;
}

// .ya-share2__icon {
//     background-color: white !important;
// }

.ya-share2 {
background-color: none !important;
background: none !important;
}

.ya-share2__icon_more {
  background-image: url('data:image/svg+xml,%3Csvg width="16" height="16" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath d="M14.6 2.9a2.7 2.7 0 01-4.554 1.963L5.303 7.28a2.702 2.702 0 010 1.44l4.743 2.417a2.7 2.7 0 11-.834 1.708l-5.05-2.575a2.7 2.7 0 110-4.54l5.05-2.575A2.7 2.7 0 1114.6 2.9z" fill="%23fff"/%3E%3C/svg%3E') !important;
}

.list-item {
  display: block;
  position: relative;
  margin-right: 10px;
}
.list-enter-active,
.list-leave-active {
  transition: all 1s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateY(30px);
}


.ya-share2__container_size_s .ya-share2__badge .ya-share2__icon {
  background-size: 18px 18px !important;
  background-position: 0px 3px !important;
}

.container-main {
    margin: 0 auto;
    height: auto;
    padding: 0 20px;
    box-sizing: border-box;
    @media (min-width: 1160px) {
        width: 1140px;
    }
    @media (min-width: 1000px) and (max-width: 1160px) {
        width: 980px;
    }
    @media (max-width: 1000px) {
        width: 100%;
        min-width: 370px;
    }
}
.pin_container {
    padding: 0;
    position: relative;
    margin: 0 auto 40px !important;
    display: grid;
    grid-auto-rows: 10px;
    justify-content: center;
    gap: 0 20px;
    padding: 0;
    width: 100%;
    grid-template-columns: repeat(auto-fill, 203px);
    @media (min-width: 1000px) and (max-width: 1160px) {
        grid-template-columns: repeat(auto-fill, 219px) !important;
    }
    @media (min-width: 800px) and (max-width: 1000px) {
        grid-template-columns: repeat(auto-fill, 23%) !important;
        gap: 0 19px !important;
    }
    @media (min-width: 620px) and (max-width: 800px) {
        grid-template-columns: repeat(auto-fill, 31%) !important;
    }
    @media (min-width: 420px) and (max-width: 620px) {
        grid-template-columns: repeat(auto-fill, 47%) !important;
    }
    @media (max-width: 420px) {
        grid-template-columns: repeat(auto-fill, 46%) !important;
    }
}
.card {
    padding: 0;
    margin: 10px 0;
    border: 0 !important;
    border: 0;
    border-radius: 14px;
    background-color: #4f4f4f;
    overflow: hidden;
    position: relative;
    img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        pointer-events: none !important;
    }
    a {
        position: absolute;
        z-index: 2;
        top: 0;
        left: 0;
        width: 100%;
        height: calc(100% + 50px);
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
        top: 10px;
        left: 10px;
        width: 32px;
        height: 32px;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 22px;
        border-radius: 10px;
        border: 0;
        outline: none;
        cursor: pointer;
        overflow: hidden;
        transition: 0.3s;
        &.no-active {
            background-color: rgba(0, 0, 0, 0.8);
            &:hover {
                background-color: rgba(0, 0, 0, 1);
            }
        }
        &.active {
            background-color: rgba(230, 29, 31);
        }

        &.add-image {
            background-image: url(@/assets/like-white.svg);
        }
    }
    .number-card {
        position: absolute;
        display: block;
        top: 10px;
        right: 10px;
        color: #fff;
        font-family: Roboto;
        font-weight: 400;
        font-size: 12px;
        padding: 3px 7px 2px;
        border-radius: 10px;
        background-color: rgba(0, 0, 0, 0.8);
    }
}
.card_small {
    grid-row-end: span 23;
    @media (min-width: 800px) and (max-width: 1000px) {
        grid-row-end: span 21;
    }
    @media (min-width: 600px) and (max-width: 800px) {
        grid-row-end: span 21;
    }
    @media (max-width: 600px) {
        grid-row-end: span 19;
    }
}
.card_medium {
    grid-row-end: span 33;
    @media (min-width: 800px) and (max-width: 1000px) {
        grid-row-end: span 31;
    }
    @media (min-width: 600px) and (max-width: 800px) {
        grid-row-end: span 31;
    }
    @media (max-width: 600px) {
        grid-row-end: span 29;
    }
}
.card_large {
    grid-row-end: span 42;
    @media (min-width: 800px) and (max-width: 1000px) {
        grid-row-end: span 38;
    }
    @media (min-width: 600px) and (max-width: 800px) {
        grid-row-end: span 38;
    }
    @media (max-width: 600px) {
        grid-row-end: span 34;
    }
}
</style>
