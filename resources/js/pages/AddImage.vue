<template>
  <h1>Add Image</h1>
  <CForm>
    <div class="mb-3">
      <CFormLabel for="image">Add Image</CFormLabel>
      <CFormInput @change="onFileChange" type="file" id="image" />
    </div>

    <div class="mb-3">
      <CFormLabel for="description">Description</CFormLabel>
      <CFormTextarea v-bind="description" id="description" rows="3"></CFormTextarea>
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
                      style="margin: 5px; cursor: pointer; color: red"
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
                <label for="filter-select" class="mr-3" style='margin-top:7px;'
                  >Available Filters:</label
                >
                <div v-for="(filter, index) in availableFilters" :key="index">
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
      availableFilters: [
        // { id: 1, name: "Filter 1" },
        // { id: 2, name: "Filter 2" },
        // { id: 3, name: "Filter 3" },
      ],
    };
  },
  mounted() {
    axios.post('/api/get-filters', {}).then(function(response) {
        if(response.data.message != '' && response.data.message != null){
            this.availableFilters = response.data.filters;
        }
    })
  },    
  methods: {
    submitForm() {
        axios.post('/api/add-image', {image: this.imageSrc, description: this.description, imageFilters: this.imageFilters}).then(function(response){console.log(response);});
    //   alert("saved");
    },
    onFileChange(event) {
      const file = event.target.files[0];
      this.imageSrc = URL.createObjectURL(file);
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
};
</script>

<style></style>
