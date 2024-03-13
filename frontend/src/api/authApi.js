import Cookies from 'js-cookie';
import { Navigate } from 'react-router-dom';
import { RequestApi } from '../helper/RequestApi';

const loginUser = async (credentials) => {
  try {
    const responseLogin = await RequestApi(
      'POST',
      'login',
      credentials,
      {},
      'Mencoba Login',
    );

    const access_token = responseLogin.data.token;
    Cookies.set('access_token', access_token, { expires: 7 });

    return responseLogin.data;
  } catch (error) {
    console.error('Terjadi kesalahan saat mencoba login ', error);
    throw error;
  }
};

export { loginUser };
