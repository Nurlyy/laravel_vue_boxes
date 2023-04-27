<template>
    <h1>Add Image</h1>
    <CForm @submit.prevent="submitForm()">
        <div class="mb-3">
            <CFormLabel for="image">Add Image</CFormLabel>
            <CFormInput
                @change="saveImage"
                type="file"
                id="image"
            />
        </div>

        <div class="mb-3">
            <CFormLabel for="description">Description</CFormLabel>
            <CFormTextarea
                v-model="description"
                :value="description"
                id="description"
                rows="3"
            ></CFormTextarea>
        </div>

        <div>
            <h5>Selected filters:</h5>
            <div>
                <b-row>
                    <b-col md="6" xl="3" sm="6" xs="12">
                        <div class="pb-xlg">
                            <Widget class="mb-0 d-flex" style="width: 100%">
                                <div
                                    v-for="(filter, index) in imageFilters"
                                    :key="index"
                                    class="d-flex justify-content-between align-items-center"
                                >
                                    <CBadge
                                        style="margin: 10px"
                                        color="primary"
                                        shape="rounded-pill"
                                    >
                                        {{ filter.name }}
                                        <span
                                            @click="removeFilter(index, filter)"
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
                    <b-col md="6" xl="3" sm="6" xs="12">
                        <div class="pb-xlg">
                            <Widget class="mb-0 d-flex" style="width: 100%">
                                <label
                                    for="filter-select"
                                    class="mr-3"
                                    style="margin-top: 7px"
                                    >Available Filters:</label
                                >
                                <div
                                    v-for="(filter, index) in availableFilters"
                                    :key="index"
                                >
                                    <CBadge
                                        color="primary"
                                        shape="rounded-pill"
                                        style="margin: 10px"
                                        @click="addFilter(index, filter)"
                                        >{{ filter.name }}</CBadge
                                    >
                                </div>
                            </Widget>
                        </div>
                    </b-col>
                </b-row>
            </div>
        </div>

        <button class="btn btn-primary mb-5 mt-5">Save</button>
    </CForm>
</template>

<script>
import { ref } from "vue";
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
    mounted() {
        axios.post("/api/get-filters", {}).then((response) => {
            this.availableFilters = response.data.filters;
        });
    },
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
                    formData.append("image", this.image);
                    formData.append("description", this.description);
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
        const id = this.$route.params.id;
        if (id) {
            axios.post("/api/get-page-admin", { id: id }).then((response) => {
                // this.page = response.data.page;
                // console.log(reponse.data);
                this.image = response.data.image.path;
                this.description = response.data.image.description;
                this.imageFilters = JSON.parse(response.data.image.filters);
                this.imageFilters.forEach((imageFilter) => {
                    if (this.availableFilters.includes(imageFilter)) {
                        this.availableFilters.splice(
                            this.availableFilters.indexOf(imageFilter),
                            1
                        );
                    }
                });
            });
        }
    },
};
</script>

<style></style>
