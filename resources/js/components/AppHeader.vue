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
                <CIcon :icon="logo" height="48" alt="Logo" />
            </CHeaderBrand>
            <CHeaderNav class="d-none d-md-flex me-auto">
                <CNavItem>
                    <CNavLink href="/dashboard"> Dashboard </CNavLink>
                </CNavItem>
                <CNavItem>
                    <CNavLink href="#">Users</CNavLink>
                </CNavItem>
                <CNavItem>
                    <CNavLink href="#">Settings</CNavLink>
                </CNavItem>
            </CHeaderNav>
            <CHeaderNav>
                <CNavItem>
                    <CNavLink href="#">
                        <CIcon class="mx-2" icon="cil-bell" size="lg" />
                    </CNavLink>
                </CNavItem>
                <CNavItem>
                    <CNavLink href="#">
                        <CIcon class="mx-2" icon="cil-list" size="lg" />
                    </CNavLink>
                </CNavItem>
                <CNavItem>
                    <CNavLink href="#">
                        <CIcon
                            class="mx-2"
                            icon="cil-envelope-open"
                            size="lg"
                        />
                    </CNavLink>
                </CNavItem>
                <h4 @click="logout()">Logout</h4>
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
import { logo } from "@/assets/brand/logo";
import router from '@/router/index.js';

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
                            Authorization: `Bearer ` + localStorage.getItem('access_token'),
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
    setup() {
        return {
            logo,
        };
    },
};
</script>
