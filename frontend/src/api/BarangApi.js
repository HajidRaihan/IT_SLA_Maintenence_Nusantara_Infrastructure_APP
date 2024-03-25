import Cookies from 'js-cookie';
import { RequestApi } from '../helper/RequestApi';

const getBarang = async () => {
  const headers = {
    'Content-Type': 'application/json',
    Authorization: `Bearer ${Cookies.get('access_token')}`,
  };
  try {
    const response = await RequestApi(
      'GET',
      'barang',
      {},
      headers,
      'Mencoba mengambil barang',
    );

    return response.data;
  } catch (error) {
    console.error('Terjadi kesalahan saat mengambil barang', error);
    throw error;
  }
};




const addBarang = async (data) => {
    const headers = {
      'Content-Type': 'multipart/form-data',
      Authorization: `Bearer ${Cookies.get('access_token')}`,
    };
    try {
      const response = await RequestApi(
        'POST',
        'barang',
        data,
        headers,
        'Mencoba mengirim barang',
      );
  
      return response.data;
    } catch (error) {
      console.error('Terjadi kesalahan saat mengambil barang', error);
      throw error;
    }
  };

  const updateBarang = async(id,data) => {
    const headers = {
        'Content-Type' : 'application/json',
        Authorization: `Bearer ${Cookies.get('access_token')}`,
    };
    try{
        const response = await RequestApi(
            'PUT',
            `barang/${id}`,
            data,
            headers,
            'mencoba mengupdate barang' 

        );


        return response.data;
    }catch(error){
        console.error("Terjadi Kesalahan",error);
        throw error;
    }
}

const deleteBarang = async(id) =>{
    const headers = {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${Cookies.get('access_token')}`,
      };
      try {
        const response = await RequestApi(
          'DELETE',
          `barang/${id}`,
          {},
          headers,
          'Mencoba delete kategori',
        );
    
        return response.data;
      } catch (error) {
        console.error('Terjadi kesalahan saat delete barang', error);
        throw error;
      }
}
  
  
  
  export { addBarang, getBarang,updateBarang,deleteBarang };



