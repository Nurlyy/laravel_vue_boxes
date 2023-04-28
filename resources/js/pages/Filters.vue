<template>
    <AppSidebar />
    <div class="d-flex flex-row justify-content-between">
        <h1>Фильтры</h1>
        <a
            href="/admin/images/add-filter"
            class="btn btn-primary"
            style="margin-left: 30px"
            >Добавить фильтр</a
        >
    </div>
    <CTable stripedColumns>
        <thead>
            <tr>
                <th>№</th>
                <th>Название</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="filter in filters" :key="filter.id">
                <td>{{ filter.id }}</td>
                <td>{{ filter.name }}</td>
                <td>
                    <CButton
                        component="a"
                        color="info"
                        :href="'/admin/filters/' + filter.id"
                        role="button"
                        >Изменить</CButton
                    >
                    <!-- <router-link :to="'/admin/images/' + image.id"
                        >Изменить</router-link
                    > -->
                </td>

                <td>
                    <CButton
                        @click="deleteFilter(filter.id)"
                        color="danger"
                        role="button"
                        >Удалить</CButton
                    >
                </td>
            </tr>
        </tbody>
    </CTable>
</template>

<script>
export default {
    name: "Filters",
    data() {
        return {
            filters: [],
        };
    },
    mounted() {
        this.getFilters();
    },
    methods: {
        getFilters() {
            axios.post("/api/get-filters", {}).then((response) => {
                this.filters = response.data.filters;
            });
        },
        deleteFilter(id) {
            axios.post("/api/delete-filter", { id: id }).then((response) => {
                // this.filters = response.data.filters;
                this.getFilters();
            });
        },
    },
};
</script>

<style></style>
