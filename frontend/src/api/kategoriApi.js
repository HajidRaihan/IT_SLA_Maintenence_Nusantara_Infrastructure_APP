import Cookies from 'js-cookie';
import { RequestApi } from '../helper/RequestApi';

const getKategori = async () => {
  const headers = {
    'Content-Type': 'application/json',
    Authorization: `Bearer ${Cookies.get('access_token')}`,
  };
  try {
    const response = await RequestApi(
      'GET',
      'kategori',
      {},
      headers,
      'Mencoba menampilkan kategori',
    );

    return response.data;
  } catch (error) {
    console.error('Terjadi kesalahan saat menampilkan kategori', error);
    throw error;
  }
};

export { getKategori };
