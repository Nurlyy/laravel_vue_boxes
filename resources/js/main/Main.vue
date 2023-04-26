<template>
    <div>
        <div class="pin_container">
            <div
                v-for="image in images"
                :key="image.id"
                :class="getClass(image.id)"
                :id="image.id + '_image'"
            >
                <img :src="image.path" alt="" />
                <a @click="likeImage(image.id)"></a>
                <button
                    :class="
                        isLiked(image.id)
                            ? 'btn-like-card active'
                            : 'btn-like-card no-active'
                    "
                ></button>
                <span class="number-card">#{{ image.id }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Main",
    data() {
        return {
            images: [],
            likedImages: [],
            classList: ["card_small", "card_medium", "card_large"],
            randomClasses: {},
        };
    },
    mounted() {
        axios.post("/api/get-images", {}).then((response) => {
            this.images = response.data.images;
            // console.log( response.data.images);
            this.likedImages =
                localStorage.getItem("likedImages") != null
                    ? JSON.parse(localStorage.getItem("likedImages"))
                    : [];
            this.$nextTick(() => {
                this.$emit("likesCount");
            });

            this.images.forEach((image) => {
                const randomIndex = Math.floor(
                    Math.random() * this.classList.length
                );
                this.randomClasses[image.id] = this.classList[randomIndex];
            });
        });

        // console.log(this.images);
    },
    methods: {
        getClass(id){
            return "card " + this.randomClasses[id];
        },
        isLiked(id) {
            return this.likedImages.includes(id);
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
            } else {
                this.unlikeImage(id);
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
        background-image: url(@/assets/like-white.svg);
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
