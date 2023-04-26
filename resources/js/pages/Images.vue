<template>
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
          <td><img :src="image.path" alt=""></td>
          <td>{{ image.description }}</td>
        </tr>
      </tbody>
    </CTable>
</template>

<script>

export default {
  name: "Images",
  data() {
    return {
      images: [
      ],
    };
  },
  mounted(){
    axios.post('/api/get-images', {}).then(response => {
        this.images = response.data.images;
    })
  }
};
</script>

<style></style>
