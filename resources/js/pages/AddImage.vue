<template>
    <div v-if="isLoading" class="loading-overlay">
        <CButton disabled>
            <CSpinner
                component="span"
                size="xsl"
                color="light"
                aria-hidden="true"
            />
        </CButton>
    </div>
    <h1 v-if="id == null">Добавить Изображение</h1>
    <h1 v-if="id != null">Изменить Изображение</h1>
    <CForm @submit.prevent="submitForm()">
        <div class="mb-3">
            <CFormLabel for="image">Добавить Изображение</CFormLabel>
            <CFormInput
                @change="saveImage"
                type="file"
                id="image"
                :disabled="image != null"
            />
            <img id="imagePreview" alt="Preview Image" style="height: 150px; border-radius: 15px; margin-top: 15; display:none;" />
        </div>
        <br />
        <div class="mb-3">
            <CFormLabel for="description">Alt тэг</CFormLabel>
            <CFormTextarea
                v-model="description"
                :value="description"
                id="description"
                rows="3"
            ></CFormTextarea>
        </div>
        <br />
        <div>
            <h5 v-if="imageFilters.length >= 1">Выбранные Фильтры:</h5>
            <div v-if="imageFilters.length >= 1">
                <b-row>
                    <CCard>
                        <CCardBody>
                            <b-col md="6" xl="3" sm="6" xs="12">
                                <div class="pb-xlg">
                                    <Widget
                                        class="mb-0 d-flex"
                                        style="
                                            width: 100%;
                                            display: flex;
                                            flex-direction: row;
                                            flex-wrap: wrap;
                                        "
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
            <br />
            <h5 v-if="availableFilters.length >= 1">Доступные Фильтры:</h5>
            <div v-if="availableFilters.length >= 1">
                <b-row>
                    <CCard>
                        <CCardBody>
                            <b-col md="6" xl="3" sm="6" xs="12">
                                <div class="pb-xlg">
                                    <Widget
                                        class="mb-0 d-flex"
                                        style="
                                            width: 100%;
                                            display: flex;
                                            flex-direction: row;
                                            flex-wrap: wrap;
                                        "
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
        <br />
        <button :disabled="image == null" class="btn btn-primary mb-5 mt-5">
            <CIcon icon="cil-save" size="sm" /> Сохранить
        </button>
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
            isLoading: false,
        };
    },
    mounted() {},
    methods: {
        submitForm() {
            this.isLoading = true;
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
                            this.isLoading = false;
                            router.push({ name: "Images" });
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
                            this.isLoading = false;
                            router.push({ name: "Images" });
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                    //   alert("saved");
                }
            }
        },
        saveImage(event) {
            this.image = event.target.files[0];
            var preview = document.getElementById("imagePreview");

            // Create a new FileReader instance
            var reader = new FileReader();

            // Set the image preview source
            reader.onload = function (event) {
                preview.src = event.target.result;
            };

            preview.style.display = "block";

            // Read the image file as a data URL
            reader.readAsDataURL(event.target.files[0]);
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
                var preview = document.getElementById("imagePreview");
                preview.src = this.image;
                preview.style.display = "block";
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

<style scoped>
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}
</style>