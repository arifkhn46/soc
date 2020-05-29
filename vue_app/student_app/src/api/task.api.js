import httpClient from './httpClient';

const createTask = (
  title,
  description,
  type,
  start_at,
  end_at,
  optionalData
  ) => httpClient.post('api/v1/tasks', {
  title,
  description,
  type,
  start_at,
  end_at,
  state: 1,
  ...optionalData
});

const getTasks = () => httpClient.get('api/v1/tasks');
const updateTask = (
  id,
  title,
  description,
  type,
  start_at,
  end_at,
  state,
  optionalData) => httpClient.post(`api/v1/tasks/${id}/update`, {
    id,
    title,
    description,
    type,
    start_at,
    end_at,
    state,
    ...optionalData,
    _method: 'patch'
  })

const deleteTask = (id) => httpClient.post(`api/v1/tasks/${id}/delete`, {
  id,
  _method: 'delete'
})

export default {
  createTask,
  getTasks,
  updateTask,
  deleteTask,
}