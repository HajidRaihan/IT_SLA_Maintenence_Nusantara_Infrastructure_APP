import React, { useEffect, useState } from 'react';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import ListActivityTable from '../components/Tables/ListActivityTable';
import DefaultLayout from '../layout/DefaultLayout';
import { getAllActivity, deleteActivity } from '../api/activityApi';
import SelectGroupOne from '../components/Forms/SelectGroup/SelectGroupOne';
import { getLokasi } from '../api/lokasiApi';
import { getKategori } from '../api/kategoriApi';
import SelectCompany from '../components/Forms/SelectGroup/SelectCompany';
import SelectStatus from '../components/Forms/SelectGroup/SelectStatus';
import { useNavigate } from 'react-router-dom';
import Loader from '../common/Loader';
import { toast, ToastContainer } from 'react-toastify';

const ListActivity = () => {
  const [activity, setActivity] = useState([]);
  const [lokasiData, setLokasiData] = useState();
  const [kategori, setKategori] = useState();
  const [lokasi, setLokasi] = useState();
  const [kategoriData, setKategoriData] = useState();
  const [company, setCompany] = useState();
  const [status, setStatus] = useState();
  const [isLoading, setIsLoading] = useState(false);

  const navigate = useNavigate();

  useEffect(() => {
    const fetchActivity = async () => {
      setIsLoading(true);
      try {
        const response = await getAllActivity(
          lokasi,
          kategori,
          company,
          status,
        );
        console.log('actyivity', response.data.data);
        setActivity(response.data.data);
        if (response) {
          setIsLoading(false);
        }
      } catch (error) {
        setIsLoading(false);
        throw error;
      }
    };
    fetchActivity();
  }, [lokasi, kategori, company, status]);

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

  const deleteHandler = async (id) => {
    console.log('delete', id);

    try {
      const res = await deleteActivity(id);
      if (res) {
        const updatedData = activity.filter((item) => item.id !== id);
        setActivity(updatedData);
      }
      console.log(res);
    } catch (error) {
      throw error;
    }
  };

  const dataCompany = ['mmn', 'jtse'];

  return (
    <DefaultLayout>
      {/* <Breadcrumb pageName="List Activity" /> */}

      <div className="flex flex-col">
        <h2 className="text-title-md2 font-semibold text-black  dark:text-white mb-5">
          Filter
        </h2>
        <div className="flex gap-5 w-full bg-white border-stroke dark:border-strokedark dark:bg-boxdark p-5 mb-5 ">
          {/* <SelectCompany
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
          /> */}
        </div>

        <ToastContainer autoClose={2000} />

        {!isLoading ? (
          <ListActivityTable
            data={activity}
            deleteHandler={deleteHandler}
            toastSuccess={() => toast.success('success menambahkan activity')}
          />
        ) : (
          <Loader />
        )}
      </div>
    </DefaultLayout>
  );
};

export default ListActivity;
