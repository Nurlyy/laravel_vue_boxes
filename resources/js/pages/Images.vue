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
                <th>Фото</th>
                <th>Alt</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="image in images" :key="image.id">
                <td class='table_td'>{{ image.id }}</td>
                <td class='table_td'><img :src="image.path" height="100" /></td>
                <td class='table_td'>{{ image.description }}</td>
                <td class='table_td'>
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

                <td class='table_td'>
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
    <!-- <CPagination aria-label="Page navigation example">
        <CPaginationItem
            @click="decreasePage"
            aria-label="Previous"
            href="#"
            :disabled="currentPage === 1"
        >
            <span aria-hidden="true">&laquo;</span>
        </CPaginationItem>

        <CPaginationItem
            v-for="page in pages"
            :key="page"
            :active="currentPage === page"
            @click="getImages(page)"
        >
            {{ page }}
        </CPaginationItem>

        <CPaginationItem
            @click="increasePage"
            aria-label="Next"
            href="#"
            :disabled="currentPage === lastPage"
        >
            <span aria-hidden="true">&raquo;</span>
        </CPaginationItem>
    </CPagination> -->
</template>

<script>
export default {
    name: "Images",
    data() {
        return {
            images: [],
            // lastPage: null,
            // currentPage: 0,
            // perPage: 20,
        };
    },
    mounted() {
        this.getImages();
    },
    methods: {
        // increasePage() {
        //     this.currentPage += 1;
        //     this.getImages(this.currentPage);
        // },
        // decreasePage() {
        //     this.currentPage -= 1;
        //     this.getImages(this.currentPage);
        // },
        getImages() {
            // if (this.currentPage - 1 >= this.lastPage) {
            //     return;
            // }

            axios
                .post("/api/get-images-admin", {
                    // currentPage: this.currentPage,
                    // perPage: this.perPage,
                })
                .then((response) => {
                    this.images = response.data.images;
                    // this.lastPage = response.data.lastPage;
                    // this.currentPage += 1;

                })
                .catch((error) => {
                    console.log(error);
                });
        },
        // getImages(page) {
        //     if (page === this.currentPage) {
        //         return;
        //     }

        //     if (page > this.lastPage) {
        //         return;
        //     }

        //     this.currentPage = page;

        //     axios
        //         .get("/api/get-images-admin", {
        //             params: {
        //                 page: this.currentPage,
        //                 per_age: this.perPage,
        //             },
        //         })
        //         .then((response) => {
        //             this.images = response.data.images;
        //             this.lastPage = response.data.lastPage;
        //             this.currentPage = page;
                    
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // },
        deleteImage(id) {
            if (confirm("Are you sure you want to delete this?")) {
                axios.post("/api/delete-image", { id: id }).then((response) => {
                    this.getAllImages();
                    console.log(response.data.message);
                });
            }
        },
    },
};
</script>

<style scoped>
.table_td{
    display: flex;
    justify-content: center;
}
</style>
