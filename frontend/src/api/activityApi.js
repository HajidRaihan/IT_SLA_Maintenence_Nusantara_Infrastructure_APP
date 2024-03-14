import Cookies from 'js-cookie';
import { RequestApi } from '../helper/RequestApi';

<<<<<<< HEAD
const addAcitvity = async (data) => {
=======
const addActivity = async (credentials) => {
>>>>>>> b11f4d74327d23e34933b150c7cc485488341cfe
  const headers = {
    'Content-Type': 'multipart/form-data',
    Authorization: `Bearer ${Cookies.get('access_token')}`,
  };
  try {
    const response = await RequestApi(
      'POST',
      `toll`,
      data,
      headers,
      'Mencoba menambahkan acitvity',
    );

    return response.data;
  } catch (error) {
    console.error('Terjadi kesalahan saat menambahkan activity', error);
    throw error;
  }
};

export { addActivity };
