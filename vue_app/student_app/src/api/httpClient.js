import axios from 'axios';

const httpClient = axios.create({
  baseURL: process.env.VUE_APP_BASE_URL,
  timeout: 1000,
  headers: {
    "Content-Type": "application/json",
    // anything you want to add to the headers
  }
});


const getAuthToken = () => localStorage.getItem('access_token');

const authInterceptor = (config) => {
  config.headers['Authorization'] = getAuthToken();
  return config;
}

httpClient.interceptors.request.use(authInterceptor);

export default httpClient;
