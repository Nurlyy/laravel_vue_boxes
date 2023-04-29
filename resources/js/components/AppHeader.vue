<template>
    <CHeader position="sticky" class="mb-4">
        <CContainer fluid>
            <CHeaderToggler
                class="ps-1"
                @click="$store.commit('toggleSidebar')"
            >
                <CIcon icon="cil-menu" size="lg" />
            </CHeaderToggler>
            <CHeaderBrand class="mx-auto d-lg-none" to="/">
                <img src="@/assets/logo.svg" alt="" />
            </CHeaderBrand>
            <CHeaderNav>
                <CButton color="warning" @click="logout()"
                    ><CIcon icon="cilAccountLogout" size="sm" /> Выход</CButton
                >
            </CHeaderNav>
        </CContainer>
        <CHeaderDivider />
        <CContainer fluid>
            <AppBreadcrumb />
        </CContainer>
    </CHeader>
</template>

<script>
import AppBreadcrumb from "./AppBreadcrumb.vue";
import AppHeaderDropdownAccnt from "./AppHeaderDropdownAccnt.vue";
import router from "@/router/index.js";

export default {
    name: "AppHeader",
    components: {
        AppBreadcrumb,
        AppHeaderDropdownAccnt,
    },
    methods: {
        logout() {
            axios
                .post(
                    "/api/logout",
                    {},
                    {
                        headers: {
                            Authorization:
                                `Bearer ` +
                                localStorage.getItem("access_token"),
                        },
                    }
                )
                .then((response) => {
                    // Remove accessToken from localStorage
                    localStorage.removeItem("access_token");
                    // Redirect user to login page
                    router.push({ name: "Login" });
                    // console.log('token after logout is: ' + localStorage.getItem('access_token'));
                    // console.log('\n' + response.data.message);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
