<template>
    <AppSidebar />
    <div class="d-flex flex-row justify-content-between">
        <h1>Страницы</h1>
        <a
            href="/admin/images/add-page"
            class="btn btn-primary"
            style="margin-left: 30px; padding-bottom: -15px"
            >Добавить страницу</a
        >
    </div>
    <CTable stripedColumns>
        <thead>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>URL</th>
                <th>Ключевые слова</th>
                <th>Показывать</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items" :key="item.id">
                <td>{{ item.id }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.slug }}</td>
                <td>{{ item.keyword }}</td>
                <td><CFormCheck style="margin-left: 15px" :checked='item.show' id="show" disabled /></td>
                <td>
                    <CButton component="a" color="info" :href="'/admin/pages/' + item.slug" role="button">Изменить</CButton>
                    <!-- <router-link :to="'/admin/images/' + image.id"
                        >Изменить</router-link
                    > -->
                </td>
                
                <td><CButton @click="deletePage(item.id)" color="danger" role="button">Удалить</CButton></td>
            </tr>
        </tbody>
    </CTable>
</template>

<script>
import router from "@/router/index.js";
export default {
    name: "Filters",
    data() {
        return {
            items: [],
        };
    },
    mounted() {
        axios.post("/api/get-pages-admin", {}).then((response) => {
            this.items = response.data.items;
        });
    },
    methods: {
        deletePage(id) {
            if (confirm("Are you sure you want to delete this?")) {
                axios.post("/api/delete-page", { id: id }).then((response) => {
                this.items = response.data.items;
                // router.push({ name: "Pages" });
            });
            }
        },
    },
};
</script>

<style></style>
