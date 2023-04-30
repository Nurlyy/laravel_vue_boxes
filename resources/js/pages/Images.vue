<template>
    <CAlert
        color="danger"
        :visible="searchAlert"
        dismissible
        @close="
            () => {
                searchAlert = false;
            }
        "
        >Неверный ID для поиска!</CAlert
    >
    <div class="d-flex flex-row justify-content-between">
        <h1>Изображения</h1>
        <a
            href="/admin/images/add-image"
            class="btn btn-primary"
            style="margin-left: 30px; height: fit-content"
            ><CIcon icon="cil-plus" size="sm" /> Добавить изображение</a
        >
    </div>
    <b-col md="3" xl="3" sm="3" xs="3">
        <div style="display: flex; flex-direction: row">
            <CFormInput
                type="text"
                v-model="searchInput"
                :value="searchInput"
                placeholder="Введите ID"
                @input="checkNumberInput"
                style="width: 250px"
            />
            <CButton
                @click="search"
                
                color="info"
                style="height: fit-content; margin-left: 15px"
                ><CIcon icon="cil-search" size="sm" /> Поиск</CButton
            >
        </div>
    </b-col>
    <br />
    <CTable stripedColumns>
        <thead>
            <tr>
                <th>№</th>
                <th>Фото</th>
                <th>Описание - Alt</th>
                <th>Прикрепленные фильтры</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="image in images" :key="image.id">
                <td>
                    <div class="table_td">{{ image.id }}</div>
                </td>
                <td>
                    <div class="table_td">
                        <img :src="image.path" height="80" />
                    </div>
                </td>
                <td>
                    <div class="table_td">{{ image.description }}</div>
                </td>
                <td style="width: 40%">
                    <CCard>
                        <CCardBody>
                            <Widget
                                class="mb-0 d-flex"
                                style="
                                    display: flex;
                                    flex-direction: row;
                                    flex-wrap: wrap;
                                "
                            >
                                <div
                                    v-for="(filter, index) in image.filters"
                                    :key="index"
                                >
                                    <CBadge
                                        color="info"
                                        shape="rounded-pill"
                                        style="margin: 10px"
                                        >{{ filter.name }}</CBadge
                                    >
                                </div>
                            </Widget>
                        </CCardBody></CCard
                    >
                </td>
                <td>
                    <div class="table_td">
                        <CButton
                            component="a"
                            color="info"
                            :href="'/admin/images/' + image.id"
                            role="button"
                            ><CIcon icon="cil-pen" size="sm" />
                            Изменить</CButton
                        >
                    </div>
                    <!-- <router-link :to="'/admin/images/' + image.id"
                        >Изменить</router-link
                    > -->
                </td>

                <td>
                    <div class="table_td">
                        <CButton
                            @click="deleteImage(image.id)"
                            color="danger"
                            role="button"
                            ><CIcon icon="cil-trash" size="sm" />
                            Удалить</CButton
                        >
                    </div>
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
            searchInput: "",
            searchAlert: false,
            // lastPage: null,
            // currentPage: 0,
            // perPage: 20,
        };
    },
    mounted() {
        this.getImages();
    },
    methods: {
        checkNumberInput() {
            // Only allow numbers
            this.searchInput = this.searchInput.replace(/[^0-9]/g, "");
        },
        search() {
            if (this.searchInput == null) {
                this.searchAlert = true;
                setTimeout(()=>{ this.searchAlert = false }, 3000);
                console.log("sI is null");
                return;
            }

            if (this.searchInput.length == 0) {
                this.getImages();
            }

            if (isNaN(this.searchInput)) {
                this.searchAlert = true;
                setTimeout(()=>{ this.searchAlert = false }, 3000);
                console.log("sI is not a number");
                return;
            }

            axios
                .post("/api/get-images-admin", {
                    search: this.searchInput,
                })
                .then((response) => {
                    this.images = response.data.images;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
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
                    this.getImages();
                    console.log(response.data.message);
                });
            }
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
