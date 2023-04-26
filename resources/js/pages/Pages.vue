<template>
  <AppSidebar />
  <div class="d-flex flex-row justify-content-between">
    <h1>Pages</h1>
    <a
      href="/admin/images/add-page"
      class="btn btn-primary"
      style="margin-left: 30px; padding-bottom: -15px"
      >Add Page</a
    >
  </div>
  <CTable stripedColumns>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Title</th>
        <th>Body</th>
        <th>Keyword</th>
        <th>Description</th>
        <th>Show</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in items" :key="item.id">
        <td>{{ item.id }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.slug }}</td>
        <td>{{ item.title }}</td>
        <td>{{ item.body }}</td>
        <td>{{ item.keyword }}</td>
        <td>{{ item.description }}</td>
        <td>{{ item.show }}</td>
      </tr>
    </tbody>
  </CTable>
</template>

<script>
export default {
  name: "Filters",
  data() {
    return {
      items: [
        {
          id: 1,
          name: "Item 1",
          slug: "item-1",
          title: "Title for item 1",
          body: "Body for item 1",
          keyword: "Keyword for item 1",
          description: "Description for item 1",
          show: true,
        },
        {
          id: 2,
          name: "Item 2",
          slug: "item-2",
          title: "Title for item 2",
          body: "Body for item 2",
          keyword: "Keyword for item 2",
          description: "Description for item 2",
          show: false,
        },
      ],
    };
  },
  mounted(){
    axios.post('/api/get-pages', {}).then(response => {
        this.items = response.data.items;
    })
  }
};
</script>

<style></style>
