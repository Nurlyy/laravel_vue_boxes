<template>
  <AppSidebar />
  <div class="d-flex flex-row justify-content-between">
  <h1>Images</h1>
    <a href="/admin/images/add-image" class="btn btn-primary" style='margin-left:30px;'>Add Image</a>
  </div>
  <CTable stripedColumns>
    <thead>
        <tr>
          <th>ID</th>
          <th>Image Path</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="image in images" :key="image.id">
          <td>{{ image.id }}</td>
          <td><img :src="image.image_path" alt=""></td>
          <td>{{ image.description }}</td>
        </tr>
      </tbody>
    </CTable>
</template>

<script>
import AppSidebar from "../components/AppSidebar.vue";

export default {
  name: "Images",
  components: [AppSidebar],
  data() {
    return {
      images: [
        {
          id: 1,
          image_path: 'path/to/image1.jpg',
          description: 'Description for Image 1',
        },
        {
          id: 2,
          image_path: 'path/to/image2.jpg',
          description: 'Description for Image 2',
        },
        {
          id: 3,
          image_path: 'path/to/image3.jpg',
          description: 'Description for Image 3',
        },
      ],
    };
  },
  mounted(){
    axios.post('/api/get-images', {}).then(function(response) {
        this.images = response.data.images;
    })
  }
};
</script>

<style></style>
