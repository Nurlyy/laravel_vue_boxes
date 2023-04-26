<template>
    <AppSidebar />
    <div class="d-flex flex-row justify-content-between">
    <h1>Filters</h1>
      <a href="/admin/images/add-filter" class="btn btn-primary" style='margin-left:30px;'>Add Filter</a>
    </div>
    <CTable stripedColumns>
      <thead>
          <tr>
            <th>ID</th>
            <th>NAME</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="filter in filters" :key="filter.id">
            <td>{{ filter.id }}</td>
            <td>{{ filter.name }}</td>
          </tr>
        </tbody>
      </CTable>
  </template>
  
  <script>
  
  export default {
    name: "Filters",
    data() {
      return {
        filters: [
          {
            id: 1,
            name: 'path/to/image1.jpg',
          },
          {
            id: 2,
            name: 'path/to/image2.jpg',
          },
          {
            id: 3,
            name: 'path/to/image3.jpg',
          },
        ],
      };
    },
    mounted(){
        axios.post('/api/get-filters', {}).then(function(response) {
            this.filters = response.data.filters;
        })
    }
  };
  </script>
  
  <style></style>
  