<template>
    <div>
        <!-- <CToast
            v-if="showToast"
            :autohide="true"
            style="position: absolute; z-index: 9999; top: 15px; right: 15px"
            visible
        >
            <CToastHeader closeButton>
                <span class="me-auto fw-bold">{{ title }}</span>
            </CToastHeader>
            <CToastBody>{{ content }}</CToastBody>
        </CToast> -->
        <div class="conteaner-zero"></div>
        <div class="container-header-wrapper">
            <div class="container-header">
                <a href="/" class="logo">
                    <img src="@/assets/logo.svg" alt="propako.ru" />
                </a>
                <div class="slogan">Производство упаковки</div>
                <button
                    @click="showModal()"
                    aria-label="Menu button"
                    class="btn-gamburger-menu"
                >
                    <span class="line"></span>
                    <span class="line ots"></span>
                    <span class="line ots"></span>
                </button>
                <button
                    @click="go_to_likes()"
                    aria-label="Likes button"
                    class="btn-like"
                >
                    <span class="counter">{{ likes_count }}</span>
                </button>
                <button
                    @click="showOrder()"
                    aria-label="Order button"
                    class="btn-header-universal order"
                >
                    заявка на расчёт
                </button>
                <button
                    @click="showFilters()"
                    class="btn-header-universal filter"
                    aria-label="Catalog button"
                >
                    каталог упаковки
                </button>

                <form action="https://t.me/propako" target="_blank">
                    <button class="telegram" aria-label="Telegram button"></button>
                </form>

                <a :href="'tel:' + phone_number" class="phone">
                    {{ phone_number }}
                </a>
            </div>
        </div>
    </div>

    <Order v-if="showingOrder" @close="hideOrder" />
    <Modal v-if="showingModal" @close="hideModal" />
    <Filters v-if="showingFilters" @close="hideFilters" />
</template>

<script>
import Modal from "./Modal.vue";
import Order from "./Order.vue";
import router from "@/router/index.js";
import Filters from "./Filters.vue";

export default {
    name: "Header",
    components: {
        Modal,
        Order,
        Filters,
    },
    data() {
        return {
            showingOrder: false,
            showingModal: false,
            likes_count: 0,
            phone_number: null,
            showingFilters: false,
            success: false,
            fail: false,
            toasts: [],
            showToast: false,
            title: "",
            content: "",
            status: false,
        };
    },
    mounted() {
        this.likes_count = localStorage.getItem("likedImages")
            ? JSON.parse(localStorage.getItem("likedImages")).length
            : 0;
        axios.post("/api/get-contacts", {}).then((response) => {
            this.phone_number = response.data.contacts.phone_number;
        });
    },
    methods: {
        createToast(status) {
            this.toasts.push({
                title: status
                    ? "Вы успешно оставили заявку!"
                    : "Произошла ошибка!",
                content: status
                    ? "Мы обязательно обработаем вашу заявку"
                    : "Попробуйте заново",
            });
        },
        hideFilters() {
            this.showingFilters = false;
            document.getElementById("app_main").className = "";
        },
        showFilters() {
            this.showingFilters = true;
            document.getElementById("app_main").className = "blocked";
        },
        go_to_likes() {
            router.push({ name: "MainLikes" });
        },
        showOrder() {
            this.showingOrder = true;
            document.getElementById("app_main").className = "blocked";
        },
        hideOrder(status) {
            this.showingOrder = false;
            document.getElementById("app_main").className = "";
            // console.log(status);
            if(status){
                if (status.status == true) {
                this.showToast = true;
                this.title = status.status
                    ? "Вы успешно оставили заявку!"
                    : "Произошла ошибка!";
                this.content = status.status
                    ? "Мы обязательно обработаем вашу заявку"
                    : "Попробуйте заново";
                setTimeout(() => {
                    this.showToast = false;
                }, 3000);
            }
            }
            
        },
        showModal() {
            this.showingModal = true;
            document.getElementById("app_main").className = "blocked";
        },
        hideModal() {
            this.showingModal = false;
            document.getElementById("app_main").className = "";
        },
    },
};
</script>

