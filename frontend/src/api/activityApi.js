import Cookies from 'js-cookie';
import { RequestApi } from '../helper/RequestApi';

const addAcitvity = async (data) => {
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

export { addAcitvity };
