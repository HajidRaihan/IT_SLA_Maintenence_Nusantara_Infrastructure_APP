import React, { useEffect, useState } from 'react';
import ListActivityTable from '../components/Tables/ListActivityTable';
import DefaultLayout from '../layout/DefaultLayout';
import { getAllActivity, deleteActivity } from '../api/activityApi';
import { getLokasi } from '../api/lokasiApi';
import { getKategori } from '../api/kategoriApi';
import { useNavigate } from 'react-router-dom';
import Loader from '../common/Loader';
import { toast, ToastContainer } from 'react-toastify';
import { Pagination, Button } from '@nextui-org/react';

// Define getDefaultDate function here
const getDefaultDate = () => {
  const today = new Date();
  return today.toISOString().split('T')[0]; // Ensure a valid date string
};

const ListActivity = () => {
  const [activity, setActivity] = useState([]);
  const [lokasiData, setLokasiData] = useState([]);
  const [kategoriData, setKategoriData] = useState([]);
  const [lokasi, setLokasi] = useState(null);
  const [kategori, setKategori] = useState(null);
  const [company, setCompany] = useState(null);
  const [status, setStatus] = useState(null);
  const [isLoading, setIsLoading] = useState(false);
  const [page, setPage] = useState(1);
  const [totalPage, setTotalPage] = useState(1);
  const [hapusLoading, setHapusLoading] = useState(false);
  const [filteredDate, setFilteredDate] = useState(getDefaultDate());

  useEffect(() => {
    const fetchActivity = async () => {
      setIsLoading(true);
      try {
        const response = await getAllActivity(
          lokasi,
          kategori,
          company,
          status,
          filteredDate, // Include filtered date value
          page,
        );
        console.log('activity', response);
        setActivity(response.data.data);
        setTotalPage(response.data.last_page);
      } catch (error) {
        toast.error('Error fetching activity: ' + error.message);
      } finally {
        setIsLoading(false);
      }
    };
    fetchActivity();
  }, [lokasi, kategori, company, status, filteredDate, page]);

  useEffect(() => {
    const fetchLokasi = async () => {
      try {
        const res = await getLokasi();
        console.log(res);
        setLokasiData(res);
      } catch (error) {
        toast.error('Error fetching lokasi: ' + error.message);
      }
    };
    fetchLokasi();
  }, []);

  useEffect(() => {
    const fetchKategori = async () => {
      try {
        const res = await getKategori();
        console.log(res);
        setKategoriData(res);
      } catch (error) {
        toast.error('Error fetching kategori: ' + error.message);
      }
    };
    fetchKategori();
  }, []);

  const toastErrorMessage = (message) => {
    toast.error('Error: ' + message);
  };

  const deleteHandler = async (id) => {
    console.log('delete', id);
    setHapusLoading(true);
    try {
      const res = await deleteActivity(id);
      if (res) {
        const updatedData = activity.filter((item) => item.id !== id);
        setActivity(updatedData);
        toast.success('Successfully deleted activity');
      }
      console.log(res);
    } catch (error) {
      toast.error('Error deleting activity: ' + error.message);
    } finally {
      setHapusLoading(false);
    }
  };

  const clearFilter = () => {
    setLokasi(null);
    setKategori(null);
    setCompany(null);
    setStatus(null);
    setFilteredDate(getDefaultDate());
  };

  const dataCompany = ['mmn', 'jtse'];

  return (
    <DefaultLayout>
      <div className="flex flex-col">
        <div className="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark p-5 mb-5">
          <div>
            <Button onPress={clearFilter} color="danger" className="">
              Clear Filter
            </Button>
          </div>
        </div>

        <ToastContainer autoClose={2000} />

        {!isLoading ? (
          <>
            <ListActivityTable
              data={activity}
              setData={setActivity}
              deleteHandler={deleteHandler}
              hapusLoading={hapusLoading}
              toastSuccess={() => toast.success('Successfully added activity')}
              toastError={toastErrorMessage}
            />
            <div className="w-full flex justify-center mt-5">
              <Pagination
                showControls
                total={totalPage}
                initialPage={page}
                showShadow
                onChange={(page) => setPage(page)}
              />
            </div>
          </>
        ) : (
          <Loader />
        )}
      </div>
    </DefaultLayout>
  );
};

export default ListActivity;
