import Cookies from 'js-cookie';
import { RequestApi } from '../helper/RequestApi';

const getLokasi = async () => {
  const headers = {
    'Content-Type': 'application/json',
    Authorization: `Bearer ${Cookies.get('access_token')}`,
  };
  try {
    const response = await RequestApi(
      'GET',
      'lokasi',
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

export { getLokasi };
