import httpClient from './httpClient';

const getSubjects = () => httpClient.get('api/v1/subjects');
const getSubjectChapters = (subject_id) => httpClient.get(`api/v1/subjects/${subject_id}/chapters`);

export default {
  getSubjects,
  getSubjectChapters
}