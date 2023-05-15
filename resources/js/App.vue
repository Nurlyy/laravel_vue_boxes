<template>
    <router-view />
</template>

<style lang="scss">
// Import Main styles for this application
@import "styles/style.scss";

.ya-share2 {
    background-color: none !important;
    background: none !important;
}

.ya-share2__icon_more {
    background-image: url('data:image/svg+xml,%3Csvg width="16" height="16" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath d="M14.6 2.9a2.7 2.7 0 01-4.554 1.963L5.303 7.28a2.702 2.702 0 010 1.44l4.743 2.417a2.7 2.7 0 11-.834 1.708l-5.05-2.575a2.7 2.7 0 110-4.54l5.05-2.575A2.7 2.7 0 1114.6 2.9z" fill="%23fff"/%3E%3C/svg%3E') !important;
    background-size: 14px 14px !important;
        background-position: 0px 3px !important;
        margin-top: -1px;   
}

// .ya-share2__container_size_s {
//     .ya-share2__badge .ya-share2__icon {
//         background-size: 14px 14px !important;
//         background-position: 0px 3px !important;
//         margin-top: -1px;   
//     }
// }
</style>

<!-- <template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav" v-if="loggedUser">
                    <h5>Dashboard</h5>
                    <a href="javascript:void(0)" @click="logout()" class="nav-item nav-link ml-3">Logout</a>
                </div>
                <div v-else>
                    <router-link to="/login">Login</router-link>
                    <router-link to="/register">Register</router-link>
                </div>
            </div>
        </nav>
        <router-view> </router-view>
    </div>
</template>

<script>
    import Auth from './Auth.js';
    export default {
        data() {
            return {
                loggedUser: this.auth.user
            };
        },
        mounted() {
            console.log(this.auth.user);
        },
        methods: {
            logout() {
                this.axios.post('http://127.0.0.1:8000/api/logout')
                .then(({data}) => {
                    Auth.logout(); //reset local storage
                    this.$router.push('/login');
                })
                .catch((error) => {
                    console.log(error);
                });
            }
        }
    }
</script> -->
