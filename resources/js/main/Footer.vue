<template>
    <div class="container-footer-wrapper">
        <div class="contact-footer">
            <div>
                <span class="tell">{{ phone_number }}</span>
                <span class="e-mail">{{ email }}</span>
            </div>
            <div>
                <span class="address">{{ address }}</span>
            </div>
        </div>
        <div class="footer">
            <span>© 2023. Все права зашищены.</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "Footer",
    data() {
        return {
            phone_number: null,
            email: null,
            address: null,
        };
    },
    mounted() {
        axios.post("/api/get-contacts", {}).then((response) => {
            this.phone_number = response.data.contacts.phone_number;
            this.email = response.data.contacts.email;
            this.address = response.data.contacts.address;
        });
    },
};
</script>

<style scoped lang="scss">
.container-footer-wrapper {
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
    .contact-footer {
        width: 100%;
        display: grid;
        grid-template-columns: max-content 1fr;
        grid-template-rows: auto;
        gap: 0 30px;
        margin-top: 20px;
        @media (max-width: 720px) {
            grid-template-columns: 1fr !important;
        }
        span {
            display: block;
            color: #fff;
            font-family: Roboto;
            font-weight: 300;
            font-size: 16px;
            line-height: 21px;
            padding: 0 !important;
            margin: 0 !important;
            @media (max-width: 860px) {
                font-size: 13px !important;
            }
            &.address {
                text-align: right !important;
                color: #a1a1a1 !important;
                @media (max-width: 720px) {
                    text-align: left !important;
                }
            }
            &.tell {
                margin-right: 30px !important;
                float: left;
            }
            &.e-mail {
                float: left;
            }
        }
    }
    .footer {
        width: 100%;
        color: #a1a1a1;
        font-family: Roboto;
        font-weight: 300;
        font-size: 12px;
        padding: 12px 0;
        background-color: none !important;
        background: none !important;
        border: 0 !important
    }
}
</style>