<style scoped lang="scss">
.conteaner-zero {
    position: relative;
    height: 68px;
    background: none;
    width: 100%;
}
.container-header-wrapper {
    width: 100%;
    height: 68px;
    position: fixed;
    z-index: 9;
    top: 0;
    background-color: #000;
    left: 0;
    .container-header {
        position: relative;
        height: 100%;
        position: relative;
        margin: 0 auto;
        padding: 18px 20px;
        box-sizing: border-box;
        @media (min-width: 1160px) {
            width: 1100px !important;
            padding: 18px 0 !important;
        }
        @media (min-width: 1000px) and (max-width: 1160px) {
            width: 980px !important;
        }
        @media (max-width: 1000px) {
            width: 100% !important;
            min-width: 370px;
        }
        .logo {
            float: left;
            margin: 1px 0 0 0;
            @media (min-width: 700px) and (max-width: 800px) {
                margin: 5px 0 0 0 !important;
            }
            @media (max-width: 700px) {
                margin: 7px 0 0 0 !important;
            }
            img {
                float: left;
                height: 30px;
                @media (min-width: 700px) and (max-width: 800px) {
                    height: 22px !important;
                }
                @media (max-width: 700px) {
                    height: 20px !important;
                }
            }
        }
        .slogan {
            float: left;
            padding: 0 0 0 18px;
            height: 28px;
            width: 95px;
            margin: 1px 0 0 17px;
            border-left: 1px solid #a2a2a2;
            color: #a2a2a2;
            font-family: Roboto;
            font-weight: 400;
            font-size: 12px;
            line-height: 15px;
            text-transform: uppercase;
            @media (min-width: 800px) and (max-width: 1000px) {
                display: none !important;
            }
            @media (max-width: 800px) {
                display: none !important;
            }
        }
        .btn-gamburger-menu {
            width: 22px;
            height: 19px;
            float: right;
            cursor: pointer;
            border: 0;
            outline: none;
            padding: 0;
            background-color: none;
            background: none;
            margin-top: 6px;
            .line {
                float: left;
                width: 100%;
                height: 1px;
                background-color: #fff;
                transition: 0.3s;
                &.ots {
                    margin-top: 8px;
                }
            }
            &:hover {
                .line {
                    float: left;
                    width: 100%;
                    height: 1px;
                    background-color: #adadad;
                    &.ots {
                        margin-top: 8px;
                    }
                }
            }
        }
        .btn-like {
            float: right;
            position: relative;
            width: 35px;
            display: block;
            height: 26px;
            background-color: none;
            background: none;
            background-image: url(@/assets/like-white.svg);
            background-repeat: no-repeat;
            background-position: top -3px left 1px;
            background-size: 30px;
            cursor: pointer;
            border: 0;
            outline: none;
            margin: 3px 18px 0 0;
            transition: 0.3s;
            @media (max-width: 700px) {
                margin: 3px 11px 0 0 !important;
            }
            .counter {
                position: absolute;
                bottom: -3px;
                // padding-bottom:2px;
                left: 17px;
                height: 19px;
                box-sizing: border-box;
                padding: 0px 4px;
                background-color: #d40000;
                border-radius: 10px;
                font-family: Roboto;
                font-weight: 500;
                font-size: 12px;
                color: #fff;
                border: 1px solid #000;
            }
            &:hover {
                -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
                filter: alpha(opacity=80);
                -moz-opacity: 0.8;
                -khtml-opacity: 0.8;
                opacity: 0.8;
            }
        }
        .btn-header-universal {
            float: right;
            width: auto;
            height: 32px;
            border-radius: 8px;
            font-family: Roboto;
            font-weight: 400;
            font-size: 14px;
            padding: 0 12px;
            color: #000;
            box-sizing: border-box;
            border: 0;
            outline: none;
            cursor: pointer;
            transition: 0.3s;
            &.order {
                background-color: #fff;
                margin: 0 21px 0 0;
                @media (max-width: 720px) {
                    margin: 0 11px 0 0 !important;
                }
                &:hover {
                    background-color: #e0e0e0;
                }
            }
            &.filter {
                background-color: #febc67;
                margin: 0 12px 0 0;
                @media (max-width: 700px) {
                    margin: 0 !important;
                    position: fixed !important;
                    z-index: 2;
                    bottom: 50px;
                    left: 50%;
                    transform: translate(-50%);
                    -webkit-box-shadow: 0px 0px 20px 17px rgba(0, 0, 0, 0.29);
                    -moz-box-shadow: 0px 0px 20px 17px rgba(0, 0, 0, 0.29);
                    box-shadow: 0px 0px 20px 17px rgba(0, 0, 0, 0.29);
                    border: 1px solid #fff;
                }
                &:hover {
                    background-color: #fcb04d;
                }
            }
        }
        .telegram {
            float: right;
            position: relative;
            width: 30px;
            display: block;
            height: 26px;
            background-color: none;
            background: none;
            background-image: url(@/assets/telegram.svg);
            background-repeat: no-repeat;
            background-position: top -2px left 1px;
            background-size: 30px;
            cursor: pointer;
            border: 0;
            outline: none;
            margin: 3px 18px 0 0;
            transition: 0.3s;
            @media (max-width: 860px) {
                width: 26px;
                margin: 5px 14px 0 0;
                background-size: 24px !important;
                background-position: top 0px left 1px !important;
            }
            @media (max-width: 720px) {
                display: none;
            }
            &:hover {
                -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
                filter: alpha(opacity=80);
                -moz-opacity: 0.8;
                -khtml-opacity: 0.8;
                opacity: 0.8;
            }
        }
        .phone {
            float: right;
            font-family: Roboto;
            font-weight: 300;
            font-size: 23px;
            color: #fff;
            text-decoration: none;
            margin-right: 14px;
            @media (min-width: 750px) and (max-width: 850px) {
                font-size: 18px !important;
                padding: 6px 0 !important;
            }
            @media (max-width: 750px) {
                font-size: 16px !important;
                padding: 8px 0 !important;
            }
            @media (max-width: 690px) {
                display: none !important;
            }
        }
    }
}
</style>
