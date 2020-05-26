import httpClient from './httpClient';

const createTask = (
  title,
  description,
  type,
  start_at,
  end_at,
  subject_id,
  chapter_id
  ) => httpClient.post('api/v1/tasks', {
  title,
  description,
  type,
  start_at,
  end_at,
  subject_id,
  chapter_id,
  state: 1
});

const getTasks = () => httpClient.get('api/v1/tasks');

export default {
  createTask,
  getTasks
}