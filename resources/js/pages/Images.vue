<template>
    <div class="d-flex flex-row justify-content-between">
        <h1>Изображения</h1>
        <a
            href="/admin/images/add-image"
            class="btn btn-primary"
            style="margin-left: 30px"
            >Добавить изображение</a
        >
    </div>
    <CTable stripedColumns>
        <thead>
            <tr>
                <th>№</th>
                <th>путь изображения</th>
                <th>Описание</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="image in images" :key="image.id">
                <td>{{ image.id }}</td>
                <!-- <td>{{ image.path }}</td> -->
                <td>{{ image.description }}</td>
                <td>
                    <CButton
                        component="a"
                        color="info"
                        :href="'/admin/images/' + image.id"
                        role="button"
                        >Изменить</CButton
                    >
                    <!-- <router-link :to="'/admin/images/' + image.id"
                        >Изменить</router-link
                    > -->
                </td>

                <td>
                    <CButton
                        @click="deleteImage(image.id)"
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
    name: "Images",
    data() {
        return {
            images: [],
        };
    },
    mounted() {
        axios.post("/api/get-images-admin", {}).then((response) => {
            this.images = response.data.images;
        });
    },
    methods: {
        deleteImage(id) {
            if (confirm("Are you sure you want to delete this?")) {
                axios.post("/api/delete-image", { id: id }).then((response) => {
                    this.images = response.data.images;
                });
            }
        },
    },
};
</script>

<style></style>
