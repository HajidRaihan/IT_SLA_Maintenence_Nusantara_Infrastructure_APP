import Cookies from 'js-cookie';
import { RequestApi } from '../helper/RequestApi';

const addActivity = async (credentials) => {
  const headers = {
    'Content-Type': 'multipart/form-data',
    Authorization: `Bearer ${Cookies.get('access_token')}`,
  };
  try {
    const response = await RequestApi(
      'POST',
      'toll',
      credentials,
      headers,
      'Mencoba menambahkan acitvity',
    );

    return response.data;
  } catch (error) {
    console.error('Terjadi kesalahan saat menambahkan activity', error);
    throw error;
  }
};

const getAllActivity = async () => {
  const headers = {
    'Content-Type': 'application/json',
    Authorization: `Bearer ${Cookies.get('access_token')}`,
  };
  try {
    const response = await RequestApi(
      'GET',
      'toll',
      {},
      headers,
      'Mencoba menampilkan acitvity',
    );

    return response.data;
  } catch (error) {
    console.error('Terjadi kesalahan saat menampilkan activity', error);
    throw error;
  }
};

const deleteActivity = async (id) => {
  const headers = {
    'Content-Type': 'application/json',
    Authorization: `Bearer ${Cookies.get('access_token')}`,
  };
  try {
    const response = await RequestApi(
      'DELETE',
      `toll/delete/${id}`,
      {},
      headers,
      'Mencoba delete acitvity',
    );

    return response.data;
  } catch (error) {
    console.error('Terjadi kesalahan saat delete activity', error);
    throw error;
  }
};

export { addActivity, getAllActivity, deleteActivity };
