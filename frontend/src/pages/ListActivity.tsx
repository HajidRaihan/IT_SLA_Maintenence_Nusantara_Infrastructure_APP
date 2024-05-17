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

const ListActivity = () => {
  const [activity, setActivity] = useState([]);
  const [lokasiData, setLokasiData] = useState();
  const [kategori, setKategori] = useState();
  const [lokasi, setLokasi] = useState();
  const [kategoriData, setKategoriData] = useState();
  const [company, setCompany] = useState();
  const [status, setStatus] = useState();
  const [isLoading, setIsLoading] = useState(false);
  const [page, setPage] = useState(1);
  const [totalPage, setTotalPage] = useState(1);
  const [hapusLoading, setHapusLoading] = useState(false);
  const [tanggal, setTanggal] = useState(getDefaultDate());
  const [showFilters, setShowFilters] = useState(false);
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
        setIsLoading(false);
      } catch (error) {
        setIsLoading(false);
        throw error;
      }
    };
    fetchActivity();
  }, [lokasi, kategori, company, status, filteredDate, page]);

  useEffect(() => {
    const fetchLokasi = async () => {
      const res = await getLokasi();
      console.log(res);
      setLokasiData(res);
    };
    fetchLokasi();
  }, []);

  useEffect(() => {
    const fetchKategori = async () => {
      const res = await getKategori();
      console.log(res);
      setKategoriData(res);
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
        setHapusLoading(false);
        toast.success('success menambahkan activity');
      }
      console.log(res);
    } catch (error) {
      setHapusLoading(false);
      throw error;
    }
  };

  const clearFilter = () => {
    setLokasi(null);
    setKategori(null);
    setCompany(null);
    setStatus(null);
    setTanggal(getDefaultDate());
  };

  const dataCompany = ['mmn', 'jtse'];

  return (
    <DefaultLayout>
      <div className="flex flex-col">
        {/* <h2 className="text-title-md2 font-semibold text-black  dark:text-white mb-5">
          Filter
        </h2> */}
        <div className="rounded-sm border  border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark p-5 mb-5">
          {/* <div className="flex gap-5 w-full">
            <SelectCompany
              label="Company"
              data={dataCompany}
              value={company}
              onChange={(e) => setCompany(e.target.value)}
            />

            <SelectStatus
              label="Status"
              data={['process, done']}
              value={status}
              onChange={(e) => setStatus(e.target.value)}
            />

            <SelectGroupOne
              value={lokasi}
              onChange={(e) => setLokasi(e.target.value)}
              label="Lokasi"
              data={lokasiData}
            />
            <SelectGroupOne
              value={kategori}
              onChange={(e) => setKategori(e.target.value)}
              label="Kategori"
              data={kategoriData}
            />
          </div> */}
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
              toastSuccess={() => toast.success('success menambahkan activity')}
              toastError={toastErrorMessage}
            />
            <div className="w-full flex justify-center mt-5">
              <Pagination
                showControls
                total={totalPage}
                initialPage={page}
                showShadow
                onChange={(e) => setPage(e)}
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

function getDefaultDate(): any {
  throw new Error('Function not implemented.');
}
