import axios from 'axios';

const httpClient = axios.create({
  baseURL: process.env.VUE_APP_BASE_URL,
  headers: {
    "Content-Type": "application/json",
    // anything you want to add to the headers
  }
});


const getAuthToken = () => localStorage.getItem('access_token');

const authInterceptor = (config) => {
  config.headers['Authorization'] = 'Bearer ' + getAuthToken();
  return config;
}

httpClient.interceptors.response.use((response) => {
  // if (response.data.data) {
  //   response.data = response.data.data;
  // }

  return response;
}, (error) => {
  return Promise.reject(error);
});

httpClient.interceptors.request.use(authInterceptor);

export default httpClient;