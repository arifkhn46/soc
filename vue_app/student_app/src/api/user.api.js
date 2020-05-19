import httpClient from './httpClient';

// const getUser = () => httpClient.get(END_POINT);

const login = (email, password) => httpClient.post('api/v1/login', {
  email: email,
  password: password
});

const register = (name, email, password, password_confirmation) => httpClient.post('/register', {
  name,
  email,
  password,
  password_confirmation
});

export default {
  login,
  register
}