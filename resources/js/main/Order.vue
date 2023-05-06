<template>
    <div v-if="isVisible" class="container-order-wrapper">
        <div class="container-order">
            <p>Заявка на расчёт упаковки</p>
            <span class="order-header-text"
                >Свяжитесь с нами для расчета стоимости или консультации <br />
                {{ contacts.phone_number }} | {{ contacts.email }} <br />
                Или заполните форму ниже</span
            >
            <div class="container-one">
                <input
                    v-model="name"
                    type="text"
                    class="inp"
                    placeholder="Ваше имя"
                />
            </div>
            <div class="container-two">
                <input
                    v-model="email"
                    type="text"
                    class="inp"
                    placeholder="E-Mail"
                />
                <input
                    v-model="number"
                    type="text"
                    class="inp"
                    placeholder="Телефон"
                />
            </div>
            <div class="container-one">
                <textarea
                    v-model="description"
                    class="inp txr"
                    placeholder="Опишите Вашу задачу"
                ></textarea>
            </div>
            <div class="container-one add-like">
                <label for="photo" class="label"
                    ><input
                        :checked="sendImages"
                        @change="checkBoxChange"
                        type="checkbox"
                        id="photo"
                        name="photo"
                    /><span>Прикрепить фото с моими лайками</span></label
                >
            </div>
            <div class="container-one">
                <button
                    :disabled="name == '' && email == '' && number == ''"
                    @click="getCookieToken"
                    class="btn-order-enter"
                >
                    Отправить заявку
                </button>
            </div>
            <button @click="$emit('close')" class="close"></button>

            <!-- Выводим уведомление при успешной отправки -->
            <!-- <div class="container-sending-true">
        Заявка успешно отправлена
      </div> -->
            <!-- ////// -->
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Order",
    data() {
        return {
            contacts: null,
            sendImages: true,
            name: "",
            email: "",
            number: "",
            description: "",
            isVisible: true,
            images: [],
        };
    },
    mounted() {
        axios.post("/api/get-contacts").then((response) => {
            this.contacts = response.data.contacts;
        });
    },
    methods: {
        getLikedImages() {
            this.images = localStorage.getItem("likedImages");
        },
        getCookie(name) {
            const cookies = document.cookie.split(";");

            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].trim();

                if (cookie.startsWith(`${name}=`)) {
                    return cookie.substring(name.length + 1);
                }
            }

            return null;
        },
        checkBoxChange() {
            this.sendImages = !this.sendImages;
        },
        getCookieToken() {
            axios
                .get("/api/get-email-token", { withCredentials: true })
                .then((response) => {
                    console.log("got email token");
                    const cookie = this.getCookie("emailToken");
                    if (cookie != null && cookie != "undefined") {
                        console.log("check email token");
                        this.isVisible = false;

                        this.getLikedImages();
                        this.sendMail();
                    }
                    // console.log(document.cookie);
                    // if (response.headers["set-cookie"]) {
                    //     // Parse the cookie data from the header
                    //     const cookieData = response.headers["set-cookie"][0]
                    //         .split("; ")[0]
                    //         .split("=");
                    //     const cookieName = cookieData[0];
                    //     const cookieValue = cookieData[1];

                    //     // Do something with the cookie data
                    //     console.log(
                    //         `Received cookie: ${cookieName}=${cookieValue}`
                    //     );
                    // }
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        sendMail() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, "0");
            const day = String(now.getDate()).padStart(2, "0");
            const hours = String(now.getHours()).padStart(2, "0");
            const minutes = String(now.getMinutes()).padStart(2, "0");
            const seconds = String(now.getSeconds()).padStart(2, "0");
            const dateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            var sendObject = {name: this.name,
                    email: this.email,
                    number: this.number,
                    description: this.description,
                    datetime: dateTime,};

            if(this.sendImages){
                sendObject['images'] = this.images;
            }

            axios
                .post("/api/send-email", sendObject)
                .then((response) => {
                    console.log(response.data);
                    if (response.data.status == "true") {
                        console.log("success");
                        localStorage.setItem['likedImages']=  null;
                        this.$emit("close", { status: true });
                    } else {
                        console.log("failure");

                        this.$emit("close", { status: false });
                    }
                });
        },
    },
};
</script>

<style scoped lang="scss">
.container-order-wrapper {
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 999;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.65);
    overflow: overlay;
    text-align: center;
    box-sizing: border-box;
    .container-order {
        position: relative;
        max-width: 420px;
        margin: 15vh auto;
        background-color: #fff;
        border-radius: 14px;
        padding: 0 0 6px 0;
        overflow: hidden;
        p {
            position: relative;
            font-family: Roboto;
            font-weight: 500;
            font-size: 15px;
            text-transform: uppercase;
            color: #000;
            padding: 17px 0 16px;
            border-bottom: 1px solid #e6e6e6;
        }
        .order-header-text {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 0 20px 16px;
            font-family: Roboto;
            font-weight: 400;
            font-size: 13px;
            color: #757575;
            text-align: center;
        }
        .close {
            position: absolute;
            width: 46px;
            height: 46px;
            top: 5px;
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
            transition: 0.3s;
            &:hover {
                -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
                filter: alpha(opacity=100);
                -moz-opacity: 1;
                -khtml-opacity: 1;
                opacity: 1;
            }
        }
        .container-one {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr;
            grid-auto-rows: 1fr;
            gap: 14px;
            box-sizing: border-box;
            padding: 0 20px;
            &.add-like {
                padding: 14px 20px !important;
            }
        }
        .container-two {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-auto-rows: 1fr;
            gap: 14px;
            box-sizing: border-box;
            padding: 14px 20px;
        }
        .label {
            font-family: Roboto;
            font-weight: 400;
            font-size: 13px;
            color: #000;
            margin-top: 0;
            input {
                margin: 1px 0 0 2px;
                float: left;
                -ms-transform: scale(1.4);
                -moz-transform: scale(1.4);
                -webkit-transform: scale(1.4);
                -o-transform: scale(1.4);
                transform: scale(1.4);
            }
            span {
                float: left;
                width: 80%;
                text-align: left;
                margin: 0 0 0 12px;
            }
        }
        .inp {
            border: 1px solid #c7c7c7;
            border-radius: 8px;
            font-family: Roboto;
            font-weight: 400;
            font-size: 13px;
            color: #000;
            height: 32px;
            width: 100%;
            padding: 0 14px;
            margin: 0;
            box-sizing: border-box;
            transition: 0.3s;
            outline: none;
            &:hover,
            &:focus,
            &:active {
                border: 1px solid #000 !important;
            }
            &.txr {
                height: 80px !important;
                padding: 14px !important;
            }
        }
        .btn-order-enter {
            width: 100%;
            height: 33px;
            border-radius: 8px;
            font-family: Roboto;
            font-weight: 400;
            font-size: 14px;
            padding: 0 12px;
            color: #000;
            box-sizing: border-box;
            text-align: center;
            border: 0;
            outline: none;
            cursor: pointer;
            transition: 0.3s;
            background-color: #febc67;
            margin: 0 0 15px 0;
            &:hover {
                background-color: #fcb04d;
            }
        }
        .container-sending-true {
            position: absolute;
            top: 50px;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            text-align: center;
            box-sizing: border-box;
            padding: 280px 40px;
            font-family: Roboto;
            font-weight: 400;
            font-size: 15px;
            background-image: url(@/assets/send-ok.svg);
            background-repeat: no-repeat;
            background-position: top 95px center;
            background-size: 100px;
        }
    }
}
</style>
