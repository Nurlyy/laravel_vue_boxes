<template>
    <div>
      <form @submit.prevent="login">
        <input type="text" v-model="email" placeholder="Email">
        <input type="password" v-model="password" placeholder="Password">
        <button type="submit">Login</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    data() {
      return {
        email: '',
        password: '',
      };
    },
    methods: {
      async login() {
        try {
          const response = await axios.post('/oauth/token', {
            grant_type: 'password',
            client_id: '1',
           client_secret: 'UKjF6xaghY2GGt7lBpPt3ZijETvTJEo8MOeX6TeO',
           username: this.email,
           password: this.password,
        });
        localStorage.setItem('access_token', response.data.access_token);
          this.$emit('authenticated');
        } catch (error) {
          console.error('Authentication failed:', error);
        }
      },
    },
  };
  </script>