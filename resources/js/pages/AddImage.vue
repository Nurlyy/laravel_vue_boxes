<template>
    <h1 v-if="id==null">Добавить Изображение</h1>
    <h1 v-if="id!=null">Изменить Изображение</h1>
    <CForm @submit.prevent="submitForm()">
        <div class="mb-3">
            <CFormLabel for="image">Добавить Изображение</CFormLabel>
            <CFormInput
                @change="saveImage"
                type="file"
                id="image"
                :disabled="image != null"
            />
        </div>
        <br>
        <div class="mb-3">
            <CFormLabel for="description">Alt тэг</CFormLabel>
            <CFormTextarea
                v-model="description"
                :value="description"
                id="description"
                rows="3"
            ></CFormTextarea>
        </div>
        <br>
        <div>
            <h5 v-if="imageFilters.length >= 1">Выбранные Фильтры:</h5>
            <div v-if="imageFilters.length >= 1">
                <b-row>
                    <CCard >
                        <CCardBody>
                            <b-col md="6" xl="3" sm="6" xs="12">
                                <div class="pb-xlg">
                                    <Widget
                                        class="mb-0 d-flex"
                                        style="width: 100%; display:flex; flex-direction:row; flex-wrap: wrap;"
                                    >
                                        <div
                                            v-for="(
                                                filter, index
                                            ) in imageFilters"
                                            :key="index"
                                            class="d-flex justify-content-between align-items-center"
                                        >
                                            <CBadge
                                                style="margin: 10px"
                                                color="info"
                                                shape="rounded-pill"
                                            >
                                                {{ filter.name }}
                                                <span
                                                    @click="
                                                        removeFilter(
                                                            index,
                                                            filter
                                                        )
                                                    "
                                                    style="
                                                        margin: 5px;
                                                        cursor: pointer;
                                                        color: red;
                                                    "
                                                    >x</span
                                                >
                                            </CBadge>
                                        </div>
                                    </Widget>
                                </div>
                            </b-col>
                        </CCardBody>
                    </CCard>
                </b-row>
            </div>
            <br>
            <h5 v-if="availableFilters.length >= 1">Доступные Фильтры:</h5>
            <div v-if="availableFilters.length >= 1">
                <b-row>
                    <CCard>
                        <CCardBody>
                            <b-col md="6" xl="3" sm="6" xs="12">
                                <div class="pb-xlg">
                                    <Widget
                                        class="mb-0 d-flex"
                                        style="width: 100%; display:flex; flex-direction:row; flex-wrap: wrap;"
                                    >
                                        <div
                                            v-for="(
                                                filter, index
                                            ) in availableFilters"
                                            :key="index"
                                        >
                                            <CBadge
                                                color="primary"
                                                shape="rounded-pill"
                                                style="margin: 10px"
                                                @click="
                                                    addFilter(index, filter)
                                                "
                                                >{{ filter.name }}</CBadge
                                            >
                                        </div>
                                    </Widget>
                                </div>
                            </b-col>
                        </CCardBody>
                    </CCard>
                </b-row>
            </div>
        </div>
        <br>
        <button :disabled='image==null' class="btn btn-primary mb-5 mt-5"><CIcon icon="cil-save" size="sm"/> Сохранить</button>
    </CForm>
</template>

<script>
import { ref } from "vue";
import router from "@/router/index.js";
export default {
    name: "AddImage",
    data() {
        return {
            image: null,
            description: null,
            imageSrc: "",
            imageFilters: [],
            id: null,
            availableFilters: [
                // { id: 1, name: "Filter 1" },
                // { id: 2, name: "Filter 2" },
                // { id: 3, name: "Filter 3" },
            ],
        };
    },
    mounted() {},
    methods: {
        submitForm() {
            if (this.id == null) {
                if (this.image != null) {
                    let formData = new FormData();
                    formData.append("image", this.image);
                    formData.append("description", this.description);
                    formData.append(
                        "imageFilters",
                        JSON.stringify(this.imageFilters)
                    );
                    axios
                        .post("/api/add-image", formData)
                        .then((response) => {
                            // this.saveImagePath(response.data.path);
                            console.log(response.data);
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                    //   alert("saved");
                }
            } else {
                if (this.image != null) {
                    let formData = new FormData();
                    formData.append("description", this.description);
                    formData.append("id", this.id);
                    formData.append(
                        "imageFilters",
                        JSON.stringify(this.imageFilters)
                    );
                    axios
                        .post("/api/update-image", formData)
                        .then((response) => {
                            // this.saveImagePath(response.data.path);
                            console.log(response.data);
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                    //   alert("saved");
                }
            }
            setTimeout(() => {
                router.push({name: "Images"})
            }, 500);
            
        },
        saveImage(event) {
            this.image = event.target.files[0];
        },
        addFilter(index, filter) {
            // filter.selected = true;
            this.imageFilters.push(filter);
            this.availableFilters.splice(index, 1);
        },
        removeFilter(index, filter) {
            // filter.selected = false;
            this.availableFilters.push(filter);
            this.imageFilters.splice(index, 1);
        },
    },
    created() {
        axios.post("/api/get-filters", {}).then((response) => {
            this.availableFilters = response.data.filters;
        });
        const id = this.$route.params.id;
        if (id) {
            axios.post("/api/get-image-admin", { id: id }).then((response) => {
                // this.page = response.data.page;
                // console.log(reponse.data);
                this.image = response.data.image.path;
                this.description = response.data.image.description;
                console.log(response.data.image_filters);
                console.log(Array.from(this.availableFilters));
                this.imageFilters =
                    response.data.image_filters.length >= 1
                        ? response.data.image_filters
                        : [];
                this.id = id;
                this.imageFilters.forEach((imageFilter) => {
                    this.availableFilters.forEach((availableFilter, index) => {
                        if (imageFilter.filter_id == availableFilter.id) {
                            this.availableFilters.splice(index, 1);
                        }
                    });
                    // if (this.availableFilters.includes(imageFilter)) {
                    //     this.availableFilters.splice(
                    //         this.availableFilters.indexOf(imageFilter),
                    //         1
                    //     );
                    // }
                });
            });
        }
    },
};
</script>

<style></style>
