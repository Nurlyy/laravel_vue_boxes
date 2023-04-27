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
                <td>{{ image.path }}</td>
                <td>{{ image.description }}</td>
                <td>
                    <router-link :to="'/admin/images/' + image.id"
                        >Изменить</router-link
                    >
                </td>
                <td><button @click="deletePage(item.id)">Удалить</button></td>
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
};
</script>

<style></style>
