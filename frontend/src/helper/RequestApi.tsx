import axios from 'axios';

const API_BASE_URL = 'http://127.0.0.1:8000/api';

const handleErrorResponse = (error: any, action: string) => {
  console.error(`Error: saat ${action}`, error);
  throw error;
};

const RequestApi = async (
  method: string,
  url: string,
  data: any = {},
  headers: any = {},
  action: string,
) => {
  try {
    const response = await axios({
      method: method,
      url: `${API_BASE_URL}/${url}`,
      data,
      headers: {
        'Content-Type': 'application/json',
        ...headers,
      },
    });

    return response;
  } catch (error) {
    throw error;
  }
};

export { RequestApi };
