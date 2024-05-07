import Cookies from 'js-cookie';
import { RequestApi } from '../helper/RequestApi';

const getAllUser = async () => {
  const headers = {
    'Content-Type': 'application/json',
    Authorization: `Bearer ${Cookies.get('access_token')}`,
  };
  try {
    const response = await RequestApi(
      'GET',
      'users',
      {},
      headers,
      'Mencoba menampilkan barang',
    );

    return response.data;
  } catch (error) {
    console.error('Terjadi kesalahan saat menampilkan barang', error);
    throw error;
  }
};

export { getAllUser };