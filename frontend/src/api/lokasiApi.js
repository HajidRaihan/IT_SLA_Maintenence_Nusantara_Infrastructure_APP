import Cookies from 'js-cookie';
import { RequestApi } from '../helper/RequestApi';

const addAcitvity = async () => {
  const headers = {
    'Content-Type': 'multipart/form-data',
    Authorization: `Bearer ${Cookies.get('access_token')}`,
  };
  try {
    const response = await RequestApi(
      'GET',
      'toll',
      {},
      headers,
      'Mencoba menampilkan lokasi',
    );

    return response.data;
  } catch (error) {
    console.error('Terjadi kesalahan saat menampilkan lokasi', error);
    throw error;
  }
};

export { addAcitvity };
