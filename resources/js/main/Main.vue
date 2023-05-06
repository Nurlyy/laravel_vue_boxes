<template>
    <div class="container-main">
        <div
            class="pin_container scroll-container"
            ref="scrollContainer"
            @scroll="console.log('Main scrolled')"
            id="gallery_id"
        >
            <TransitionGroup @before-leave="beforeLeave">
                <div
                    v-for="image in images"
                    :key="image.id"
                    :class="image.class"
                    :id="image.id + '_image'"
                >
                    <img :src="image.path" alt="" />
                    <a
                        @click="imageClicked(image.path, $event)"
                        :href="image.path"
                        :data-pswp-width="maxWidth"
                        :data-pswp-height="maxHeight"
                        :alt="image.description"
                        target="_blank"
                        rel="noreferrer"
                        id="imageView"
                    ></a>
                    <button
                        :id="'like_button_' + image.id"
                        @click="likeImage(image.id)"
                        :class="
                            isLiked(image.id)
                                ? 'btn-like-card active add-image'
                                : 'btn-like-card no-active add-image'
                        "
                    ></button>
                    <button                
                        class="btn-like-card no-active"
                        style="margin-top: 35px;"
                        @click='handleShareClick(image.id, $event)'
                    ><div :id="'share_button_' + image.id" style='height:fit-content;border-radius:15px; width:fit-content;background-color:white;'></div></button>
                    <span class="number-card">#{{ image.id }}</span>
                </div>
            </TransitionGroup>
        </div>
    </div>
</template>

<script>
import PhotoSwipeLightbox from "photoswipe/lightbox";
import "photoswipe/style.css";
// import { yandex_shared } from "../assets/ya/main.js";
export default {
    name: "Main",
    created() {
        window.addEventListener("scroll", this.handleScroll);
        this.observer = new IntersectionObserver(this.handleIntersection, {
            root: null,
            rootMargin: "0px",
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
            randomClasses: {},
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
            // category_id: null,
        };
    },
    // setup () {
    //     document.addEventListener("DOMContentLoaded", function (e) {
    //         document.addEventListener("scroll", function (e) {
    //             let documentHeight = document.body.scrollHeight;
    //             let currentScroll = window.scrollY + window.innerHeight;
    //             // When the user is [modifier]px from the bottom, fire the event.
    //             let modifier = 200;
    //             if (currentScroll + modifier > documentHeight) {
    //                 console.log("You are at the bottom!");
    //             }
    //         });
    //     });
    // },
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
        handleShareClick(id, event){
            // console.log('item_id : ' + event.currentTarget);
            // console.log("clicked: share_button_"+id);
            // const button = document.getElementById("share_button_"+id);
            // const aTag = button.querySelector("a");
            // console.log("aTag : " + aTag);
            // event.stopPropagation();
            // aTag.click();
            // this.$refs.child.click();
            // if(event.target.id=="share_button_"+id){
            // }
        },
        imageClicked(path, event) {
            if (event.target.tagName.toLowerCase() === 'a') {
                const img = new Image();
                img.src = path;
                this.maxWidth = img.width;
                this.maxHeight = img.height;
            }
        },
        beforeLeave(el) {
            const { marginLeft, marginTop, width, height } =
                window.getComputedStyle(el);

            el.style.left = `${el.offsetLeft - parseFloat(marginLeft, 10)}px`;
            el.style.top = `${el.offsetTop - parseFloat(marginTop, 10)}px`;
            el.style.width = width;
            el.style.height = height;
        },
        getClass(id) {
            return "card " + this.randomClasses[id];
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
            console.log("cat id: " + this.category_id);
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
                    // setTimeout(() => {
                    //     temp.forEach((element) => {
                    //         yandex_shared("share_button_" + element.id, window.location.origin + element.path);
                    //     });
                    // }, 500);
                    this.page += 1;
                    this.lastPage = response.data.lastPage;
                })
                .catch((error) => {
                    this.isLoading = false;
                    this.isError = true;
                    this.error = error.message;
                });
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
                    document.body.offsetHeight - 50
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
    // created() {
    //     // Assign a random class to each item
    //     this.images.forEach((image) => {
    //         const randomIndex = Math.floor(
    //             Math.random() * this.classList.length
    //         );
    //         this.$set(
    //             this.randomClasses,
    //             image.id,
    //             "card " + this.classList[randomIndex]
    //         );
    //     });
    // },
};
</script>

<style scoped lang="scss">
.list-enter-active,
.list-leave-active {
    transition: opacity 0.5s ease;
}

.ya-share2__icon {
    background-color: white !important;
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
    margin: 0 auto 80px !important;
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
