<template>
    <AppSidebar />
    <div class="d-flex flex-row justify-content-between">
        <h1>Фильтры</h1>
        <a
            href="/admin/images/add-filter"
            class="btn btn-primary"
            style="margin-left: 30px; height: fit-content"
            ><CIcon icon="cil-plus" size="sm"/> Добавить фильтр</a
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
                <td><div class="table_td">{{ filter.id }}</div></td>
                <td><div class="table_td">{{ filter.name }}</div></td>
                <td>
                    <div class="table_td"><CButton
                        component="a"
                        color="info"
                        :href="'/admin/filters/' + filter.id"
                        role="button"
                        ><CIcon icon="cil-pen" size="sm"/> Изменить</CButton
                    ></div> 
                    <!-- <router-link :to="'/admin/images/' + image.id"
                        >Изменить</router-link
                    > -->
                </td>

                <td>
                    <div class="table_td"><CButton
                        @click="deleteFilter(filter.id)"
                        color="danger"
                        role="button"
                        ><CIcon icon="cil-trash" size="sm"/> Удалить</CButton
                    ></div> 
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

<style scoped>
.table_td {
    display: flex;
    justify-content: center;
}
</style>